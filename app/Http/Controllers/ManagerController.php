<?php
/**
 * Created by PhpStorm.
 * User: thuatnv
 * Date: 12/9/17
 * Time: 12:44 AM
 */

namespace App\Http\Controllers;


use App\FaceUser;
use App\UnknownFace;
use App\User;
use App\Utils\Convert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
    public function history(Request $request)
    {

//        $directory = Config::get('web.history');
//        $files = Storage::disk('public')->files($directory);
//        $data = [];
//        $data['list_user'] = User::all();
//        if (!empty($files)) {
//            foreach ($files as $file) {
//                $data['list_file'][] = Convert::convert_file_to_array($file);
//            }
//
//        } else {
//
//        }
        $data = [];
        $page = $request->get('page', 1);
        $time = $request->get('time');
        $list_file = FaceUser::paginate(Config::get('web.paging'));
        $list_user = User::all();
        return view('history', compact('list_file', 'list_user'));
    }

    public function unknown(Request $request)
    {
//        $directory = Config::get('web.unknown');
//        $files = Storage::disk('public')->files($directory);
//        $data = [];
//        $data['list_user'] = User::all();
//        if (!empty($files)) {
//            foreach ($files as $file) {
//                $data['list_file'][] = Convert::convert_file_to_array($file);
//            }
//
//        } else {
//
//        }
//        dd($data['list_file']);
        $data = [];
        $page = $request->get('page', 1);
        $time = $request->get('time');
        $list_file = UnknownFace::paginate(Config::get('web.paging'));
        $list_user = User::all();
        return view('unknown', compact('list_file', 'list_user'));
    }

    public function camera(Request $request)
    {
        echo "Hello Camera";
//        $directory = Config::get('web.unknown');
//        $files = Storage::disk('public')->files($directory);
//        $data = [];
//        $data['list_user'] = User::all();
//        if (!empty($files)) {
//            foreach ($files as $file) {
//                $data['list_file'][] = Convert::convert_file_to_array($file);
//            }
//
//        } else {
//
//        }
////        dd($data['list_file']);
//        return view('unknown', $data);
    }

    public function history_action(Request $request)
    {
        $action = $request->input('type');
        $id = $request->input('id');
        $user = $request->input('user');
        $flight = FaceUser::find($id);

        if (!empty($flight) && !empty($user)) {
            $full_path = $flight->full_path;
            $file_name = $flight->file_name;
        } else {
            $message = 'Không có dữ liệu';
            return Redirect::back()->with('message', $message);
        }

        $folder_to = Config::get('web.folder_train') . '/' . $user;
        $file_source = '';

        if (empty($action)) {
            $message = 'Chưa chọn thao tác';
            return Redirect::back()->with('message', $message);
        }
        if ($action == 'move') {
            Storage::disk('public')->move($full_path, $folder_to . '/' . $file_name);

            $message = 'Di chuyển thành công';
            return redirect()->route('history')->with('message', $message);

        } else {

            $flight->delete();
            Storage::disk('public')->delete($full_path);
            $message = 'Xóa thành công';
            return redirect()->route('history')->with('message', $message);
        }
    }

    public function unknown_action(Request $request)
    {
        $user = $request->input('user');
        $action = $request->input('type');
        $folder_to = Config::get('web.folder_train');
        $id = $request->input('id');
        $flight = UnknownFace::find($id);

        if (!empty($flight)) {
            $full_path = $flight->full_path;
            $file_name = $flight->file_name;
        } else {
            $message = 'Không có dữ liệu';
            return Redirect::back()->with('message', $message);
        }

        if (empty($action) || empty($user)) {
            $message = 'Chưa chọn thao tác hoặc không chọn nhân viên';
            return Redirect::back()->with('message', $message);
            return;
        }

        if ($action == 'move') {
            $flight->delete();
            Storage::disk('public')->move($full_path, $folder_to . '/' . $user . '/' . $file_name);
            $message = 'Di chuyển thành công';
            return redirect()->route('unknown')->with('message', $message);

        } else {
            $flight->delete();
            Storage::disk('public')->delete($full_path);
            $message = 'Xóa thành công';
            return redirect()->route('unknown')->with('message', $message);
        }
    }

    public function insert_history(Request $request)
    {
        if ($request->isMethod('post')) {
            $file_name = $request->input('file');
            $is_success = $request->input('is_success');
            $user_name = $request->input('user_name');

            if ($is_success) {
                $face_user = new FaceUser();
                $face_user->user_name = $user_name;
                $face_user->full_path = Config::get('web.history') . '/' . $file_name;
                $face_user->file_name = $file_name;
                $face_user->save();
            } else {
                $unknown_face = new UnknownFace();
                $unknown_face->full_path = Config::get('web.unknown') . '/' . $file_name;
                $unknown_face->file_name = $file_name;
                $unknown_face->save();
            }
            return $this->output($this->body);

        } else {
            return $this->error(9997);
        }

    }

    public function leave()
    {
        echo "Chấm CMNR Công";
    }
}