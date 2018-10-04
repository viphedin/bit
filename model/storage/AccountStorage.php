<?php

namespace app\model\storage;

class AccountStorage extends Storage {

    protected $model = 'app\model\db\Account';

    /*
     * @param int $userId
     * @return \app\model\db\Account
     */
    public function getAccount($userId) {
        $stmt = $this->db->prepare('SELECT * FROM accounts WHERE userId = :userId');
        $stmt->execute([
            ':userId' => $userId
        ]);

        return $stmt->fetchObject($this->model);
    }

    /*
     * @param \app\model\db\Account $account
     * @param int $amount
     */
    public function doWithdraw($account, $amount) {
        $stmt = $this->db->prepare('UPDATE accounts as accountsW SET amount = amount - :amount WHERE id = :id');
        $stmt->execute([
            ':amount' => $amount,
            ':id' => $account->id
        ]);
    }

    public function lock() {
        $this->db->exec('LOCK TABLE accounts READ, accounts as accountsW WRITE');
    }

    public function unlock() {
        $this->db->exec('UNLOCK TABLES');
    }
}