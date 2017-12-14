<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $message = array(
        '1000' => 'OK.',
        '9997' => 'Method not allow.',
        '9998' => 'Token is invalid.',
        '9999' => 'Exception error.',
        '1001' => 'Can not connect to DB.',
        '1002' => 'Parameter is not enought.',
        '1003' => 'Parameter type is not valid.',
        '1004' => 'Parameter value is not valid.',
        '1005' => 'Unknown error.',
        '1011' => 'Time expire.',
        '1012' => 'Parameter sig not exist.',
        '1013' => 'Parameter sig is not valid.',
        '3005' => 'Update status failed',
        '3006' => 'No data result',
        '3000' => 'Cannot be null, empty or blank.',
        '1906' => 'Contact already exists',
        '9996' => 'Application does not upload files',
    );
    protected $body = array(
        'code' => 1000,
        'message' => 'OK',
        'data' => array()
    );

    function output($body = array())
    {
        return response()->json($this->body);
    }

    function error($code = 1005)
    {
        $this->body['code'] = $code;
        $this->body['message'] = $this->message[$code];
        $this->body['data'] = array();
        return $this->output($this->body);
    }

    function error_detail($code = 1005, $detail)
    {
        $this->body['code'] = $code;
        $this->body['message'] = $this->message[$code];
        $this->body['data'] = array('detail' => $detail);
        return $this->output($this->body);
    }


    protected function validate_param($params, $data = null)
    {

        if (!$data)
            $data = Input::all();
        foreach ($params as $key => $param) {
            if (!is_array($param)) {
                if ($param == 'time' && isset($data[$param]) && !$this->validate_time_expire($data[$param]))
                    return $this->error_detail(1011, 'Time expire');
                if (!isset($data[$param])) {
                    return $this->error_detail(1002, 'not found ' . $param);
                }
                //not null.
                if ($data[$param] === '') {
                    return $this->error_detail(1004, 'param: ' . $param . ' is null.');
                }
            } else {
                if (!isset($data[$key])) {
                    return $this->error_detail(1002, 'not found ' . $key);
                }
                if (!is_array($data[$key])) {
                    return $this->error(1003);
                }
                $ret = $this->validate_param($param, $data[$key]);
                if ($ret) {
                    return $ret;
                }
            }
        }
        return 0;
    }
}
