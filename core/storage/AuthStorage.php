<?php

namespace core\storage;

use core\model\AuthUser;

interface AuthStorage {

    /*
     * @param string $login
     * @return \core\model\AuthUser | null
     */
    public function getUserByLogin($login): ?AuthUser;
}