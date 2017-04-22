<?php

use yii\helpers\Html;
use xutl\inspinia\ActiveForm;

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

    <?= $form->field($model, 'bankcard_id', [
        'inputOptions' => [
            'placeholder' => $model->getAttributeLabel('bankcard_id'),
        ],
    ]) ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'money') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
