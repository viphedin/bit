<?php

namespace app\widget;

use core\App;

class User extends \core\Widget {

    public function run(array $params = []) {
        echo $this->render([
            'auth' => App::$app->auth->isAuth()
        ]);
    }
}