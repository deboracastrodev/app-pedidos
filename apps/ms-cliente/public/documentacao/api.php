<?php
require("../../vendor/autoload.php");
$openapi = \OpenApi\scan('../../app/Http/Controllers/API/v1');
header('Content-Type: application/json');
echo $openapi->toJson();
