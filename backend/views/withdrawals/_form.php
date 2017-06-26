<?php
use yii\helpers\Html;
use xutl\inspinia\ActiveForm;
use yuncms\wallet\models\Withdrawals;

/* @var \yii\web\View $this */
/* @var Withdrawals $model */
/* @var ActiveForm $form */
?>
<?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableAjaxValidation' => true, 'enableClientValidation' => false,]); ?>

<?= $form->field($model, 'bankcard_id')->textInput() ?>
<div class="hr-line-dashed"></div>

<?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>
<div class="hr-line-dashed"></div>

<?= $form->field($model, 'money')->textInput(['maxlength' => true]) ?>
<div class="hr-line-dashed"></div>

<?= $form->field($model, 'status')->inline()->radioList([
    Withdrawals::STATUS_PENDING => Yii::t('wallet', 'Pending'),
    Withdrawals::STATUS_REJECTED => Yii::t('wallet', 'Rejected'),
    Withdrawals::STATUS_DONE => Yii::t('wallet', 'Done'),
]) ?>
<div class="hr-line-dashed"></div>


<div class="form-group">
    <div class="col-sm-4 col-sm-offset-2">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('wallet', 'Create') : Yii::t('wallet', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

