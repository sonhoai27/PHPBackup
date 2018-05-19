<?php
require_once ("./modules/cropImage.php");
class crop_imageController{
    public function index(){
        $crop = new Image();

        $src = $_GET['src'];
        $width = $_GET['w'];
        $height = $_GET['h'];

        $src = preg_replace("/ /", "%20", $src);
        header('Content-Type: image/jpeg');
        $crop->initialize([
            'source_image' => $src,
            'width'        => $width,
            'height'       => $height,
        ]);
        $crop->crop();
    }
}