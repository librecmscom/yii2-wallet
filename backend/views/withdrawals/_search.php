<?php

use yii\helpers\Html;
use xutl\inspinia\ActiveForm;
use yuncms\wallet\models\Withdrawals;

/* @var $this yii\web\View */
/* @var $model yuncms\wallet\backend\models\WithdrawalsSearch */
/* @var $form ActiveForm */
?>

<div class="withdrawals-search pull-right">

    <?php $form = ActiveForm::begin([
        'layout' => 'inline',
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', [
        'inputOptions' => [
            'placeholder' => $model->getAttributeLabel('id'),
        ],
    ]) ?>

    <?= $form->field($model, 'user_id', [
        'inputOptions' => [
            'placeholder' => $model->getAttributeLabel('user_id'),
        ],
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        Withdrawals::STATUS_PENDING => Yii::t('wallet', 'Pending'),
        Withdrawals::STATUS_REJECTED => Yii::t('wallet', 'Rejected'),
        Withdrawals::STATUS_DONE => Yii::t('wallet', 'Done'),
    ]) ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'money') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
