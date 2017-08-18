<?php
use yii\helpers\Html;
/**
 * @var \yuncms\user\models\User $user
 */
/** @var string $message */
?>
<?= Yii::t('wallet', 'Dear') ?> <?=Html::encode($user->username)?>：

<?= $message; ?>


