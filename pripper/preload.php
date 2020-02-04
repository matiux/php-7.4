<?php

FFI::load('/var/www/app/pripper/go_pripper.h');
FFI::load('/var/www/app/pripper/c_pripper.h');

opcache_compile_file('/var/www/app/src/Php74/Features/ForeignFunctionInterface/Pripper.php');
