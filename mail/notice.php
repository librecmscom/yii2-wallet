<?php
use yii\helpers\Html;

/**
 * @var \yuncms\user\models\User $user
 */
/** @var string $message */
?>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('wallet', 'Dear') ?> <?=Html::encode($user->username)?>：
</p>

<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Html::encode($message); ?>
</p>
