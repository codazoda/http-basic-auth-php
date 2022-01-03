<?php

require "BasicAuth.php";

// Instantiate an app with authentication
$basic = new BasicAuth('../users.ini');

// Authorize every request
if (!$basic->auth()) {
    die();
}

// Split the URI into segments and route the first
$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
switch($uriSegments[1]) {
    case 'hello':
        helloHandler();
        break;
    case 'hash':
        hashHandler($uriSegments[2] ?? null);
        break;
    default:
        echo "Try the <em>/hello</em> or <em>/hash</em> endpoints.";
}

// Return hello
function helloHandler() {
    echo "Hello World";
}

// Return a hash
function hashHandler($password) {
    // If a password wasn't provided show the URI syntax
    if (empty($password)) {
        die("Syntax: http://localhost:8004/hash/{password}");
    }
    // Bcrypt the users password and return a hash
    $hash = password_hash($password, PASSWORD_BCRYPT);
    echo $hash;
}
