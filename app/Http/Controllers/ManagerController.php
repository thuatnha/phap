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
        return view('history', compact('list_file','list_user'));
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
        return view('unknown', compact('list_file','list_user'));
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
        $full_path = $request->input('full_path');
        $file_name = $request->input('file_name');
        $user = $request->input('user');
        $folder_to = Config::get('web.folder_train').'/'.$user;
        $file_source = '';
        if (empty($action)) {
            return;
        }
        if ($action == 'move') {
            Storage::disk('public')->move($full_path, $folder_to . '/' . $file_name);
            return redirect()->route('history');

        } else {
            Storage::disk('public')->delete($full_path);
            return redirect()->route('history');
        }
    }

    public function unknown_action(Request $request)
    {
        $user = $request->input('user');
        $action = $request->input('type');
        $full_path = $request->input('full_path');
        $file_name = $request->input('file_name');
        $folder_to = Config::get('web.folder_train');
        if (empty($action) || empty($user)) {
            return;
        }
        if ($action == 'move') {
            Storage::disk('public')->move($full_path, $folder_to . '/' . $user . '/' . $file_name);
            return redirect()->route('unknown');

        } else {
            Storage::disk('public')->delete($full_path);
            return redirect()->route('unknown');
        }
    }

    public function insert_history(Request $request){
        if($request->isMethod('post')) {
            $file_name =  $request->input('file');
            $is_success = $request->input('is_success');
            $user_name =  $request->input('user_name');

            if($is_success){
                $face_user = new FaceUser();
                $face_user->user_name = $user_name;
                $face_user->full_path = Config::get('web.history'). '/'. $file_name;
                $face_user->file_name = $file_name;
                $face_user->save();
            }else {
                $unknown_face = new UnknownFace();
                $unknown_face->full_path = Config::get('web.unknown'). '/'. $file_name;
                $unknown_face->file_name = $file_name;
                $unknown_face->save();
            }
            return $this->output($this->body);

        }else {
            return $this->error(9997);
        }

    }

}