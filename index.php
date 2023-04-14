<?php

ini_set('display_errors', 1);
session_start();

require_once 'app/models/model.php';
require_once 'app/views/view.php';
require_once 'app/controllers/controller.php';
require_once 'route.php';

Route::start();
