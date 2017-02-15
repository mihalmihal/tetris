<?php
namespace Tetris;
use \React\EventLoop\Factory as EventFactory;


class Game
{
    public function run()
    {
        $loop = EventFactory::create();
        Buffer::$screenHeight = (int) exec('tput lines') -1;
        Buffer::$screenWidth = (int) exec('tput cols');
        Buffer::initBuffer();
        $field = new Field();


        // $stdin = fopen('php://stdin', 'r');
        // stream_set_blocking($stdin, 0);
        $loop->addPeriodicTimer(0.1, function () use ($field)  {
            $field->renderBorders();
            $field->renderFigure();
            $field->renderLand();
            $field->draw();
        });
        $loop->run();
    }
}
