<?php

namespace app\model\storage;

use \app\model\db\Account;

class AccountStorage extends Storage {

    protected $model = 'app\model\db\Account';

    /*
     * @param int $userId
     * @return \app\model\db\Account
     */
    public function getAccount(int $userId, bool $lock = false): ?Account {
        $stmt = $this->db->prepare('SELECT * FROM accounts WHERE userId = :userId' . ($lock ? ' FOR UPDATE' : ''));
        $stmt->execute([
            ':userId' => $userId
        ]);

        $result = $stmt->fetchObject($this->model);

        return $result ?: null;
    }

    /*
     * @param \app\model\db\Account $account
     * @param float $amount
     */
    public function doWithdraw(Account $account, float $amount) {
        $stmt = $this->db->prepare('UPDATE accounts SET amount = amount - :amount WHERE id = :id');
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