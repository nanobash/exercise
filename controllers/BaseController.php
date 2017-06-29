<?php

namespace app\controllers;

use yii\web\Controller;

class BaseController extends Controller
{
    public $layout = 'base';

    public function actionContent()
    {
        return $this->render('content.twig', []);
    }

    public function actionLoans()
    {
        return $this->render('content.twig', [
            'twigFile' => 'loansGrid.twig',
        ]);
    }

    public function actionUsers()
    {
        return $this->render('content.twig', [
            'twigFile' => 'usersGrid.twig',
        ]);
    }
}
