<?php
namespace Tetris\Figures;

class ZFigure extends Figure
{
    public $shapePatterns = [
        [
            [1, 1, 0],
            [0, 1, 1]
        ],
        [
            [0, 1],
            [1, 1],
            [1, 0],
        ],

    ];
}
