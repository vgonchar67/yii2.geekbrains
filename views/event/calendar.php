<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $calendar array */

$this->title = 'Календарь';
$this->params['breadcrumbs'][] = $this->title;
?>



<table border=1 class="calendar">
    <thead>
    <tr>
        <th>Пн</th>
        <th>Вт</th>
        <th>Ср</th>
        <th>Чт</th>
        <th>Пт</th>
        <th>Сб</th>
        <th>Вс</th>
    </tr>
    </thead>
    <tbody>
<?php foreach($calendar as $week):?>
    <tr>
    <?php for($i=1; $i<=7; $i++):?>
        <?php if(!empty($week[$i])):?>
            <td <?= ($week[$i]['current']? 'class="current"' : '')?>>
                <div class="date-num">
                    <?= $week[$i]['num']?>
                </div>
                <?php if(!empty($week[$i]['events'])): ?>
                    Событий: <?=count($week[$i]['events'])?>
                <?php endif;?>
            </td>
        <?php else:?>
            <td></td>
        <?php endif;?>
    <?php endfor;?>
    </tr>
<?php endforeach;?>
    </tbody>
</table>
