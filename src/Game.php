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
            $this->field->renderFigure();
            $this->field->renderBorders();
            $this->field->draw();
        });

        $loop->addPeriodicTimer(0.5, function() {
            if (!$this->field->hasFigure()) {
                $this->addNewFigure();
            } else {
                $this->step();
            }
        });

        $loop->run();
    }

    private function addNewFigure()
    {
        $figure = FiguresFactory::create();
        $this->field->setFigure($figure);
    }

    private function step()
    {
        if ($this->field->checkIfMoveDownIsAllowed()) {
            $this->field->currentFigure->moveDown();
        } elseif ($this->field->currentFigure->getCoords('topCorner') == 0) {
            die('GAME OVER' . PHP_EOL);
        } else {
            $this->field->destroyFigure();
        }

    }
}
