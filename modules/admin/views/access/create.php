<?php

use yii\helpers\Html;
use app\objects\ViewModels\AccessCreateView;


/* @var $this yii\web\View */
/* @var $model app\models\Access */
/* @var $viewModel AccessCreateView */

$this->title = 'Create Access';
$this->params['breadcrumbs'][] = ['label' => 'Accesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="access-create">


    <?= $this->render('_form', [
        'model' => $model,
        'viewModel' => $viewModel,
    ]) ?>

</div>
