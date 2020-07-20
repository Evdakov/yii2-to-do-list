<?php
/* @var $this yii\web\View */
/* @var $model app\models\ToDo */

$this->title = 'Редактирование задачи #' . $model->id;

$this->params['breadcrumbs'][] = ['url' => 'index', 'label' => 'Pадачи'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="main-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <?php echo $this->render('_form', [
                        'model' => $model
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>