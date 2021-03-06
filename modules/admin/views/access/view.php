<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Access */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="access-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user',
                'value' => function(\app\models\Access $model){
                    return Html::a($model->user->username, ['user/view', 'id' => $model->user->id]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'event',
                'value' => function(\app\models\Access $model){
                    return Html::a($model->event->name, ['user/view', 'id' => $model->event->id]);
                },
                'format' => 'raw',
            ],
        ],
    ]) ?>

</div>
