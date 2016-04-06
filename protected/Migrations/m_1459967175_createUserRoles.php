<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1459967175_createUserRoles
    extends Migration
{

    public function up()
    {
        $this->createTable('user_roles', [
            'name'  => ['type' => 'string'],
            'title' => ['type' => 'string'],
        ], [
            'name_idx' => ['type' => 'unique', 'columns' => ['name']],
        ]);

        $this->createTable('user_roles_to_users', [
            '__user_id' => ['type' => 'link'],
            '__role_id' => ['type' => 'link'],
        ]);

        $adminRole = $this->insert('user_roles', [
            'name'  => 'admin',
            'title' => 'Администратор',
        ]);
        
        $this->insert('user_roles', [
            'name'  => 'user',
            'title' => 'Пользователь',
        ]);

        $adminId = $this->db
            ->query("SELECT * FROM `users` WHERE `email` = 'admin@adverplat.ru'")
            ->fetchScalar();

        $this->insert('user_roles_to_users', [
            '__user_id' => $adminId,
            '__role_id' => $adminRole,
        ]);
    }

    public function down()
    {
        $this->dropTable('user_roles_to_users');
        $this->dropTable('user_roles');
    }

}