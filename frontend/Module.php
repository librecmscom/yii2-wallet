<?php

namespace yuncms\wallet\frontend;

use Yii;
use yii\base\InvalidConfigException;
use yuncms\wallet\models\Wallet;
use yuncms\wallet\models\WalletLog;

/**
 * Class Module
 * @package yuncms\wallet
 */
class Module extends \yuncms\wallet\Module
{
    public $controllerNamespace = 'yuncms\wallet\frontend\controllers';
    
    public $defaultRoute = 'wallet';
}
