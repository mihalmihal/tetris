<?php
namespace Tetris;

class FiguresFactory
{
    private static $shapes = ['I', 'J', 'L', 'O', 'S', 'T', 'Z'];
    /**
    1: Red
    2: Green
    3: Yellow
    4: Blue
    5: Magenta/Purple
    6: Cyan
    */
    private static $colors = [1, 2, 3, 4, 5, 6];

    public static function create() {
        $shape = self::getRandomValue(self::$shapes);
        $color = self::getRandomValue(self::$colors);
        $figureClass = '\Tetris\Figures\\' . $shape . 'Figure';
        return new $figureClass($color);
    }

    private static function getRandomValue(array $arr)
    {
        $key = array_rand($arr);
        return $arr[$key];
    }

}
