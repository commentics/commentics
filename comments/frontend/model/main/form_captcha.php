<?php
namespace Commentics;

class MainFormCaptchaModel extends Model
{
    public function createImage($captcha_string)
    {
        // Create the image
        $image = imagecreatetruecolor($this->setting->get('captcha_width'), $this->setting->get('captcha_height'));

        // Dimensions
        $width = imagesx($image);
        $height = imagesy($image);

        // Background color
        $color = $this->hexColorAllocate($image, $this->setting->get('captcha_back_color'));
        imagefilledrectangle($image, 0, 0, $width, $height, $color);

        // Draw lines
        $color = $this->hexColorAllocate($image, $this->setting->get('captcha_line_color'));
        for ($i = 0; $i < $this->setting->get('captcha_lines'); $i++) {
            imagesetthickness($image, rand(2, 10));
            imageline($image, ceil(rand(5, 145)), ceil(rand(0, 35)), ceil(rand(5, 145)), ceil(rand(0, 35)), $color);
        }

        // Draw circles
        $color = $this->hexColorAllocate($image, $this->setting->get('captcha_circle_color'), true);
        for ($i = 0; $i < $this->setting->get('captcha_circles'); $i++) {
            imagefilledellipse($image, ceil(rand(5, 145)), ceil(rand(0, 35)), 30, 30, $color);
        }

        // Draw squares
        $color = $this->hexColorAllocate($image, $this->setting->get('captcha_square_color'), true);
        for ($i = 0; $i < $this->setting->get('captcha_squares'); $i++) {
            imagesetthickness($image, rand(2, 4));
            imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $color);
        }

        // Draw dots
        $color = $this->hexColorAllocate($image, $this->setting->get('captcha_dots_color'));
        for ($i = 0; $i < $this->setting->get('captcha_dots'); $i++) {
            $x = mt_rand(0, $width);
            $y = mt_rand(0, $height);
            $size = mt_rand(1, 5);
            imagefilledarc($image, $x, $y, $size, $size, 0, mt_rand(180,360), $color, IMG_ARC_PIE);
        }

        // Draw characters
        $color = $this->hexColorAllocate($image, $this->setting->get('captcha_text_color'));
        $size = 20; // the font size in points
        $font = $this->loadFont('ahgbold.ttf'); // load font
        $captcha_length = $this->validation->length($captcha_string);
        $letter_space = 170 / $captcha_length;
        $initial = 25;
        for ($i = 0; $i < $captcha_length; $i++) {
            $angle = rand(-15, 15); // the angle in degrees
            $x = $initial + (int) ($i * $letter_space); // the x coordinate of the character
            $y = rand(35, 55); // the y coordinate of the character
            imagettftext($image, $size, $angle, $x, $y, $color, $font, $captcha_string[$i]);
        }

        return $image;
    }

    private function hexColorAllocate($image, $hex, $transparency = false) {
        $hex = ltrim($hex, '#');

        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        if ($transparency) {
            return imagecolorallocatealpha($image, $r, $g, $b, 75);
        } else {
            return imagecolorallocate($image, $r, $g, $b);
        }
    }
}
