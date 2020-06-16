<?php
$database = mysqli_connect("localhost", "root", "Death_Note_007", "newsboard");
function super_hash($hesh) {
    for ($i = 0; $i < 10000; $i++) {
        if ($i == 634) {
            $hesh = $hesh . 'j\vn%ew/$3f/43y*/.42gsd';
        }
        if ($i == 2569) {
            $hesh = 'vsd&sp34/8*/@ccp$,kcsa.//' . $hesh;
        }
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
function resize_image($file, $w, $h, $crop = FALSE)
{
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width - ($width * abs($r - $w / $h)));
        } else {
            $height = ceil($height - ($height * abs($r - $w / $h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w / $h > $r) {
            $newwidth = $h * $r;
            $newheight = $h;
        } else {
            $newheight = $w / $r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromwebp($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    return $dst;
}