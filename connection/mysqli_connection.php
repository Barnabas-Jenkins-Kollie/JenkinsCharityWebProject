<?php
define("DBUSER", "root");
define("DBPASS", "");
define("DBHOST", "localhost");
define("DBNAME", "kindheart_db");

try {

    $DBcon = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    mysqli_set_charset($DBcon, "utf8");
} catch (Exception $e) {

    print "The system is busy please try later";

} catch (Error $e) {
    print "The system is busy try again later";
}
