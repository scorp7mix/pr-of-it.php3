<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1460395258_addNameFieldsToUsers
    extends Migration
{

    public function up()
    {
        $this->addColumn('users', [
            'firstName'  => ['type' => 'string'],
            'secondName' => ['type' => 'string'],
            'lastName'   => ['type' => 'string'],
        ]);

        $this->db->execute('UPDATE `users` SET `firstName` = `name`');

        $this->dropColumn('users', ['name']);
    }

    public function down()
    {
        $this->addColumn('users', [
            'name' => ['type' => 'string'],
        ]);

        $this->db->execute('UPDATE `users` SET `name` = CONCAT_WS(" ", `firstName`, `secondName`, `lastName`)');

        $this->dropColumn('users', ['firstName', 'secondName', 'lastName']);
    }

}