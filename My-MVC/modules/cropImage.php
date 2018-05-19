<?php
class Image
{

    protected $source_image = '';
    protected $width        = '';
    protected $height       = '';
    protected $create_thumb = '';
    protected $thumb_marker = '';
    protected $image;

    public function __construct($config = array())
    {
        empty($config) or $this->initialize($config);
    }

    public function initialize($config)
    {
        $this->clear();
        foreach ($config as $key => $val) {
            if (isset($this->$key)) {
                $this->$key = $val;
            }
        }
    }

    public function clear()
    {
        $this->source_image = '';
        $this->width        = '';
        $this->height       = '';
        $this->create_thumb = false;
        $this->thumb_marker = '_thumb';
    }
    public function crop()
    {
        $source_path                        = $this->source_image;
        $target_width                       = $this->width;
        $target_height                      = $this->height;
        list($source_width, $source_height) = $imagesize = getimagesize($source_path);
        $source_mime                        = $imagesize['mime'];
        $source_ratio                       = $source_height / $source_width;
        $target_ratio                       = $target_height / $target_width;
        if ($source_ratio > $target_ratio) {

            $cropped_width  = $source_width;
            $cropped_height = $source_width * $target_ratio;
            $source_x       = 0;
            $source_y       = ($source_height - $cropped_height) / 2;
        } elseif ($source_ratio < $target_ratio) {

            $cropped_width  = $source_height / $target_ratio;
            $cropped_height = $source_height;
            $source_x       = ($source_width - $cropped_width) / 2;
            $source_y       = 0;
        } else {

            $cropped_width  = $source_width;
            $cropped_height = $source_height;
            $source_x       = 0;
            $source_y       = 0;
        }
        switch ($source_mime) {
            case 'image/gif':
                $source_func = 'imagecreatefromgif';
                $output_func = 'imagegif';
                $suffix      = '.gif';
                break;
            case 'image/png':
                $source_func = 'imagecreatefrompng';
                $output_func = 'imagepng';
                $suffix      = '.png';
                break;
            case 'image/jpeg':
                $source_func = 'imagecreatefromjpeg';
                $output_func = 'imagejpeg';
                $suffix      = '.jpg';
                break;
            default:
                $source_func = 'imagecreatefromjpeg';
                $output_func = 'imagejpeg';
                $suffix      = '.jpg';
                break;
        }

        $source_image = $source_func($source_path);

        //chat luong goc
        $target_image  = imagecreatetruecolor($target_width, $target_height);
        //chat luong da xu ly cao hon
        $cropped_image = imagecreatetruecolor($cropped_width, $cropped_height);

        imagealphablending($target_image, false);
        imagesavealpha($target_image, true);
        imagealphablending($cropped_image, false);
        imagesavealpha($cropped_image, true);


        imagecopy($cropped_image, $source_image, 0, 0, $source_x, $source_y, $cropped_width, $cropped_height);

        imagecopyresampled($target_image, $cropped_image, 0, 0, 0, 0, $target_width, $target_height, $cropped_width, $cropped_height);

        $this->image = $target_image;
        switch ($source_mime) {
            case 'image/gif':
                imagegif($this->image);
                break;
            case 'image/png':
                imagepng($this->image);
                break;
            case 'image/jpeg':
                imagejpeg($this->image);
                break;
        }

        imagedestroy($source_image);
        imagedestroy($target_image);
        imagedestroy($cropped_image);
    }

}
