<?php

namespace app\commands;

use app\models\Loans;
use app\models\Users;
use yii\console\Controller;
use yii\helpers\Json;

class ImportController extends Controller
{
    public function actionUsers($fileName = 'users.json')
    {
        $users = Json::decode(file_get_contents($fileName));

        foreach ($users as $item) {
            $user = new Users();

            $user->userId = $item['userId'];
            $user->firstName = $item['firstName'];
            $user->lastName = $item['lastName'];
            $user->email = $item['email'];
            $user->personalCode = $item['personalCode'];
            $user->phone = $item['phone'];
            $user->active = $item['active'];
            $user->isDead = $item['isDead'];
            $user->lang = $item['lang'];

            echo ($user->save() ? $user->userId . ' : OK ' : $user->userId . ' : Failed') . PHP_EOL;
        }
    }

    public function actionLoans($fileName = 'loans.json')
    {
        $loans = Json::decode(file_get_contents($fileName));

        foreach ($loans as $item) {
            $loan = new Loans();

            $loan->loanId = $item['loanId'];
            $loan->userId = $item['userId'];
            $loan->amount = $item['amount'];
            $loan->interest = $item['interest'];
            $loan->duration = $item['duration'];
            $loan->dateApplied = date('Y-m-d', $item['dateApplied']);
            $loan->dateLoanEnds = date('Y-m-d', $item['dateLoanEnds']);
            $loan->campaign = $item['campaign'];
            $loan->status = (0 === $item['status']) ? false : true;

            echo ($loan->save() ? $loan->loanId . ' : OK ' : $loan->loanId . ' : Failed') . PHP_EOL;
        }
    }
}
