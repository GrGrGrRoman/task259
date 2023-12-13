<?php

namespace App\config;

define('ROOT', dirname(__DIR__,2) . DIRECTORY_SEPARATOR);
define('APP', ROOT. 'app' . DIRECTORY_SEPARATOR);
define('CONTROLLER', APP. 'controllers' . DIRECTORY_SEPARATOR);
define('VIEW', APP. 'views' . DIRECTORY_SEPARATOR);
define('CONF', APP. 'config' . DIRECTORY_SEPARATOR);
define('DB', APP. 'db' . DIRECTORY_SEPARATOR);
define('MODEL', APP. 'models' . DIRECTORY_SEPARATOR);
define('PATH_TO_SQLITE_FILE', DB. 'sqlite.db');
define('SQLITE_FILE', 'sqlite.db');
define('UPLOAD_DIR', ROOT . 'public' . DIRECTORY_SEPARATOR . 'uploads');
define('MAX_FILE_SIZE', 1000000);
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/gif']);