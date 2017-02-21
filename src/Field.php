<?php
namespace Tetris;

class Field
{
    const FIELDWITH = 30;
    const FIELDHEIGHT = 30;

    public function renderBorders()
    {
        $this->renderRightBorder();
        $this->renderBottomBorder();
    }

    private function renderRightBorder()
    {
        for ($i = 0; $i < self::FIELDHEIGHT; $i++) {
            Buffer::$buffer[$i][self::FIELDWITH - 1] = "\033[47m \033[0m";
        }
    }

    private function renderBottomBorder()
    {
        for ($i = 0; $i < self::FIELDWITH; $i++) {
            Buffer::$buffer[self::FIELDHEIGHT - 1][$i] = "\033[47m \033[0m";
        }
    }

    public function renderFigure()
    {
        foreach($this->currentFigure->shapePattern as $rowKey => $rowValue) {
            foreach ($rowValue as  $pointKey => $pointValue) {
                $top = $this->currentFigure->coords['topCorner'] + $rowKey;
                $left = $this->currentFigure->coords['leftCorner'] + $pointKey;
                if ($pointValue > 0) {
                    Buffer::$buffer[$top][$left] = $this->fillPoint($this->currentFigure->color);
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
            // if ($rowNum < self::FIELDHEIGHT - 1) {
                // $line = implode('', $this->buffer[$rowNum]);
                // echo $line;
                // echo PHP_EOL;
                // continue;
            // }
            // foreach ($row as $colNum => $col) {
            //     if($colNum < self::FIELDWITH - 1){
            //         echo '0';
            //     } else {
            //         $remainingColsInRow = $this->buffer::$screenWidth - ($colNum);
            //     }
            // }
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
        return isset($this->currentFigure);
    }
}
