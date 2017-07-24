<?php

namespace yuncms\wallet\backend;

use Yii;
use yii\base\InvalidConfigException;


/**
 * Class Module
 * @package yuncms\wifi
 */
class Module extends \yuncms\wallet\Module
{
    public $controllerNamespace = 'yuncms\wallet\backend\controllers';

    public $defaultRoute = 'wallet';
}
