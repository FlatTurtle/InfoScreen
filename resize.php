<?php
/**
 * © 2012 iRail npo - Some rights reserved
 *
 * This script is part of InfoScreen code by FlatTurtle.
 * aGPLv3
 */

//1. process GET parameters
if(!isset($_GET["height"])){
    echo "Please add a height parameter to your url";
    exit(0);
}
if(!isset($_GET["image"])){
    echo "Please add an image parameter to your url";
    exit(0);
}
$height = urldecode($_GET["height"]);
$f = urldecode($_GET["image"]);
$size = getimagesize($f);
$type = $size["mime"];
$img;
//determine right image function and load image
$imgFunc = '';
switch($type){ 
    case 'image/gif':
        $img = ImageCreateFromGIF($f); 
        $imgFunc = 'ImageGIF'; 
        $transparent_index = ImageColorTransparent($img); 
        if($transparent_index!=(-1)) $transparent_color = ImageColorsForIndex($img,$transparent_index); 
        break; 
    case 'image/jpeg': 
        $img = ImageCreateFromJPEG($f); 
        $imgFunc = 'ImageJPEG'; 
        break; 
    case 'image/png': 
        $img = ImageCreateFromPNG($f); 
        ImageAlphaBlending($img,true); 
        ImageSaveAlpha($img,true); 
        $imgFunc = 'ImagePNG'; 
        break; 
    default: 
        die("ERROR - no image found"); 
        break;
} 
header("Content-Type: ".$type);
list($w,$h) = $size; 
if( $w==0 or $h==0 ) die("ERROR - zero image size");
$percent = $height / $h;
//don't make too small, don't make too big
if($percent>-1 and $percent<1){
    $nw = intval($w*$percent); 
    $nh = intval($h*$percent); 
    $img_resized = ImageCreateTrueColor($nw,$nh); 
    if($type=='image/png'){ 
        ImageAlphaBlending($img_resized,false); 
        ImageSaveAlpha($img_resized,true); 
    } 
    if(!empty($transparent_color)){ 
        $transparent_new = ImageColorAllocate($img_resized,$transparent_color['red'],$transparent_color['green'],$transparent_color['blue']); 
        $transparent_new_index = ImageColorTransparent($img_resized,$transparent_new); 
        ImageFill($img_resized, 0,0, $transparent_new_index); 
    } 
    if(ImageCopyResized($img_resized,$img, 0,0,0,0, $nw,$nh, $w,$h )){ 
        ImageDestroy($img); 
        $img = $img_resized;
    } 
}
$imgFunc($img);
ImageDestroy($img); 
?> 
