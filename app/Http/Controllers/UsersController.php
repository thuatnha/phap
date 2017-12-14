<?php
/**
 * Created by PhpStorm.
 * User: thuatnv
 * Date: 12/14/17
 * Time: 10:43 PM
 */

namespace App\Http\Controllers;


use App\User;

class UsersController extends Controller
{
    public function get_users(){

        $list_user = User::all();
        if(!empty($list_user)) {
            $this->body['data'] = $list_user;
            return $this->output($this->body);
        }
    }
}