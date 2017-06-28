<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Users".
 *
 * @property integer $userId
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property integer $personalCode
 * @property integer $phone
 * @property boolean $active
 * @property boolean $isDead
 * @property string $lang
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'email', 'personalCode', 'phone'], 'required'],
            [['firstName', 'lastName', 'email', 'lang'], 'string'],
            [['personalCode', 'phone'], 'integer'],
            [['active', 'isDead'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
            'personalCode' => 'Personal Code',
            'phone' => 'Phone',
            'active' => 'Active',
            'isDead' => 'Is Dead',
            'lang' => 'Lang',
        ];
    }
}
