<?php

use \yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\Html;

echo GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        [
            'class' => '\kartik\grid\SerialColumn',
            'header' => 'ID',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'Loan ID',
            'value' => function ($data) {
                return (int) $data['loanId'];
            },
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'User ID',
            'value' => function ($data) {
                return (int) $data['userId'];
            },
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'Amount',
            'value' => function ($data) {
                return $data['amount'];
            },
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'Interest',
            'value' => function ($data) {
                return $data['interest'];
            },
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'Duration',
            'value' => function ($data) {
                return $data['duration'];
            },
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'Date Applied',
            'value' => function ($data) {
                return $data['dateApplied'];
            },
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'Date Loan Ends',
            'value' => function ($data) {
                return $data['dateLoanEnds'];
            },
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'Campaign',
            'value' => function ($data) {
                return $data['campaign'];
            },
        ],
        [
            'class' => '\kartik\grid\BooleanColumn',
            'attribute' => 'Status',
            'value' => function ($data) {
                return ($data['status'] ? 1 : 0);
            },
        ],
        [
            'class' => '\kartik\grid\ActionColumn',
            'width' => '100px',
            'viewOptions' => [
                'label' => null,
            ],
            'buttons' => [
                'update' => function($url, $model) {
                    return '<a href="' . Url::base() . '/index.php/base/loan-update/' . $model['loanId'] . '"><i class="glyphicon glyphicon-pencil"></i></a>';
                },
                'delete' => function($url, $model) {
                    return '<a href="' . Url::base() . '/index.php/base/loan-delete/' . $model['loanId'] . '"><i class="glyphicon glyphicon-remove"></i></a>';
                }
            ]
        ],
    ],
    'responsive' => true,
    'hover' => true,
    'resizableColumns' => true,
    'panel' => [
        'heading'=>'<h2 class="panel-title">Users</h2>',
    ],
    'toolbar' => [
        [
            'content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['loan-update'], [
                    'type'=>'button',
                    'title'=>'Add User',
                    'class'=>'btn btn-success'
                ]) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['loans'], [
                    'class' => 'btn btn-default',
                    'title' => 'Reset Grid',
                ]),
        ],
        '{export}',
        '{toggleData}'
    ],
]);
