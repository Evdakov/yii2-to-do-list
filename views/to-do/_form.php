<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ToDo */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'id' => 'to-do-form',
    'action' => $model->isNewRecord ? '/' . Yii::$app->controller->id . '/create' : '/' . Yii::$app->controller->id . '/update?id=' . $model->id,
    'options' => ['class' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data'],
    'fieldConfig' => [
        'template' => "{label}\n{input}\n{error}"
    ]
]); ?>

    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $form->field($model, 'caption'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $form->field($model, 'description')->textarea(['rows' => 8]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $form->field($model, 'priority')->dropDownList(\app\models\ToDo::$priorityValues); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9 text-right form_submit">
            <input type="submit" class="btn btn-block btn-success" name="save-button" value="<?php echo $model->isNewRecord ? 'Добавить задачу' : 'Сохранить задачу'; ?>">

        </div>
    </div>
<?php ActiveForm::end(); ?>