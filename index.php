<?php

require "BasicAuth.php";

// Instantiate an app with authentication
$basic = new BasicAuth;

// Split the URI into segments
$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Routes
switch($uriSegments[1]) {
    case 'hello':
        if ($basic->auth()) {
            helloHandler();
        }
        break;
    case 'hash':
        hashHandler();
        break;
    default:
        echo "Nothing to see here. Try the <em>/hello</em> endpoint.";
}

// Return hello
function helloHandler() {
    echo "Hello World";
}

// Return a hash
function hashHandler() {
    // If a password was provided
    if ($_REQUEST['pass'] ?? null) {
        // Bcrypt the users password and return a hash
        $hash = password_hash($_REQUEST['pass'], PASSWORD_BCRYPT);
        echo $hash;
    } else {
        echo "Error: No password provided";
    }
}
