<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\wallet\models;

use yii\base\Model;

class RechargeForm extends Model
{
    /**
     * @var string User email address
     */
    public $email;
    /**
     * @var string Username
     */
    public $username;
    /**
     * @var string Password
     */
    public $password;

    /**
     * @var bool 是否同意注册协议
     */
    public $registrationPolicy;

    /**
     * @var string 验证码
     */
    public $verifyCode;
}