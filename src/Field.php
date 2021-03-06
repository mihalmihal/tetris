<?php
namespace Tetris;

class Field
{
    const FIELDWITH = 30;
    const FIELDHEIGHT = 30;
    const BORDERCOLOR = "\033[47m \033[0m";
    public $currentFigure = false;
    public $isBlocked = false;

    public function renderBorders()
    {
        $this->renderRightBorder();
        $this->renderBottomBorder();
    }

    private function renderRightBorder()
    {
        for ($i = 0; $i < self::FIELDHEIGHT; $i++) {
            Buffer::$buffer[$i][self::FIELDWITH] = self::BORDERCOLOR;
        }
    }

    private function renderBottomBorder()
    {
        for ($i = 0; $i < self::FIELDWITH; $i++) {
            Buffer::$buffer[self::FIELDHEIGHT - 1][$i] = self::BORDERCOLOR;
        }
    }

    public function renderFigure()
    {
        if ($this->currentFigure) {
            $this->clearPreviousFigurePlace();
            $this->moveFigureToNewPlace();
        }
    }

    private function clearPreviousFigurePlace()
    {
        for ($i = 0; $i < self::FIELDHEIGHT; $i++) {
            for ($k = 0; $k < self::FIELDWITH; $k++) {
                if (Buffer::$buffer[$i][$k] != self::BORDERCOLOR) {
                    Buffer::$buffer[$i][$k] =  " ";
                }
            }
        }
    }

    private function moveFigureToNewPlace($color = false)
    {
        if (!$color) {
            $color = $this->fillPoint($this->currentFigure->color);
        }
        $pattern = $this->currentFigure->getShapePattern();
        foreach($pattern as $rowKey => $rowValue) {
            foreach ($rowValue as  $pointKey => $pointValue) {
                $top = $this->currentFigure->getCoords('topCorner') + $rowKey;
                $left = $this->currentFigure->getCoords('leftCorner') + $pointKey;
                if ($pointValue > 0) {
                    Buffer::$buffer[$top][$left] = $color;
                }
            }
        }
    }

    protected function fillPoint($color)
    {
        return "\033[4{$color}m \033[0m";
    }

    public function draw()
    {
        system('clear');

        foreach (Buffer::$buffer as $rowNum => $row) {
            //somehow this staff helps to avoid cursor blinking
            echo "\033[J";
            $line = implode('', Buffer::$buffer[$rowNum]);
            echo $line . PHP_EOL;
            //somehow this staff helps to avoid cursor blinking
            echo "\e[?25l";
        }
    }

    public function setFigure($figure)
    {
        $this->currentFigure = $figure;
        $this->currentFigure->setCoord('topCorner', 0);
        $this->currentFigure->setCoord('leftCorner', self::FIELDWITH/2);
    }

    public function hasFigure()
    {
        return $this->currentFigure !== false;
    }

    public function checkIfMoveIsAllowed($topDirection = 0, $leftDirection = 0)
    {
        $pattern = $this->currentFigure->getShapePattern();
        foreach($pattern as $rowKey => $rowValue) {
            foreach ($rowValue as  $pointKey => $pointValue) {
                if ($pointValue == 0) {
                    continue;
                }
                $top = $this->currentFigure->getCoords('topCorner') + $rowKey + $topDirection;
                $left = $this->currentFigure->getCoords('leftCorner') + $pointKey + $leftDirection;
                    if($left < 0 || $top >= self::FIELDHEIGHT || Buffer::$buffer[$top][$left] == self::BORDERCOLOR) {
                        return false;
                    }
            }
        }
        return true;
    }

    public function destroyFigure()
    {
        $this->moveFigureToNewPlace(self::BORDERCOLOR);
        $this->currentFigure = false;
    }

    public function clearFilledRows()
    {
        $rowsWasDeleted = false;
        for ($i = 0; $i < self::FIELDHEIGHT - 1; $i++) {
            $filled = 0;
            for ($k = 0; $k < self::FIELDWITH; $k++) {
                if (Buffer::$buffer[$i][$k] == self::BORDERCOLOR) {
                    $filled++;
                }
            }
            if ($filled == self::FIELDWITH) {
                unset(Buffer::$buffer[$i]);
                $emptyRow = Buffer::$buffer[Buffer::$screenHeight - 1];
                array_unshift(Buffer::$buffer, $emptyRow);
                $rowsWasDeleted = true;
            }
        }
        $this->isBlocked = $rowsWasDeleted;
    }
}
