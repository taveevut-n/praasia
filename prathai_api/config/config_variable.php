<?php
/* start session. */
session_start();

/* show all error on web program. */
error_reporting(E_ALL);

/* set asia time zone. */
date_default_timezone_set('Asia/Bangkok');

/* defind fix-variable */
if (!defined("PREFIX_PATH")) {

	/* development server */
	define("PREFIX_PATH", "ActiveSupport/");

	/* define("PREFIX_PATH", "../../../ActiveSupport/"); */ /* production server */
}

?>