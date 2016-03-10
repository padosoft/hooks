<?php
/**
 * Created by PhpStorm.
 * User: Alessandro
 * Date: 10/03/2016
 * Time: 12:46
 */

if(file_exists("/../../../../hooks/pre-commit.php")) {
    exec("php /../../../../hooks/pre-commit.php");
}
else if(file_exists("/../../static-review/src/config/pre-commit.php")) {
    exec("php /../../static-review/src/config/pre-commit.php");
}