#!/usr/bin/env php
<?php

namespace Padosoft\Hooks;

use Dotenv\Dotenv;


$included = include file_exists(__DIR__ . '/../vendor/autoload.php')
    ? __DIR__ . '/../vendor/autoload.php'
    : __DIR__ . '/../../../autoload.php';

if ( ! $included) {
    print 'You must set up the project dependencies, run the following commands:' . PHP_EOL
        . 'curl -sS https://getcomposer.org/installer | php' . PHP_EOL
        . 'php composer.phar install' . PHP_EOL;

    exit(1);
}



/*
 * .git/hooks/pre-commit
 *
 * This pre-commit hooks will check for PHP error (lint), and make sure the code
 * is PSR compliant.
 *
 * Dependecy: PHP-CS-Fixer (https://github.com/fabpot/PHP-CS-Fixer)
 *
 * @author  Mardix  http://github.com/mardix
 * @since   Sept 4 2012
 * https://git-scm.com/docs/git-log
 *
 */
/*
 * collect all files which have been added, copied or
 * modified and store them in an array called output
 */
$dotenv = new Dotenv(__DIR__, '.pre-commit.env');
$dotenv->load();

$psr0 = false;
if (getenv('PSR0') == 'true') {
    $psr0 = true;
}
$psr1 = false;
if (getenv('PSR1') == 'true') {
    $psr1 = true;
}
$psr2 = false;
if (getenv('PSR2') == 'true') {
    $psr2 = true;
}
$symfony = false;
if (getenv('SYMFONY') == 'true') {
    $symfony = true;
}
$symfonyfixers = '';
if (getenv('SYMFONY-FIXERS')) {
    $symfonyfixers = '--fixers=' . getenv('SYMFONY-FIXERS');
}
$contribfixers = '';
if (getenv('CONTRIB-FIXERS')) {
    $contribfixers = '--fixers=' . getenv('CONTRIB-FIXERS');
}
$phpcsfixerpath = getenv('PHP-CS-FIXER-PATH');
$phppath        = getenv('PHP-PATH');

exec('git diff --cached --name-status --diff-filter=ACMRT', $output);
foreach ($output as $file) {
    $fileName = trim(substr($file, 1));
    /*
     * Only PHP file
     */

    if (pathinfo($fileName, PATHINFO_EXTENSION) == 'php') {
        /*
         * Check for error
         */
        $dirfilename = exec('git rev-parse --show-toplevel', $output);
        $fileName    = $dirfilename . '/' . $fileName;

        $lint_output = array();
        exec($phppath . 'php -l ' . escapeshellarg($fileName), $lint_output, $return);
        if ($return == 0) {

            /*
             * PHP-CS-Fixer && add it back
             */

            if ($psr0) {
                exec('php ' . $phpcsfixerpath . "php-cs-fixer fix {$fileName} --level=psr0");
            }
            if ($psr1) {
                exec('php ' . $phpcsfixerpath . "php-cs-fixer fix {$fileName} --level=psr1");
            }
            if ($psr2) {
                exec('php ' . $phpcsfixerpath . "php-cs-fixer fix {$fileName} --level=psr2");
            }
            if ($symfony) {
                exec('php ' . $phpcsfixerpath . "php-cs-fixer fix {$fileName} --level=symfony " . $symfonyfixers);
            }
            if ($contribfixers) {
                exec('php ' . $phpcsfixerpath . "php-cs-fixer fix {$fileName} " . $contribfixers);
            }
            exec("git add {$fileName}");
        } else {
            echo implode("\n", $lint_output), "\n";

            exit(1);
        }
    }
}
exit(0);
