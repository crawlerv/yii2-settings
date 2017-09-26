<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => \Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(\Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(\Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => \Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'key',
            'value',
            [
                'attribute' => 'status',
                'value' => \common\helpers\StatusHelper::getStatus($model->status),
            ],
            [
                'attribute' => 'create_date',
                'value' => date('d-m-Y H:i:s', $model->create_date),
            ],
            [
                'attribute' => 'update_date',
                'value' => date('d-m-Y H:i:s', $model->update_date),
            ],
        ],
    ]) ?>

</div>
