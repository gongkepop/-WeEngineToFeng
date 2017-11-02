<?php
/**
 * Created by PhpStorm.
 * User: Merlin
 * Date: 2017/10/28
 * Time: 15:40
 */
require 'ErrorCode.php';



class CoreFactory
{
    const COMP_ID= 743;
    const SHOP_ID= 692;
    /**
     * 格式化输出
     * @param $code
     * @param $message
     * @param array $result
     * @return array
     */
    public static function format($code = 0, $result = [], $message = null)
    {
        return json_encode([
            'code' => isset($code) ? $code : 0,
            'message' => isset($message) ? $message : ErrorCode::msg($code),
            'data' => !empty($result) ? $result : new \stdClass(),
        ]);
    }

    /**
     * 格式化输出-异常，失败
     * @param $code
     * @param $message
     * @return array
     */
    public static function interrupt($code = -1, $message = null)
    {
        return json_encode([
            'code' => isset($code) ? $code : -1,
            'message' => isset($message) ? $message : ErrorCode::msg($code),
        ]);
    }

    /**
     * 成功格式化输出
     * @param $message
     * @param array $result
     * @return array
     */
    public static function formatSuccess($result = [], $message = null)
    {
        return self::format(ErrorCode::NO_ERROR, $result, $message);
    }
}