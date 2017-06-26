<?php
use yii\helpers\Html;
use xutl\inspinia\Box;
use xutl\inspinia\Toolbar;
use xutl\inspinia\Alert;

use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yuncms\payment\models\Payment;
use yuncms\wallet\models\Wallet;

/** @var Wallet $wallet */
/** @var \yuncms\payment\GatewayInterface[] $gateways */
$gateways = Yii::$app->getModule('payment')->gateways;

$this->title = Yii::t('wallet', 'Recharge Wallet') . ': ' . $wallet->currency;
$this->params['breadcrumbs'][] = ['label' => Yii::t('wallet', 'Manage Wallet'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $wallet->id, 'url' => ['view', 'id' => $wallet->id]];
$this->params['breadcrumbs'][] = Yii::t('wallet', 'Recharge');
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 wallet-create">
            <?= Alert::widget() ?>
            <?php Box::begin([
                'header' => Html::encode($this->title),
            ]); ?>
            <div class="row">
                <div class="col-sm-4 m-b-xs">
                    <?= Toolbar::widget(['items' => [
                        [
                            'label' => Yii::t('wallet', 'Manage Wallet'),
                            'url' => ['index'],
                        ],
                        [
                            'label' => Yii::t('wallet', 'Create Wallet'),
                            'url' => ['create'],
                        ],
                    ]]); ?>
                </div>
                <div class="col-sm-8 m-b-xs">

                </div>
            </div>
            <?php $form = ActiveForm::begin([
                'layout' => 'horizontal'
            ]); ?>
            <?= Html::activeInput('hidden', $model, 'user_id', ['value' => $wallet->user_id]) ?>
            <?= Html::activeInput('hidden', $model, 'currency', ['value' => $wallet->currency]) ?>
            <?= $form->field($model, 'money'); ?>
            <?= $form->field($model, 'msg'); ?>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                    <?= Html::submitButton(Yii::t('wallet', 'Recharge'), ['class' => 'btn btn-success']) ?>
                    <br>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php Box::end(); ?>
        </div>
    </div>
</div>