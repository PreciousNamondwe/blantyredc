<?php
$url='http://localhost:8080/news';
$c = @file_get_contents($url);
if ($c === false) {
    if (isset($http_response_header[0])) {
        echo $http_response_header[0];
    } else {
        echo "ERROR\n";
    }
    exit;
}
if (strpos($c, 'Test publish') !== false) {
    echo "FOUND\n";
} else {
    echo "NOTFOUND\n";
    echo substr($c, 0, 1000);
}
