### INSTALL

```shell
composer require kmvan/response
```

### REQUIRED

- PHP 8.1 or later

### USAGE

```php
<?php

use Kmvan\Response;

$res = new Response();

// 404 not found
$res->setStatus(404)
    ->end(); // exit

// 201 created
$res->setStatus(201)
    ->setData([ // output json
      'name' => 'Jack',
    ])
    ->end(); // exit
```

### RECOMMEND

Good experience with `composer require kmvan/status-code` library.

```php
<?php

use Kmvan\StatusCode;
use Kmvan\Response;

$req = new Response();
$req->setStatus(StatusCode::OK) // http status code 200
    ->end();
```
