<?php
namespace Tetris\Figures;
use Tetris\Buffer;
class Figure
{
    protected $coords = [];
    public $color;
    protected $shapePatterns = [];
    protected $currentPattern;

    public function __construct($color)
    {
        $this->color = $color;
        $this->currentPattern = $this->shapePatterns[0];
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

    public function getShapePattern()
    {
        return $this->currentPattern;
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

    public function rotate()
    {
        $next = next($this->shapePatterns);
        if ($next === false) {
            $next = reset($this->shapePatterns);
        }
        $this->currentPattern = $next;
    }

    public function rollbackRotation()
    {
        $prev = prev($this->shapePatterns);
        if ($prev === false) {
            $prev = end($this->shapePatterns);
        }
        $this->currentPattern = $prev;
    }
}
