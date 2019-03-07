<?php

namespace jorbascrumps\Intervention;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\ImageManagerStatic as Image;

class TintFilter implements FilterInterface
{
    private $red = 0;
    private $green = 0;
    private $blue = 0;
    private $alpha = 0;

    /**
     * Creates new instance of filter
     *
     * @param Int $red
     * @param Int $green
     * @param Int $blue
     * @param Int $alpha
     */
    public function __construct(Int $red, Int $green, Int $blue, Int $alpha = 0)
    {
        $this->red = intval($red);
        $this->green = intval($green);
        $this->blue = intval($blue);
        $this->alpha = intval($alpha);
    }

    /**
     * Applies filter to given image
     *
     * @param  \Intervention\Image\Image $image
     * @return \Intervention\Image\Image
     */
    public function applyFilter(\Intervention\Image\Image $image)
    {
        $tmp = $image->getCore();

        imagealphablending($tmp, TRUE);
        imagelayereffect($tmp, IMG_EFFECT_MULTIPLY);
        imagefilledrectangle($tmp, 0, 0, $image->width(), $image->height(), imagecolorallocatealpha($tmp, $this->red, $this->green, $this->blue, $this->alpha));

        return Image::make($tmp);
    }
}
