<?php

namespace app\model;

class AccountService {

    protected $user = null;
    protected $storage = null;

    protected $message = '';

    /*
     * @param \app\model\db\User $user
     */
    public function __construct($user) {
        $this->user = $user;
        $this->storage = new \app\model\storage\AccountStorage();
    }

    /*
     * списание средств со счета
     * @param double $amount
     * @return boolean
     */
    public function withdraw($amount) {
        $this->message = '';

        $this->storage->beginTransaction();

        try {
            $this->storage->lock();

            $account = $this->storage->getAccount($this->user->id);

            $totalAmount = $account->amount;

            if ($totalAmount < $amount) {
                throw new \Exception('Недостаточно средств');
            }

            $this->storage->doWithdraw($account, $amount);

            $this->storage->commit();
            $this->storage->unlock();
        } catch (\Exception $e) {
            $this->storage->rollBack();
            $this->storage->unlock();

            $this->message = $e->getMessage();

            return false;
        }

        return true;
    }

    /*
     * @return string
     */
    public function getMessage() {
        return $this->message;
    }

    /*
     * @return \app\model\db\Account
     */
    public function getAccount() {
        return $this->storage->getAccount($this->user->id);
    }
}