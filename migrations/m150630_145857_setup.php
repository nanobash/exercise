<?php

use yii\db\Schema;
use yii\db\Migration;

class m150630_145857_setup extends Migration
{
    public function up()
    {
		$this->createTable('Users',[
			'userId' => Schema::TYPE_PK,
			'firstName' => Schema::TYPE_TEXT . ' NOT NULL',
			'lastName' => Schema::TYPE_TEXT . ' NOT NULL',
			'email' => Schema::TYPE_TEXT . ' NOT NULL',
            'personalCode' => Schema::TYPE_BIGINT . ' NOT NULL',
			'phone' => Schema::TYPE_BIGINT . ' NOT NULL',
			'active' => Schema::TYPE_BOOLEAN,
            'isDead' => Schema::TYPE_BOOLEAN,
			'lang' => Schema::TYPE_TEXT
        ]);

	    $this->createTable('Loans',[
		    'loanId' => Schema::TYPE_PK,
		    'userId' => Schema::TYPE_BIGINT . ' NOT NULL',
		    'amount' => 'NUMERIC( 10, 2 ) NOT NULL',
		    'interest' => 'NUMERIC( 10, 2 ) NOT NULL',
		    'duration' => Schema::TYPE_INTEGER . ' NOT NULL',
		    'dateApplied' => Schema::TYPE_DATE . ' NOT NULL',
		    'dateLoanEnds' => Schema::TYPE_DATE . ' NOT NULL',
		    'campaign' => Schema::TYPE_INTEGER . ' NOT NULL',
		    'status' => Schema::TYPE_BOOLEAN
	    ]);

    }

    public function down()
    {
	    $this->dropTable('Users');
	    $this->dropTable('Loans');
    }

}
