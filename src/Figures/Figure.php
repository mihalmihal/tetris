<?php
namespace Tetris\Figures;
use Tetris\Buffer;
class Figure
{
    public $coords = [];
    public $color;
    public $shapePattern;

    public function __construct($color, $topCorner, $leftCorner)
    {
        $this->color = $color;
    }

    public function setCoord($coord, $value)
    {
        $this->coords[$coord] = (int) $value;
    }

}
