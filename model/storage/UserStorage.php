<?php

namespace app\model\storage;

use \core\model\AuthUser;
use \core\storage\AuthStorage;

class UserStorage extends Storage implements AuthStorage {

    protected $model = 'app\model\db\User';

    /*
     * @param string $login
     * @return \core\model\AuthUser | null
     */
    public function getUserByLogin($login): ?AuthUser {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE login = :login');
        $stmt->execute([
            ':login' => $login
        ]);

        $result = $stmt->fetchObject($this->model);

        return $result ?: null;
    }
}