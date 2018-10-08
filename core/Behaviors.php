<?php

namespace core;

use core\model\Filter;

class Behaviors {

    protected $behaviors = [];

    public function __construct(array $behaviors) {
        $this->behaviors = $behaviors;
    }

    public function apply(string $action, array $params = []): bool {
        $result = true;

        foreach ($this->behaviors as $options) {
            $object = $this->getBehavior($options);
            if ($object) {
                $filter = $object->filter($action, $params);

                $result = !$filter ? false : $result;
            }
        }

        return $result;
    }

    public function getBehavior(array $options = []): Filter  {
        $className = $options['class'] ?? '';

        if ($className) {
            return new $className($options);
        }

        return null;
    }
}