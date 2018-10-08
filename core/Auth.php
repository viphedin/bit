<?php

namespace core;

use core\Session;
use core\model\AuthUser;

class Auth {

    protected $guestGroup = '';

    protected $userOptions = [];

    protected $userStorage = null;

    protected $storage = null;

    protected $user = null;

    public function __construct(array $options = [], Session $storage = null) {
        $this->storage = $storage;

        $this->userOptions = $options['users'] ?? [];

    }

    public function checkStored() {
        if ($this->storage !== null) {
            if ($this->storage->get('auth', false)) {
                $this->initUserStorage();
                $this->user = $this->userStorage->getUserByLogin($this->storage->get('authLogin'));
            }
        }
    }

    public function auth(string $login, string $password): bool {
        $this->user = null;

        $this->initUserStorage();

        if ($this->userStorage == null) {
            return false;
        }

        $this->user = $this->userStorage->getUserByLogin($login);

        if (!($this->user instanceof \core\model\AuthUser) || $this->user->getPassword() != $password) {
            return false;
        }

        if ($this->storage !== null) {
            $this->storage->set('auth', true);
            $this->storage->set('authLogin', $login);
        }

        return true;
    }

    public function isAuth(): bool {
        return $this->user === null ? false : true;
    }

    public function logout() {
        if ($this->storage !== null) {
            $this->storage->set('auth', false);
            $this->storage->set('authLogin', '');
        }
    }

    public function getUser(): ?AuthUser {
        return $this->user;
    }

    public function __get($property) {
        if ($property == 'user') {
            return $this->user;
        }
    }

    protected function initUserStorage() {
        if (isset($this->userOptions['class'])) {
            $this->userStorage = new $this->userOptions['class']($this->userOptions);
        }
    }
}