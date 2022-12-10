#!/usr/bin/php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Nicholasricci\AnprIstatRegistry\Runner;

$runner = new Runner();
$runner->executeAll();
