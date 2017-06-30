<?php

use \yii\helpers\Url;
use app\components\MyComponent;
use kartik\grid\GridView;
use yii\helpers\Html;

$user = new \app\models\Users();

echo GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        [
            'class' => '\kartik\grid\SerialColumn',
            'header' => 'ID',
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
            'attribute' => 'First Name',
            'value' => function ($data) {
                return $data['firstName'];
            },
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'Last Name',
            'value' => function ($data) {
                return $data['lastName'];
            },
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'Age',
            'value' => function ($data) {
                return MyComponent::getAgeFromPersonCode($data['personalCode']);
            },
        ],
        [
            'class' => '\kartik\grid\BooleanColumn',
            'attribute' => 'Underage',
            'value' => function ($data) {
                return (MyComponent::getAgeFromPersonCode($data['personalCode']) >= 18 ? 0 : 1 );
            },
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'Email',
            'value' => function ($data) {
                return $data['email'];
            },
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'Personal Code',
            'value' => function ($data) {
                return $data['personalCode'];
            },
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'Phone',
            'value' => function ($data) {
                return $data['phone'];
            },
        ],
        [
            'class' => '\kartik\grid\BooleanColumn',
            'attribute' => 'Active',
            'value' => function ($data) {
                return ($data['active'] ? 1 : 0);
            },
        ],
        [
            'class' => '\kartik\grid\BooleanColumn',
            'attribute' => 'Is Dead',
            'value' => function ($data) {
                return ($data['isDead'] ? 1 : 0);
            },
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'Language',
            'value' => function ($data) {
                return $data['lang'];
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
                    return '<a href="' . Url::base() . '/index.php/base/user-update/' . $model['userId'] . '"><i class="glyphicon glyphicon-pencil"></i></a>';
                },
                'delete' => function($url, $model) {
                    return '<a href="' . Url::base() . '/index.php/base/user-delete/' . $model['userId'] . '"><i class="glyphicon glyphicon-remove"></i></a>';
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
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['user-update'], [
                    'type'=>'button',
                    'title'=>'Add User',
                    'class'=>'btn btn-success'
                ]) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['users'], [
                    'class' => 'btn btn-default',
                    'title' => 'Reset Grid',
                ]),
        ],
        '{export}',
        '{toggleData}'
    ],
]);
