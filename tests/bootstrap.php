<?php

/*
 * bootstrapping the test suite with composer
 */

if (!$loader = @include __DIR__ . '/../vendor/autoload.php') {
    die('You must set up the project dependencies, run the following command:' . PHP_EOL .
            'php composer.phar install --dev' . PHP_EOL);
}

$loader->addPsr4('tests\\BadProject\\', __DIR__ . '/fixtures', true);