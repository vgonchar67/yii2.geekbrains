<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
/* @var $viewModel \app\objects\ViewModels\EventCreateView */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_at')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'end_at')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'users')
        ->checkboxList($viewModel->getUserOptions(), ['separator' => '<br/>',])
        ->label('Пользователи')
        ->hint('Пользователи, которые будут иметь доступ к заметке');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
