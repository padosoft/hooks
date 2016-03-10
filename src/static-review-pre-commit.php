<?php
/**
 * Created by PhpStorm.
 * User: Alessandro
 * Date: 10/03/2016
 * Time: 12:46
 */
$dirfilename = exec('git rev-parse --show-toplevel', $output);
$lint_output = array();
if(file_exists("{$dirfilename}/hooks/pre-commit.php")) {

    exec("php ".escapeshellarg($dirfilename."/hooks/pre-commit.php"),$lint_output,$return);
}
else if(file_exists("{$dirfilename}/vendor/padosoft/static-review/src/config/pre-commit.php")) {

    exec("php ".escapeshellarg($dirfilename."/vendor/padosoft/static-review/src/config/pre-commit.php"),$lint_output,$return);
}
echo implode("\n", $lint_output), "\n";