<?php
require("../../vendor/autoload.php");
$openapi = \OpenApi\scan('../../app/Http/Controllers/APIv1');
header('Content-Type: application/json');
echo $openapi->toJson();
