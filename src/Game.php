<?php
namespace Tetris;
use \React\EventLoop\Factory as EventFactory;


class Game
{
    public $field;

    public function __construct()
    {
        $this->field = new Field();
        Buffer::$screenHeight = (int) exec('tput lines') -1;
        Buffer::$screenWidth = (int) exec('tput cols');
        Buffer::initBuffer();
    }

    public function run()
    {
        $loop = EventFactory::create();
        // $stdin = fopen('php://stdin', 'r');
        // stream_set_blocking($stdin, 0);
        $loop->addPeriodicTimer(0.1, function ()  {
            if (!$this->field->hasFigure()) {
                $figure = FiguresFactory::create();
                $this->field->setFigure($figure);
            }
            $this->field->renderFigure();
            $this->field->renderBorders();
            $this->field->draw();
        });
        $loop->run();
    }
}
