<?php

namespace app\model\db;

class User implements \core\model\AuthUser {

    public $id;
    public $login;
    public $password;

    /*
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }
}