<?php
namespace Tetris;
use \React\EventLoop\Factory as EventFactory;


class Game
{
    const DOWNSPEED = 2;
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
        system('stty -icanon -echo');
        $stdin = fopen('php://stdin', 'r');
        stream_set_blocking($stdin, false);

        $loop = EventFactory::create();
        $loop->addReadStream($stdin, function ($stdin) {
            $key = ord(fgetc($stdin));
            $this->handleInput($key);
        });
        $loop->addPeriodicTimer(0.1, function ()  {
            $this->field->renderFigure();
            $this->field->renderBorders();
            $this->field->draw();
        });
        $loop->addPeriodicTimer(0.5, function() {
            if (!$this->field->hasFigure() && !$this->field->isBlocked) {
                $this->addNewFigure();
            } elseif ($this->field->isBlocked) {
                $this->field->clearFilledRows();
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
        if ($this->field->checkIfMoveIsAllowed(1)) {
            $this->field->currentFigure->moveDown();
        } elseif ($this->field->currentFigure->getCoords('topCorner') == 0) {
            die('GAME OVER' . PHP_EOL);
        } else {
            if ($this->field->hasFigure()) {
                $this->field->destroyFigure();
            }
            $this->field->clearFilledRows();
        }

    }

    private function handleInput($key)
    {
        if (!$this->field->hasFigure()) {
            return false;
        }
        switch ($key) {
            case 68:
                if ($this->field->checkIfMoveIsAllowed(0, -1)) {
                    $this->field->currentFigure->moveLeft();
                }
                break;
            case 67:
                if ($this->field->checkIfMoveIsAllowed(0, 1)) {
                    $this->field->currentFigure->moveRight();
                }
                break;
            case 66:
                if ($this->field->checkIfMoveIsAllowed(self::DOWNSPEED)) {
                    $this->field->currentFigure->moveDown(self::DOWNSPEED);
                }
                break;
        }
    }
}
