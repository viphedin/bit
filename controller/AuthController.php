<?php

namespace app\controller;

use core\App;
use \core\Controller;
use \app\model\form\Login;

class AuthController extends Controller {

    public function login() {
        $error = false;

        $form = new Login();

        if (App::$app->getRequest()->isPost()) {
            $error = true;

            $form->load(App::$app->getRequest()->post());

            $result = App::$app->getAuth()->auth($form->login, $form->password);

            if ($result) {
                return '/';
            }
        }

        return $this->render('login', [
            'error' => $error,
            'form' => $form
        ]);
    }

    public function logout() {
        App::$app->getAuth()->logout();

        return '/';
    }
}