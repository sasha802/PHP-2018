<?php
require('ValueTransfer.php');
$test = new ValueTransfer();

$test->setVar('testOutput','Hello');
$output = $test->getVar('testOutput');

$test->setVar('testOutput2', 'Hi');
$output2 = $test->getVar('testOutput2');



echo $output . '<br />';
echo $output2;