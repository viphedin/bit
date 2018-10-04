<?php

namespace core\storage;

interface AuthStorage {

    /*
     * @param string $login
     * @return \core\model\AuthUser | null
     */
    public function getUserByLogin($login);
}