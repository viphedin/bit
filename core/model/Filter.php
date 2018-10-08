<?php

namespace core\Model;

interface Filter {

    /*
     * @param string $action
     * @return bool
     */
    public function filter(string $action): bool;
}