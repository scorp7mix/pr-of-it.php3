<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1460054944_testDropTableReversible
    extends Migration
{

    public function up()
    {
        /*
        $this->db->execute('ALTER TABLE `users` RENAME TO `users_bak`');
        */
    }

    public function down()
    {
        /*
        $this->db->execute('ALTER TABLE `users_bak` RENAME TO `users`');
        */
    }
    
}