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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'start_at:date',
            'end_at:date',
            'created_at:datetime',
            'updated_at:datetime',
            'author_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'update' => function($model) use ($viewModel) {
                       return $viewModel->canWrite($model) && !$model->isPast();
                    },
                    'delete' => function($model) use ($viewModel) {
                        return $viewModel->canWrite($model);
                    },
                ]
            ],
        ],
    ]); ?>
</div>
