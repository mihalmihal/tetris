<?php
namespace Tetris\Figures;

class JFigure extends Figure
{
    protected $shapePatterns = [
        [
            [0, 1, 0],
            [0, 1, 0],
            [1, 1, 0]
        ],
        [
            [1, 0, 0],
            [1, 1, 1],
            [0, 0, 0]
        ],
        [
            [1, 1, 0],
            [1, 0, 0],
            [1, 0, 0],
        ],
        [
            [0, 0, 0],
            [1, 1, 1],
            [0, 0, 1],
        ],
    ];
}
