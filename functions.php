<?php
$database = mysqli_connect("localhost", "root", "root", "newsboard");
function super_hash($hesh) {
    for ($i = 0; $i < 10000; $i++) {
        if ($i % 2 == 0) {
            $hesh = hash('sha512', $hesh);
        } else if ($i % 3 == 0) {
            $hesh = hash('sha256', $hesh);
        } else {
            $hesh = hash('md5', $hesh);
        }
    }
    return $hesh;
}