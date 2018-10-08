<?php

namespace app\controller;

use core\App;
use app\model\AccountService;

class SiteController extends \core\Controller {

    /**
     * access filters
     * @return array
     */
    public function behaviors(): array {
        return [
            'access' => [
                'class' => '\app\model\filter\Access',
                'filters' => [
                    [
                        'action' => ['transaction'],
                        'auth' => true,
                        'access' => 'allow'
                    ]
                ]
            ]
        ];
    }

    /**
     * @return \core\View
     */
    public function index() {
        if (App::$app->getAuth()->isAuth()) {
            return $this->authIndex();
        } else {
            return $this->render('index');
        }
    }

    protected function authIndex() {
        $user = App::$app->getAuth()->getUser();
        $service = new AccountService($user);

        return $this->render('auth-index', [
            'user' => $user,
            'account' => $service->getAccount(),
            'error' => App::$app->getRequest()->get('error')
        ]);
    }

    public function transaction() {
        $user = App::$app->getAuth()->getUser();
        $service = new AccountService($user);

        $amount = floatval(App::$app->getRequest()->get('amount', 0));

        if (!$amount) {
            return '/';
        }

        return $this->render('transaction', [
            'result' => $service->withdraw($amount),
            'message' => $service->getMessage()
        ]);
    }
}