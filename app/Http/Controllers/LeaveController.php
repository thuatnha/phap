<?php

namespace App\Http\Controllers;

use App\LeaveDay;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class LeaveController extends Controller
{
    //
    public function index(Request $request)
    {
        $list_leave = LeaveDay::with('users')->orderBy('id','dec')->paginate(Config::get('web.paging'));
        return view('leave_date', compact('list_leave'));
    }

    public function create_leave_date(Request $request)
    {
        $list_user = User::all();
        if ($request->isMethod('post')) {
            $leave_date = new LeaveDay();
            $leave_date->user_id = $request->input('user');
//            $leave_date->from_date = $request->input('from_date');
            $leave_date->from_date = Carbon::createFromFormat('d/m/Y', trim($request->input('from_date')))->format('Y-m-d');
//            $leave_date->to_date = $request->input('to_date');
            $leave_date->to_date = Carbon::createFromFormat('d/m/Y', trim($request->input('to_date')))->format('Y-m-d');
            $leave_date->description = $request->input('description');
            $leave_date->save();
            $message = 'Thêm ngày phép thành công';
            return Redirect::route('leave_date')->with('message', $message);
        }
        return view('create_leave_date', compact('list_user'));

    }
}
