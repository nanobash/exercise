<?php

namespace app\controllers;

use app\models\Users;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;

class BaseController extends Controller
{
    public $layout = 'base';

    public function init()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
    }

    public function actionLoans()
    {

    }

    public function actionContent()
    {

    }

    public function actionUsers()
    {
        $query = new Query();
        $provider = new ActiveDataProvider([
            'query' => $query->from('Users'),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('users_grid', [
            'provider' => $provider,
        ]);
    }

    public function actionUserUpdate($userId = '')
    {
        $saved = 0;

        if ('' !== $userId) {
            $user = Users::find()->where(['userId' => $userId])->one();
        } else {
            $user = new Users();
        }

        if ($user->load(Yii::$app->request->post()) && $user->validate()) {
            if ($user->save()) {
                $saved = 1;
            } else {
                $saved = 2;
            }
        }

        return $this->render('users_form', [
            'user' => $user,
            'success' => $saved,
            'update' => true,
        ]);
    }

    public function actionUserDelete($userId)
    {
        $saved = 0;

        if (Yii::$app->request->post()) {
            $user = Users::find()->where(['userId' => $userId])->one();

            if (null === $user) {
                return $this->redirect(['base/users'], 302);
            }

            if ($user->delete()) {
                $saved = 1;
            } else {
                $saved = 2;
            }
        }

        return $this->render('users_form', [
            'success' => $saved,
            'update' => false,
            'userId' => $userId,
        ]);
    }
}
