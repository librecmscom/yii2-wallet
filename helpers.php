<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

/**
 * 变更指定用户钱包 + 钱或 - 钱
 * @param int $user_id
 * @param string $currency
 * @param double $money
 * @param string $action
 * @param string $msg
 * @return bool
 */
if (!function_exists('wallet')) {
    function wallet($user_id, $currency, $money, $action = '', $msg = '')
    {
        /** @var \yuncms\wallet\Module $wallet */
        $wallet = Yii::$app->getModule('wallet');
        return $wallet->wallet($user_id, $currency, $money, $action, $msg);
    }
}