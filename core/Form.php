<?php

namespace core;

class Form {
    /**
     * 
     * @param array $array
     */
    public function load($array) {
        $fields = call_user_func('get_object_vars', $this);

        foreach ($fields as $field => $value) {
            $this->$field = $array[$field] ?? $value;
        }
    }
    
    /**
     * 
     * @return array
     */
    public function getAttributes() {
        $attributes = call_user_func('get_object_vars', $this);
        return $attributes ?? [];
    }
}