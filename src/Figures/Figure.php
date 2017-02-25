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

    public function moveDown($rowsToMove = 1)
    {
        $topCorner = $this->getCoords('topCorner');
        $this->setCoord('topCorner', $topCorner + $rowsToMove);
    }

    public function moveLeft()
    {
        $leftCorner = $this->getCoords('leftCorner');
        $this->setCoord('leftCorner', $leftCorner - 1);
    }

    public function moveRight()
    {
        $leftCorner = $this->getCoords('leftCorner');
        $this->setCoord('leftCorner', $leftCorner + 1);
    }
}
