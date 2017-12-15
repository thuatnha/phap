<?php
/**
 * Created by PhpStorm.
 * User: thuatnv
 * Date: 12/9/17
 * Time: 12:44 AM
 */

namespace App\Http\Controllers;


use App\FaceUser;
use App\ListCamera;
use App\UnknownFace;
use App\User;
use App\Utils\Convert;
use Carbon\Carbon;
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
        $parame = [];
        $page = $request->get('page', 1);
        $time = $request->get('time');
        $user_name = $request->get('user_name');
        $date_range = $request->get('daterange');
        $list_user = User::all();
        $face_user = FaceUser::query();
//        if(empty($date_range) && empty($user_name)){
//            $list_file = $face_user->paginate(Config::get('web.paging'));
//        }
        if ($user_name) {
            $parame['user_name'] = $user_name;
            $face_user->where('user_name', $user_name);
        }
        if ($date_range) {
            $parame['daterange'] = $date_range;
            if (preg_match('/-/', $date_range)) {
                $date_time = explode('-', $date_range);
                $date_time_from = Carbon::createFromFormat('d/m/Y', trim($date_time[0]))->format('Y-m-d') . ' 00:00:00';
                $date_time_to = Carbon::createFromFormat('d/m/Y', trim($date_time[1]))->format('Y-m-d') . ' 23:59:59';
                $face_user->where('updated_at', '>=', $date_time_from);
                $face_user->where('updated_at', '<=', $date_time_to);
            }
        }
        $list_file = $face_user->paginate(Config::get('web.paging'));

        return view('history', compact('list_file', 'list_user', 'parame'));
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
        $list_camera = ListCamera::all();

        return view('listcamera', compact('list_camera'));
    }

    public function camera_detail(Request $request, $id = null)
    {
        $camera = ListCamera::find($id);
        return view('camera', compact('camera'));
    }

    public function history_action(Request $request)
    {
        $action = $request->input('type');
        $id = $request->input('id');
        $user = $request->input('user');
        $flight = FaceUser::find($id);

        if (!empty($flight)) {
            $full_path = $flight->full_path;
            $file_name = $flight->file_name;
        } else {
            $message = 'Không có dữ liệu';
            return Redirect::back()->with('message', $message);
        }

        $folder_to = Config::get('web.folder_train') . '/' . $user;
        $file_source = '';

        if (empty($action) || empty($user)) {
            $message = 'Chưa chọn thao tác hoặc chưa chọn nhân viên';
            return Redirect::back()->with('message', $message);
        }
        if ($action == 'move') {
            Storage::disk('public')->move($full_path, $folder_to . '/' . $file_name);
            $flight->delete();
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
            $message = 'Chưa chọn thao tác hoặc chưa chọn nhân viên';
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

    }

    public function retrain(Request $request)
    {
        $in_process = false;
        if ($request->isMethod('post')) {
            $in_process = true;
            // login run commandasdasd

        }
        return view('retrain', compact('in_process'));
    }

    public function camera_train(Request $request)
    {
        $face_user = FaceUser::orderBy('id','dec')->take(2)->get();
        echo json_encode($face_user);
    }

}