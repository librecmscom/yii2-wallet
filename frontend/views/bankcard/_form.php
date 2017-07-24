<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yuncms\wallet\models\Bankcard */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',

]); ?>

<?= $form->field($model, 'bank')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('wallet', 'Create') : Yii::t('wallet', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>


