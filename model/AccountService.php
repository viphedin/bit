<?php

namespace app\model;

use \app\model\db\User;
use \app\model\db\Account;
use \app\model\storage\AccountStorage;

class AccountService {

    protected $user = null;
    protected $storage = null;

    protected $message = '';

    /*
     * @param \app\model\db\User $user
     */
    public function __construct(User $user) {
        $this->user = $user;
        $this->storage = new AccountStorage();
    }

    /*
     * списание средств со счета
     * @param double $amount
     * @return bool
     */
    public function withdraw(float $amount): bool {
        $this->message = '';

        $this->storage->beginTransaction();

        $amount = abs($amount);

        try {
            $account = $this->storage->getAccount($this->user->id, true);

            $totalAmount = $account->amount;

            if ($totalAmount < $amount) {
                throw new \Exception('Недостаточно средств');
            }

            $this->storage->doWithdraw($account, $amount);

            $this->storage->commit();
        } catch (\Exception $e) {
            $this->storage->rollBack();

            $this->message = $e->getMessage();

            return false;
        }

        return true;
    }

    /*
     * @return string
     */
    public function getMessage(): string {
        return $this->message;
    }

    /*
     * @return \app\model\db\Account
     */
    public function getAccount(): Account {
        return $this->storage->getAccount($this->user->id);
    }
}