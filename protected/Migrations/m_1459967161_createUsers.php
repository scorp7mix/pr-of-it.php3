<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1459967161_createUsers
    extends Migration
{

    public function up()
    {
        $this->createTable('users', [
            'email'    => ['type' => 'string'],
            'password' => ['type' => 'string'],
            'name'     => ['type' => 'string', 'length' => 100],
        ], [
            'email_idx' => ['type' => 'unique', 'columns' => ['email']],
        ]);

        $this->insert('users', [
            'email'    => 'admin@adverplat.ru',
            'password' => '$2y$10$Vc0Cau255QFP007ebEzFpeWR.1rL/NZIDKk0uy2xo/FcaAWd8u/9S',
            'name'     => 'Администратор',
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }

}