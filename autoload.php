<?php

function load_models($class)
{
    $path_to_file = 'app/models/' . $class . '.php';
    if (file_exists($path_to_file)) {
        require $path_to_file;
    }
}
function load_controllers($class)
{
    $path_to_file = 'app/controllers/' . $class . '.php';
    if (file_exists($path_to_file)) {
        require $path_to_file;
    }
}
spl_autoload_register('load_models');
spl_autoload_register('load_controllers');