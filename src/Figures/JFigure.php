<?php
namespace Tetris\Figures;

class JFigure extends Figure
{
    public $shapePatterns = [
        [
            [0, 1],
            [0, 1],
            [0, 1],
            [1, 1],
        ],
        [
            [1, 0, 0, 0],
            [1, 1, 1, 1],
        ],
        [
            [1, 1],
            [1, 0],
            [1, 0],
            [1, 0],
        ],
        [
            [1, 1, 1, 1],
            [0, 0, 0, 1],
        ],
    ];
}
