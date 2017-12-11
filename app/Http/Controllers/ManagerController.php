<?php
/**
 * Created by PhpStorm.
 * User: thuatnv
 * Date: 12/9/17
 * Time: 12:44 AM
 */

namespace App\Http\Controllers;


use App\User;
use App\Utils\Convert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
    public function history(Request $request)
    {
        $directory = Config::get('web.history');
        $files = Storage::disk('public')->files($directory);
        $data = [];
        $data['list_user'] = User::all();
        if (!empty($files)) {
            foreach ($files as $file) {
                $data['list_file'][] = Convert::convert_file_to_array($file);
            }

        } else {

        }
//        dd($data['list_file']);
        return view('history', $data);
    }

    public function unknown(Request $request)
    {
        $directory = Config::get('web.unknown');
        $files = Storage::disk('public')->files($directory);
        $data = [];
        $data['list_user'] = User::all();
        if (!empty($files)) {
            foreach ($files as $file) {
                $data['list_file'][] = Convert::convert_file_to_array($file);
            }

        } else {

        }
//        dd($data['list_file']);
        return view('unknown', $data);
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

}