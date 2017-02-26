<?php
namespace Tetris\Figures;

class SFigure extends Figure
{
    public $shapePatterns = [
        [
            [0, 1, 1],
            [1, 1, 0]
        ],
        [
            [1, 0],
            [1, 1],
            [0, 1],
        ]
    ];
}
