<?php
namespace Tetris\Figures;
use Tetris\Buffer;
class Figure
{
    protected $coords = [];
    public $color;
    protected $currentShapePattern;
    protected $shapePatterns;


    public function __construct($color)
    {
        $this->color = $color;
        $this->currentShapePattern = 0;
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
        return $this->shapePatterns[$this->currentShapePattern];
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
        $newShapeKey = $this->getNewShapeKey();
    }

    protected function getNewShapeKey()
    {
        // todo: change to this staff http://php.net/manual/en/arrayiterator.seek.php
        $newShapeKey = $this->currentShapePattern + 1;
        //if we reached end of array, move to default shape pattern
        if ($newShapeKey > count($this->shapePatterns)) {
            return 0;
        }
        return $newShapeKey;

    }

}
