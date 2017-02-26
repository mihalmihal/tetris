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

    public function rotate()
    {
        $next = next($this->shapePatterns);
        if ($next === false) {
            $next = reset($this->shapePatterns);
        }
        $this->currentPattern = $next;
    }
}
