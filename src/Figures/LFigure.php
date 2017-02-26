<?php
namespace Tetris\Figures;

class LFigure extends Figure
{
    public $shapePatterns = [
        [
            [1, 0],
            [1, 0],
            [1, 0],
            [1, 1],
        ],
        [
            [1, 1, 1, 1],
            [1, 0, 0, 0],
        ],
        [
            [1, 1],
            [0, 1],
            [0, 1],
            [0, 1],
        ],
        [
            [0, 0, 0, 1],
            [1, 1, 1, 1],
        ],
    ];
}
