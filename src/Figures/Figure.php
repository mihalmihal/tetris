<?php
namespace Tetris\Figures;
use Tetris\Buffer;
class Figure
{
    protected $coords = [];
    public $color;
    public $shapePattern;

    public function __construct($color)
    {
        $this->color = $color;
    }

    public function setCoord($coord, $value)
    {
        $this->coords[$coord] = (int) $value;
    }

    public function getCoords($coord)
    {
        return $this->coords[$coord];
    }

    public function getColor()
    {
        return $this->color;
    }

    public function moveDown()
    {
        $topCorner = $this->getCoords('topCorner');
        $this->setCoord('topCorner', $topCorner + 1);
    }
}
