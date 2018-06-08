<?php
/**
 * This file is part of project luxun.
 *
 * Author: Jake
 * Create: 2018-06-08 01:16:05
 */

require_once 'vendor/autoload.php';


// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

// configure with favored image driver (gd by default)
Image::configure(array('driver' => 'gd'));

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
//    $font->angle(45);
});

$name = 'luxun-'.time().uniqid() . '.png';
$res = $image->encode('data-url')->getEncoded();

header('Content-Type:application/json');

echo json_encode(['ret' => $res]);