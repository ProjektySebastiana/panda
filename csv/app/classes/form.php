<?php

class Form
{
    function __construct()
    {

    }

    function validate($important, $params)
    {
        $missing = [];
        foreach ($important as $key) {
            if (array_key_exists($key, $params)) {
                $value = strip_tags($params[$key]);
                if (!strlen(trim($value))) {
                    $missing[] = $key;
                }
            }
            else {
                $missing[] = $key;
            }
        }

        if (count($missing)) {
            return ['error' => 'Missing field' . (count($missing) > 1 ? 's' : '') . ': ' .join(', ', $missing)];
        }


        return true;
    }
}