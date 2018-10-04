<?php

namespace app\model\storage;

use \core\App;

abstract class Storage {

    protected $db = null;

    public function __construct() {
        $this->db = App::$app->db;
    }

    public function beginTransaction() {
        $this->db->exec('START TRANSACTION');
    }

    public function rollBack() {
        $this->db->exec('ROLLBACK');
    }

    public function commit() {
        $this->db->exec('COMMIT');
    }
}