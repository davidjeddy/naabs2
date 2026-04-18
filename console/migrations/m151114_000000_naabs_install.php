<?php

use yii\db\Migration;
use yii\db\Schema;

class m151114_000000_naabs_install extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        echo "m151114_000000_naabs_install executing.\n";

        // todo for some reason the SQL will not successfully execute when using $command->execute() - DJE - 2015-11-16
        /*
        $connection = \Yii::$app->getDb();
        $command    = $connection->createCommand("");
        $result = $command->execute();
        */

        $dsn      = explode(";", \Yii::$app->db->dsn);
        $host     = explode("=", $dsn[0]);
        $database = explode("=", $dsn[1]);
        return exec('mysql -u '.\Yii::$app->db->username.' -p'.\Yii::$app->db->password.' -h '.$host[1].' '.$database[1].' < ./console/migrations/naabs2_install.sql');
    }

    public function safeDown()
    {
        echo "m151114_000000_naabs_install reverting.\n";

        $connection = \Yii::$app->getDb();
        $command    = $connection->createCommand("");

        return $command->execute();
    }
}
