<?php

/* @var $model app\models\RegisterForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'surname')->label('Surname') ?>
    <?= $form->field($model, 'name')->label('Name') ?>
    <?= $form->field($model, 'email')->label('Email') ?>
    <?= $form->field($model, 'password')->passwordInput()->label('Password') ?>
    <?= $form->field($model, 'confirmPassword')->passwordInput()->label('Confirm password') ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
