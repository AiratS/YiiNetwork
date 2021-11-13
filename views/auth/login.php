<?php

/* @var $model app\models\RegisterForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'email')->label('Email') ?>
    <?= $form->field($model, 'password')->label('Password')->passwordInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>

