<?php
//namespace core\common;

/**
 * 错误定义类
 */
class ErrorCode
{
    const NO_ERROR = 0; //正确，无异常
    const FAIL = 1; //失败
    const UNKOWN = 2; //网络错误
    //数据库错误
    const ERROR_DATABASE = 100;// 数据库错误
    const ERROR_DATABASE_START_TRANS = 101;// 数据库事务开启错误
    const ERROR_DATABASE_NOT_TRANS = 102;// 不在事务中

    const ERROR_NOT_FORBIDDEN = 200; //找不到相应的对象

    const ERROR_PARAMS = 1000; //参数错误
    const ERROR_VERIFICATION = 1001; //验证码错误
    const ERROR_NO_LOGIN = 1002; //用户未登录
    const ERROR_SAVE = 1003; //保存错误
    //资料采集错误信息
    const ERROR_INDIVIDUAL_MODEL_ADD = 10001; //用户添加信息错误
    const ERROR_INDIVIDUAL_EMPTY = 10002; //用户信息为空
    const ERROR_PRODUCT_MODEL_ADD = 10011; //产品添加错误
    const ERROR_APPLY_MODEL_ADD = 10021; //申请添加错误
    const ERROR_APPLY_PASS = 10022; //申请已经通过,拒绝修改
    const ERROR_APPLY_CODE_EMPTY = 10023; //合同编号为空
    const ERROR_APPLY_GRANT_STATUS = 10024; //放款状态已更新过
    const ERROR_APPLY_PHONE_ADD = 10025; //手机号格式不正确
    const ERROR_APPLY_WORK_PHONE = 10026; //工作电话格式不正确
    const ERROR_OUT_OF_LIMIT = 10027; //附加信息
    const ERROR_ADDITION_MODEL_ADD = 10031; //附加信息
    const ERROR_APPLY_REPAY_EMPTY = 10032; //还款纪录为空
    const ERROR_APPLY_EMPTY = 10033; //订单不存在

    const ERROR_BAND_CARD_PHONE = 10100; //银行卡对应手机号不正确
    const ERROR_BAND_CARD_NUM = 10101; //银行卡格式不正确
    const ERROR_BAND_CARD_INFO = 10102; //银行卡信息获取失败，请重试
    const ERROR_BAND_CARD_CANNOT = 10103; //暂不支持当前银行卡
    const ERROR_BAND_CARD_CREDIT = 10104; //不支持信用卡
    const ERROR_BAND_CARD_DEBIT = 10105; //不支持自动扣款

    const ERROR_TRANS_STATUS = 10200; //还款记录选择错误，请检查状态
    const ERROR_TRANS_AMOUNT = 10201; //还款金额不能小于待还金额
    const ERROR_TRANS_BIZ_RECHARGE = 10202; //调用biz

    //项目推送错误
    const ERROR_PUSH_TO_BIZ_INVALID_TYPE = 12001; //biz系统不支持的项目类型
    const ERROR_INVALID_BAOFU_CARD_TYPE = 12002; //宝付不支持此银行的银行卡
    // 风控信息
    const ERROR_TONGDUN_MODEL_ADD = 11001; //同顿数据添加
    //商户常量配置
    const ERROR_USER_MODEL_ADD = 20000;//添加管理员错误
    const ERROR_MERCHANT_PRODUCT_NULL = 20001;//商户产品为空
    //发送邮件
    const ERROR_EMAIL_SEND = 30001; //邮件发送失败
    //自动审核log记录
    const ERROR_PROCESS_IS_NOT_SET = 40001; //PROCESS_NAME为空
    const ERROR_APPLY_IS_EMPTY = 40002; //申请不存在
    const ERROR_VERIFY_ADD = 40003; //添加错误
    //芝麻信用
    const ERROR_ZHIMA_CREDIT_SUCCESS = 50000; //授权成功
    const ERROR_ZHIMA_CREDIT_FAIL = 50001; //授权失败
    const ERROR_ZHIMA_AMOUNT_EMPTY = 50002; //芝麻用户不存在
    const ERROR_ZHIMA_AMOUNT_NOT_AUTH = 50003; //芝麻用户没有授权
    const ERROR_ZHIMA_REQUEST_QUERY_FAIL = 50004; //获取芝麻参数失败

    const ERROR_NO_PLAN = 60001; // 没有还款计划

    //身份识别
    const ERROR_INDIVIDUAL_LIVING_IDENTITY_PASS = 70001;
    const ERROR_INDIVIDUAL_OCR_INVALID = 70002;
    const ERROR_OCR_NO_OFFICIAL_IDENTITY_PHOTO = 70003; //请识别真实有效的身份证
    const ERROR_OCR_SYSTEM_ERROR = 70004; //OCR系统异常
    const ERROR_LIVING_VERIFY_ERROR = 70005; //活体识别异常

    //上传数据异常
    const ERROR_APP_NEED_PARAM_UNIQUE_ID = 103000;  //设备uniqueid参数缺失
    const ERROR_IMEI_NOT_EXIST = 103001;  //imei不存在
    const ERROR_NEED_AUTHORIZE_LOCATION_IPHONE = 103002;  //未授权位置信息
    const ERROR_NEED_AUTHORIZE_LOCATION_ANDROID = 103003;  //未授权位置信息
    const ERROR_NEED_AUTHORIZE_CONTACTLIST_IPHONE = 103004;  //未授权通讯录信息
    const ERROR_NEED_AUTHORIZE_CONTACTLIST_ANDROID = 103005;  //未授权通讯录信息
    const ERROR_NEED_AUTHORIZE_CALLLIST = 103006;  //未授权通话记录信息
    const ERROR_APP_ID_NEED = 103007;  //App_Id不能为空
    const ERROR_APP_ID_NOT_EXIST = 103008;  //App_Id不存在
    const ERROR_APP_DATA_EMPTY = 103009;  //上报数据不能为空
    const ERROR_APP_UNIQUE_ID_NOT_EXIST = 103010;  //设备unique_id不存在
    const ERROR_APP_VERSION_ABORTED = 103011;  //APP版本已弃用

    //错误码  一：1-贷上钱系统 二：00系统模块 05-申请模块 06-短信模块 07-银行卡模块 08-用户模块 09-还款
    const ERROR_SYSTEM_ERROR = 100001;  //系统异常
    const ERROR_SYSTEM_PARAMS = 100002;  //参数错误-前端问题
    const ERROR_SYSTEM_STATUS = 100003;  //状态异常-前端流程问题
    const ERROR_SYSTEM_RATE_LIMIT = 100009;  //请求过于频繁
    const ERROR_SYSTEM_UP_GRADE = 100010;  //系统正在升级维护

    public static $msg = [
        self::NO_ERROR                                 => '成功',
        self::FAIL                                     => '失败',
        self::UNKOWN                                   => '网络错误',
        self::ERROR_SAVE                               => '保存错误',
        self::ERROR_PARAMS                             => '参数错误',
        self::ERROR_NO_LOGIN                           => '请登录后再操作',
        self::ERROR_INDIVIDUAL_EMPTY                   => '基本信息为空',
        self::ERROR_INDIVIDUAL_MODEL_ADD               => '用户添加信息错误',
        self::ERROR_USER_MODEL_ADD                     => '添加管理员错误',
        self::ERROR_MERCHANT_PRODUCT_NULL              => '商户产品为空',
        self::ERROR_PUSH_TO_BIZ_INVALID_TYPE           => 'biz系统不支持的项目类型',
        self::ERROR_INVALID_BAOFU_CARD_TYPE            => '宝付不支持此银行的银行卡',
        self::ERROR_EMAIL_SEND                         => '邮件发送失败',
        self::ERROR_APPLY_CODE_EMPTY                   => '合同编号为空',
        self::ERROR_APPLY_GRANT_STATUS                 => '放款状态已更新,不能重复推送',
        self::ERROR_PROCESS_IS_NOT_SET                 => '当前process_name没有设置',
        self::ERROR_APPLY_IS_EMPTY                     => '申请不存在',
        self::ERROR_APPLY_REPAY_EMPTY                  => '还款纪录不存在',
        self::ERROR_APPLY_EMPTY                        => '订单不存在',
        self::ERROR_VERIFY_ADD                         => '添加错误',
        self::ERROR_ZHIMA_CREDIT_SUCCESS               => '授权成功',
        self::ERROR_ZHIMA_CREDIT_FAIL                  => '授权失败',
        self::ERROR_ZHIMA_AMOUNT_EMPTY                 => '芝麻用户不存在',
        self::ERROR_ZHIMA_AMOUNT_NOT_AUTH              => '未授权',
        self::ERROR_BAND_CARD_NUM                      => '银行卡格式不正确',
        self::ERROR_APPLY_PHONE_ADD                    => '手机号格式不正确',
        self::ERROR_BAND_CARD_PHONE                    => '银行卡对应手机号不正确',
        self::ERROR_BAND_CARD_INFO                     => '银行卡信息获取失败，请检查卡号是否输入正确或重试',
        self::ERROR_BAND_CARD_CANNOT                   => '暂不支持当前银行卡',
        self::ERROR_BAND_CARD_CREDIT                   => '暂不支持信用卡',
        self::ERROR_BAND_CARD_DEBIT                    => '您绑定的银行卡暂不支持自动还款，您可以先使用该卡提交资料，在审核通过后我们会以短信提醒您更换银行卡。',
        self::ERROR_APPLY_WORK_PHONE                   => '工作电话格式不正确',
        self::ERROR_VERIFICATION                       => '您输入的验证码有误',
        self::ERROR_TRANS_STATUS                       => '还款记录选择错误，请检查状态',
        self::ERROR_TRANS_AMOUNT                       => '还款金额不能小于待还金额',
        self::ERROR_TRANS_BIZ_RECHARGE                 => '系统繁忙稍后再试',
        self::ERROR_OUT_OF_LIMIT                       => '最大申请金额不能大于8万元',

        self::ERROR_ZHIMA_REQUEST_QUERY_FAIL           => '系统繁忙稍后再试',
        self::ERROR_DATABASE                           => '系统繁忙稍后再试',
        self::ERROR_DATABASE_START_TRANS               => '系统繁忙稍后再试',
        self::ERROR_DATABASE_NOT_TRANS                 => '系统繁忙稍后再试',
        self::ERROR_NO_PLAN                            => '没有新的还款计划',

        self::ERROR_NOT_FORBIDDEN                      => "您的快分期APP版本过低，请升级，如果升级遇到问题，请联系客服：%s\n您的版本:%s\n",

        //app设备相关
        self::ERROR_APP_NEED_PARAM_UNIQUE_ID           => '设备uniqueid参数缺失',
        self::ERROR_IMEI_NOT_EXIST                     => 'imei不存在',
        self::ERROR_NEED_AUTHORIZE_LOCATION_IPHONE     => '请在设置中允许“贷上钱”访问您的位置信息，否则无法申请贷款',
        self::ERROR_NEED_AUTHORIZE_LOCATION_ANDROID    => '请在设置 - 应用列表 - 贷上钱 - 权限中允许“贷上钱”访问您的位置信息，否则无法申请贷款',
        self::ERROR_NEED_AUTHORIZE_CONTACTLIST_IPHONE  => '请在“设置-隐私-定位服务(通讯录)”允许“贷上钱”访问您的位置信息(通讯录)，否则无法申请贷款',
        self::ERROR_NEED_AUTHORIZE_CONTACTLIST_ANDROID => '请在设置 - 应用列表 - 贷上钱 - 权限中允许“贷上钱”访问您的通讯录，否则无法申请贷款',
        self::ERROR_NEED_AUTHORIZE_CALLLIST            => '请在设置 - 应用列表 - 贷上钱 - 权限中允许“贷上钱”访问您的通讯信息，否则无法申请贷款',
        self::ERROR_APP_ID_NEED                        => 'App_Id不能为空',
        self::ERROR_APP_ID_NOT_EXIST                   => 'X-App-Id不存在',
        self::ERROR_APP_DATA_EMPTY                     => '上报数据不能为空',
        self::ERROR_APP_UNIQUE_ID_NOT_EXIST            => '设备unique_id不存在',
        self::ERROR_APP_VERSION_ABORTED                => '请下载升级最新版本APP',

        self::ERROR_SYSTEM_ERROR                       => '系统繁忙，请稍后重试',
        self::ERROR_SYSTEM_PARAMS                      => '参数错误',
        self::ERROR_SYSTEM_STATUS                      => '您的状态异常，请重试',
        self::ERROR_SYSTEM_RATE_LIMIT                  => '您的操作过于频繁，请重试',
        self::ERROR_SYSTEM_UP_GRADE                    => '系统正在升级维护,请稍候再操作',
        //身份识别
        self::ERROR_INDIVIDUAL_LIVING_IDENTITY_PASS    => '您已识别',
        self::ERROR_INDIVIDUAL_OCR_INVALID             => '请先进行ocr识别',
        self::ERROR_OCR_NO_OFFICIAL_IDENTITY_PHOTO     => '请识别真实有效的身份证',
        self::ERROR_OCR_SYSTEM_ERROR                   => 'OCR系统异常',
        self::ERROR_LIVING_VERIFY_ERROR                => '人脸识别失败，请稍后重试',
    ];

    /**
     * 根据定义的错误码来显示错误消息，支持sprintf来渲染参数
     * @param int $code
     * @return string
     */
    public static function msg($code)
    {
        $msg = '系统正忙，请稍后重试';
        if (isset(self::$msg[$code])) {
            $msg = self::$msg[$code];
            $num = func_num_args();
            if ($num > 1) {
                $msg = vsprintf($msg, array_slice(func_get_args(), 1));
            }
        }

        return $msg;
    }
}
