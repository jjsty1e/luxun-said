<?php
/**
 * This file is part of project luxun.
 *
 * Author: Jake
 * Create: 2018-06-08 01:16:05
 */

require_once 'vendor/autoload.php';

use Intervention\Image\ImageManagerStatic as Image;

Image::configure(array('driver' => 'gd')); // 可以改成imagemagic（大概是这个名字吧...）

$image = Image::make('luxun.png');


$text = $_POST['text'];

// use callback to define details
$image->text($text, 150, 290, function( $font) {
    /**
     * @var \Intervention\Image\Gd\Font|\Intervention\Image\Imagick\Font $font
     */
    $font->file('msyh.ttf');
    $font->size(23);
    $font->color('#fff');
    $font->align('center');
    $font->valign('top');
});

$res = $image->encode('data-url')->getEncoded();

header('Content-Type:application/json');

echo json_encode(['ret' => $res]);