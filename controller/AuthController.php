<?php

namespace app\controller;

use core\App;

class AuthController extends \core\Controller {
    
    public function login() {
        $error = false;

        $form = new \app\model\form\Login();

        if (App::$app->request->isPost()) {
            $error = true;

            $form->load(App::$app->request->post());
            
            $result = App::$app->auth->auth($form->login, $form->password);
            
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
        App::$app->auth->logout();
        
        return '/';
    }
}