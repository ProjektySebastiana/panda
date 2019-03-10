<?php

class Form
{
    function __construct()
    {

    }

    function validate($important, $params)
    {
        $errors = $missing = [];
        foreach ($important as $key) {
            if (array_key_exists($key, $params)) {
                $value = strip_tags($params[$key]);
                if (strlen(trim($value))) {
                    switch ($key) {
                        case 'email' :
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $errors[] = $key;
                            }
                            break;
                        case 'password' :
                            if (strlen($value) < 6 || !preg_match('/(?=.*[\d])(?=.*[\p{L}])/', $value)) {
                                $errors[] = $key;
                            }
                            break;
                    }
                }
                else {
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

        if (count($errors)) {
            return ['error' => 'Not valid fields: ' .join(', ', $errors)];
        }

        return true;
    }
}