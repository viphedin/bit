<?php

namespace app\model\filter;

use core\App;
use core\model\Filter;

class Access implements Filter {

    protected $filters = [];

    public function __construct(array $options) {
        $this->filters = $options['filters'] ?? [];
    }

    /**
     * check access rights
     * @param string $action
     * @return boolean
     */
    public function filter(string $action): bool {
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

    protected function checkAuth(bool $auth): bool {
        if ($auth !== null && App::$app->getAuth()->isAuth() != $auth) {
            return false;
        }

        return true;
    }
}