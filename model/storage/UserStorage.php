<?php

namespace app\model\storage;

class UserStorage extends Storage implements \core\storage\AuthStorage {

    protected $model = 'app\model\db\User';

    /*
     * @param string $login
     * @return \core\model\AuthUser | null
     */
    public function getUserByLogin($login) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE login = :login');
        $stmt->execute([
            ':login' => $login
        ]);

        return $stmt->fetchObject($this->model);
    }
}