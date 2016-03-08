#!/usr/bin/env php
<?php

namespace Padosoft\Hooks;

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
        exec('php -l ' . escapeshellarg($fileName), $lint_output, $return);
        if ($return == 0) {

            /*
             * PHP-CS-Fixer && add it back
             */

                $lint_output2 = array();
                exec("php {$dirfilename}/vendor/fabpot/php-cs-fixer/php-cs-fixer fix {$fileName} ", $lint_output2, $return2);

            exec("git add {$fileName}");
        } else {
            echo implode("\n", $lint_output), "\n";

            exit(1);
        }
    }
}
exit(0);
