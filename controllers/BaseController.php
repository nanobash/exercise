<?php

namespace app\controllers;

use app\models\Loans;
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
        $query = new Query();
        $provider = new ActiveDataProvider([
            'query' => $query->from('Loans'),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('loans_grid', [
            'provider' => $provider,
        ]);
    }

    public function actionLoanUpdate($loanId = '')
    {
        $saved = 0;

        if ('' !== $loanId) {
            $loan = Loans::find()->where(['loanId' => $loanId])->one();
        } else {
            $loan = new Loans();
        }

        if ($loan->load(Yii::$app->request->post()) && $loan->validate()) {
            if ($loan->save()) {
                $saved = 1;

                if ('' === $loanId) {
                    $loan = new Loans();
                }
            } else {
                $saved = 2;
            }
        }

        return $this->render('loans_form', [
            'loan' => $loan,
            'success' => $saved,
            'update' => true,
        ]);
    }

    public function actionLoanDelete($loanId)
    {
        $saved = 0;

        if (Yii::$app->request->post()) {
            $loan = Loans::find()->where(['loanId' => $loanId])->one();

            if (null === $loan) {
                return $this->redirect(['base/loans'], 302);
            }

            if ($loan->delete()) {
                $saved = 1;
            } else {
                $saved = 2;
            }
        }

        return $this->render('loans_form', [
            'success' => $saved,
            'update' => false,
            'loanId' => $loanId,
        ]);
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

                if ('' === $userId) {
                    $user = new Users();
                }
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
