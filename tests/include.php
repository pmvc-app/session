<?php

const vendorDir = __DIR__.'/../vendor/';
$path = vendorDir.'autoload.php';
include $path;

\PMVC\Load::plug([
  'unit'=>null
]);
\PMVC\l(vendorDir.'pmvc-plugin/controller/tests/resources/FakeView.php');
