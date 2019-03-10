<?php

function array_keys_exists($keys, $array)
{
    $array = array_keys($array);
    foreach ($keys as $key) {
        if (!in_array($key, $array)) {
            return false;
        }
    }
    return true;
}

function array_map_assoc($callback, $array)
{
    $r = [];
    foreach ($array as $key => $value) {
        $r[$key] = $callback($key, $value);
    }
    return $r;
}