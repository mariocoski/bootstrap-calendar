<?php
/* 
 * This is initialization file
 * Before you start using the project you must update your database credentials, libs paths and set proper timezone
 *
 * @author Mariocoski
 * @email mariuszrajczakowski@gmail.com 
 * @github https://github.com/mariocoski/Bootstrap-calendar
 * Copyright (c) 2015 Mariocoski
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
//take advantage of using sessions
session_start();
//define the paths for bootstrap, css and js files
//change http://localhost/ to any location where you put downloaded bootstrap-calendar-demo folder
define("BOOSTRAP_JS", "http://localhost/bootstrap-calendar-demo/bootstrap/js/");
define("BOOTSTRAP_CSS", "http://localhost/bootstrap-calendar-demo/bootstrap/css/");
define("CSS","http://localhost/bootstrap-calendar-demo/css/");
define("JS","http://localhost/bootstrap-calendar-demo/js/");
define("HOST_URL","http://localhost/bootstrap-calendar-demo/");

//set default timezone to maintain proper event calculations
date_default_timezone_set("Europe/London");
//define database credentials
define("DB_HOST","localhost"); //change this to your database host
define("DB_USER","root"); // change this to your user name
define("DB_PASS",""); //change this to your database password
define("DB_NAME","mariocoski_bootstrap"); //change this to your database name

//libs autoloader help to load the classes
function my_autoloader($class) {
  require  'libs/' . $class . '.php';
}
//run autoloader
spl_autoload_register('my_autoloader');
