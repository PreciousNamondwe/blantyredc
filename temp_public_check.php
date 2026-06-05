<?php
$c = file_get_contents('http://localhost:8000/news');
if ($c === false) {
    echo "FETCH_ERROR\n";
    exit(1);
}
echo 'testnews:' . (strpos($c, 'Test News') !== false ? '1' : '0') . PHP_EOL;
echo 'placeholder:' . (strpos($c, 'No news was posted here') !== false ? '1' : '0') . PHP_EOL;
echo 'content:' . (strpos($c, 'Test content') !== false ? '1' : '0') . PHP_EOL;
