<?php

use yii\grid\GridView;

/* @var $searchModel app\models\ToDo */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div id="main-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-white">
                <div class="panel-body">

                        <a href="<?php echo "/".Yii::$app->controller->id."/create"; ?>"  class="btn btn-success btn-addon m-b-sm">
                            <i class="fa fa-plus"></i>Добавить задачу</a>
                        </a>
                    </p>

                    <?php echo GridView::widget([
                        'layout' => "{items}\n"
                            ."<div class='row admin_table_footer'>"
                                ."<div class='col-lg-6 col-md-12 col-sm-12 admin_pagination'>{pager}</div>"
                                ."<div class='col-lg-6 col-md-12 col-sm-12 admin_summary'>{summary}</div>"
                            ."</div>",
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'id',
                            'caption',
                            'description',
                            [
                                'attribute' => 'complete_date',
                                'format' => 'raw',
                                'value' => function($model):string
                                {
                                    return $model->complete_date ? date('d.m.Y H:i:s', strtotime($model->complete_date)) : '&mdash;';
                                }
                            ],
                            [
                                'attribute' => 'priority',
                                'value' => function($model):string
                                {
                                    return \app\models\ToDo::$priorityValues[$model->priority] ?? '';
                                }
                            ],
                            [
                                'attribute' => 'is_complete',
                                'value' => function($model):string
                                {
                                    return $model->is_complete ? 'Выполнена' : 'Не выполнена';
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update} {delete} {complete}',
                                'buttons' => [
                                    'complete' => function ($url, $model, $key):string
                                    {
                                        return !$model->is_complete
                                            ? \yii\helpers\Html::a('Выполнить', $url, ['class' => 'btn btn-success btn-xs'])
                                            : '';
                                    },
                                ],
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>