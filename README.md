# HTTP Basic Authentication in PHP

A template that does basic authentication in PHP and has no outside dependencies.

WARNING: It is insecure to use HTTP Basic Authentication without HTTPS (TLS) encryption.

## Usage

This is a light weight class that's easy to use.

```
require "BasicAuth.php";

// Instantiate an instance of the authentication class
$basic = new BasicAuth('../users.ini');

// Authorize every request or bail
if (!$basic->auth()) {
    die();
}
```

## Testing

Clone this repo and run the PHP server to test it.

`php -S localhost:8004`
