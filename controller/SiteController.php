<?php

namespace app\controller;

use \core\App;

class SiteController extends \core\Controller {

    /**
     * access filters
     * @return array
     */
    public function behaviors() {
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
        if (App::$app->auth->isAuth()) {
            return $this->authIndex();
        } else {
            return $this->render('index');
        }
    }

    protected function authIndex() {
        $user = App::$app->auth->user;
        $service = new \app\model\AccountService($user);

        return $this->render('auth-index', [
            'user' => $user,
            'account' => $service->getAccount(),
            'error' => App::$app->request->get('error')
        ]);
    }

    public function transaction() {
        $user = App::$app->auth->user;
        $service = new \app\model\AccountService($user);

        $amount = intval(App::$app->request->get('amount', 0));

        if (!$amount) {
            return '/';
        }

        return $this->render('transaction', [
            'result' => $service->withdraw($amount),
            'message' => $service->getMessage()
        ]);
    }
}