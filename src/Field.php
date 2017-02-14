<?php
namespace Tetris;

class Field
{
    const FIELDWITH = 10;
    const FIELDHEIGHT = 20;

    public function renderBorders()
    {
        $this->renderRightBorder();
        $this->renderBottomBorder();
    }

    private function renderRightBorder()
    {
        for ($i = 0; $i < self::FIELDHEIGHT; $i++) {
            Buffer::$buffer[$i][self::FIELDWITH - 1] = '.';
        }
    }

    private function renderBottomBorder()
    {
        for ($i = 0; $i < self::FIELDWITH; $i++) {
            Buffer::$buffer[self::FIELDHEIGHT - 1][$i] = '.';
        }
    }

    public function renderFigure()
    {
        return '';
    }

    public function renderLand()
    {
        return '';
    }

    public function draw()
    {
        system('clear');

        foreach (Buffer::$buffer as $rowNum => $row) {
            //somehow this staff helps to avoid cursor blinking
            echo "\033[J";
            $line = implode('', Buffer::$buffer[$rowNum]);
            echo $line;
            echo PHP_EOL;
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
}
