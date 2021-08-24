<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSecretsTable extends Migration
{

	protected $tableName = 'secrets';

	public function up()
	{
		$this->forge->addField([
			'secret_id' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'hash' => [
				'type'       	=> 'text',
			],
			'secretText'       	=> [
				'type'      	=> 'text',
			],
			'createdAt datetime default current_timestamp',
			'expiresAt' => [
				'type'      	=> 'datetime',
				'null' 			=> true
			],
			'remainingViews' => [
				'type'      	=> 'int',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 			=> false
			]
		]);
		$this->forge->addKey('secret_id', true);
		$this->forge->createTable($this->tableName);
	}

	public function down()
	{
		$this->forge->dropTable($this->tableName);
	}
}
