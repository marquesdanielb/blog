<?php

$mysql = mysqli_connect('localhost', 'blogadmin', 'root', 'blog');
$mysql->set_charset('utf8');

if (!$mysql) {
    echo 'banco não conectado';
}
