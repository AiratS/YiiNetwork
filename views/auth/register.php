<?php

/* @var $model app\models\RegisterForm */
/* @var $link string */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>

<h2><?= $this->title ?></h2>

<?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin(['options' => ['data' => ['pjax' => true]]]); ?>
        <?= $form->field($model, 'surname')->label('Surname') ?>
        <?= $form->field($model, 'name')->label('Name') ?>
        <?= $form->field($model, 'email')->label('Email') ?>
        <?= $form->field($model, 'password')->label('Password')->passwordInput() ?>
        <?= $form->field($model, 'confirmPassword')->label('Confirm password')->passwordInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Register', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php if ($link) { ?>
            <?= Html::a('Verify email', $link, ['class' => 'profile-link']) ?>
        <?php } ?>
    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
