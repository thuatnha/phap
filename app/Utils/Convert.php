<?php
/**
 * Created by PhpStorm.
 * User: thuatnv
 * Date: 12/9/17
 * Time: 2:26 AM
 */

namespace App\Utils;


use Carbon\Carbon;

class Convert
{

    public static function convert_file_to_array($fileName = null)
    {
        if (!empty($fileName)) {
            if (preg_match('/\//', $fileName)) {
                $file = explode('/', $fileName);
                $file_tmp = isset($file[3]) ? $file[3] : '';
                if (preg_match('/_/', $file_tmp)) {

                    $_tmp_1 = explode('_', $file_tmp);
                    $_tmp_2 = explode('.', $_tmp_1[1]);

                    return self::create_object_file($_tmp_1[0], $_tmp_2[0], $file_tmp, $fileName);
                }else {
                    $_tmp_2 = explode('.', $file_tmp);
                    return self::create_object_file('', $_tmp_2[0], $file_tmp, $fileName);
                }
            }
        } else {
            return null;
        }
    }

    private static function create_object_file($user = '', $time = '', $file_name = '', $full_path = '')
    {
        return [
            'file_name' => $file_name,
            'date_time' => $time,
            'user' => $user,
            'full_path' => $full_path
        ];
    }

    public static function convert_date_time($times_tamp, $format = '')
    {
        try {
            if (!is_numeric($times_tamp))
                return null;
            if ($times_tamp < 1)
                return null;
            /*
             * $value là GMT +0 show GMT + 7 (7*60*60*1000)
             */
            $value = $times_tamp + 25200000;
            $epoch = round($times_tamp / 1000);
            $dt = new \DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
            $y = $dt->format('Y');

            if (!empty($format)) {
                return $dt->format($format);
            }
            return $dt->format('d/m/Y H:i:s');

        } catch (Exception $e) {

        }
        return null;
    }


}
