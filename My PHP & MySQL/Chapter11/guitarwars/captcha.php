<?php
session_start();

//set some important CAPTCHA CONSTANTS
define("CAPTCHA_NUMCHARS", 6);
define("CAPTCHA_WIDTH", 100);
define("CAPTCHA_HEIGHT", 25);

//Generate random phrase
$pass_phrase = '';
for ($i=0; $i<CAPTCHA_NUMCHARS; $i++) {
    $pass_phrase.=chr(rand(97, 122));
}

//Store the encrypted pass+phrase in a session variable
$_SESSION['pass_phrase'] = sha1($pass_phrase);

//create image
$img = imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT);

//set a white background with black text and random-color graphics;
$bg_color = imagecolorallocate($img, 255, 255, 255);//white
$text_color = imagecolorallocate($img, 0, 0, 0);//black

//randomize $graphic_color;
function ranColor()
{
    return rand(25, 255);
}
function graphic_color($img)
{
    return imagecolorallocate( $img, ranColor(), ranColor(), ranColor());
}
//fill the background
imagefilledrectangle($img, 0, 0, CAPTCHA_WIDTH, CAPTCHA_HEIGHT, $bg_color);

//draw some random lines 
for ($i=0; $i<5; $i++) {
    imageline($img, 0, rand()%CAPTCHA_HEIGHT, CAPTCHA_WIDTH, rand()%CAPTCHA_HEIGHT, graphic_color($img));
}

//sprinkle some random dots
for ($i=0; $i<50; $i++) {
    imagesetpixel($img, rand()%CAPTCHA_WIDTH, rand()%CAPTCHA_HEIGHT, graphic_color($img));
}

//Draw the pass-phrase string
imagettftext($img, 18, 0, 5, CAPTCHA_HEIGHT-5, $text_color, "Courier New Bold.ttf", $pass_phrase);

//output the image as png using a header
header("Content-type:image/png");

//draw a rectangle
/*
$img1 = imagecreatetruecolor(20,20);
$img1color =imagecolorallocate($img1,23,23,23);
imagefilledrectangle($img1,0,0,20,20,$img1color); 
imagepng($img1);
imagedestroy($img1);
*/

imagepng($img);

//clean up
imagedestroy($img);
