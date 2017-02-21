<?php
namespace Tetris;

class Buffer
{
    public static $screenWidth;
    public static $screenHeight;
    public static $buffer =  [];

    public static function initBuffer()
    {
        for ($i = 0; $i < self::$screenHeight; $i++) {
            for ($k = 0; $k < self::$screenWidth; $k++) {
                self::$buffer[$i][$k] = '.';
            }
        }
    }
}
