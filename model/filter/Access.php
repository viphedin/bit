<?php

namespace app\model\filter;

use core\App;

class Access {

    protected $filters = [];

    public function __construct($options) {
        $this->filters = $options['filters'] ?? [];
    }

    /**
     * check access rights
     * @param string $action
     * @return boolean
     */
    public function filter($action) {
        foreach ($this->filters as $filter) {
            $actions = $filter['action'] ?? [];

            if (in_array($action, $actions)) {
                $checkResult = $this->checkAuth($filter['auth'] ?? null);

                $access = $filter['access'] ?? 'allow';

                return $access != 'allow' ? !$checkResult : $checkResult;
            }
        }

        return true;
    }

    protected function checkAuth($auth) {
        if ($auth !== null && App::$app->auth->isAuth() != 'auth') {
            return false;
        }

        return true;
    }
}