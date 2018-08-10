<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $viewModel \app\objects\ViewModels\EventView */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=\yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'viewParams' => [
             'viewModel' => $viewModel,
        ],
        'layout' => "{summary}<div class='flex row'>{items}</div>{pager}",
        'itemView' => '_item',
    ]);?>
</div>
