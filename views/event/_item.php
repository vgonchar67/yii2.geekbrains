<?php
use app\models\Event;
use \yii\helpers\Html;
/* @var $model Event */
/* @var $viewModel \app\objects\ViewModels\EventView */
$name = \yii\helpers\Html::encode($model->name);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <b><?=\yii\helpers\Html::a($name, ['event/view', 'id' => $model->id]);?></b>
    </div>

    <div class="panel-body">
        <p>Автор: <?=$model->author->username?></p>
        <p>Начало: <?=\Yii::$app->formatter->asDate($model->start_at);?></p>
        <p>Конец: <?=\Yii::$app->formatter->asDate($model->end_at);?></p>
        <p>Создано: <?=\Yii::$app->formatter->asDateTime($model->created_at);?></p>
        <p>Обновлено: <?=\Yii::$app->formatter->asDateTime($model->updated_at);?></p>
        <?php if ($model->updatable): ?>
            <p class="text-right">
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Удалить событие?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        <?php endif;?>
    </div>
</div>
