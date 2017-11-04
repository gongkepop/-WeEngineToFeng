<?php
/**
 * Created by PhpStorm.
 * User: gok11139
 * Date: 2017/11/1
 * Time: 17:07
 */

require_once 'common\core\CurlBase.php';


class AddToHaiQi {

    const HAI_QI_ADD_USER_URL = 'http://weiqing.liansuosoft.com/syn.ashx';

    private $_curl ;

    public function __construct()
    {
        $this->_curl = new CurlBase();
    }


    public function addUser($params){
        $params = [
            'm' => 'addcard',
            'CardID' => '',
            'CardName' => '',
            'PassWord' => '',
            'CompId' => CoreFactory::COMP_ID,
            'ShopId' => CoreFactory::SHOP_ID
        ];

        $this->_curl->get(self::HAI_QI_ADD_USER_URL,$params);


    }


}