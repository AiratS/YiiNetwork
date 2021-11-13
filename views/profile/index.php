<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/**
 * @var \app\models\ProfileForm $model
 */
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'surname')->label('Surname') ?>
<?= $form->field($model, 'name')->label('Name') ?>
<?= $form->field($model, 'email')->textInput(['readonly' => true])->label('Email') ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="form-group">
        <?= Html::a('Delete profile', ['profile/DeleteProfile'], ['class' => 'btn btn-danger']) ?>
    </div>
<?php ActiveForm::end(); ?>