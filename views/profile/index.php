<?php

/* @var $this yii\web\View */
/* @var $model app\models\ProfileForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'surname')->label('Surname') ?>
    <?= $form->field($model, 'name')->label('Name') ?>
    <?= $form->field($model, 'email')->textInput(['readonly' => true])->label('Email') ?>
    <div class="form-group">
        <?= Html::submitButton('Save changes', ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="form-group">
        <?= Html::a('Delete profile', ['profile/delete-profile'], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete your profile?',
                'method' => 'post',
            ]
        ]) ?>
    </div>
<?php ActiveForm::end(); ?>
