<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Access */
/* @var $viewModel \app\objects\ViewModels\AccessCreateView */

$this->title = 'Update Access: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="access-update">

    <?= $this->render('_form', [
        'model' => $model,
        'viewModel' => $viewModel,
    ]) ?>

</div>
