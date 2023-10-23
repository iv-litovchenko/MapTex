<?php

$mem_var = new \Memcached();
$mem_var->addServer("maptex-db-memcached", 11211);
$response = $mem_var->get("Bilbo");

$version = $mem_var->getVersion();
echo "Server's version: ".print_r($version)."<br/>\n";


$key = "GEEKSFORGEEKS";
$value = "computer science portal";
$ttl = 3600;
if ($mem_var->add($key, $value, $ttl))
    echo "** added key-value (" . $key . ":"
        . $value . ")to cache successfully!! **\n";
else
    echo "** error while adding value to cache!! **\n";

// Get value of key
echo "****   FETCHED VALUE   FOR KEY :"
    . $key . " ****\n";

$valD = $mem_var->get($key);
var_dump($valD);
