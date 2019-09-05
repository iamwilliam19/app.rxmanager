<?php

require "expiredProcessor.php";

$processor = new expProcessor();

echo $processor->countExp();