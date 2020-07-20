<?php

namespace app\controllers;

use app\models\ToDo;
use yii\db\Expression;
use yii\web\Controller;
use Yii;

class ToDoController extends Controller
{

    public function actionIndex():string
    {
        $searchModel = new ToDo();
        $searchModel->load(Yii::$app->request->queryParams);

        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Страница создания задачи
     * Если задача сохранена успешно, то произойдет редирект на страницу публикации
     */
    public function actionCreate()
    {
        $model = new ToDo();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Редактирование задачи
     * Если редактирование успешно, то произойдет редирект на страницу задач
     *
     * @param integer $id
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * Задача выполнена
     * Если редактирование успешно, то произойдет редирект на страницу задач
     *
     * @param integer $id
     */
    public function actionComplete(int $id)
    {
        $model = $this->findModel($id);

        $model->is_complete = true;
        $model->complete_date = new Expression('NOW()');

        if ($model->validate() && $model->save()) {
            return $this->redirect(['index']);
        }

        throw new NotFoundHttpException('Указанная задача не найдена.');
    }

    /**
     * Удаление задачи
     * Если удаление успешно, то произойдет редирект на страницу списка задач
     *
     * @param integer $id
     */
    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = ToDo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Указанная задача не найдена.');
        }
    }
}