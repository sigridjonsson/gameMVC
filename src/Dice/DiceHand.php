<?php

declare(strict_types=1);

namespace sigridjonsson\Dice;
use sigridjonsson\Dice\Dice;

/**
 * Class DiceHand.
 */
class DiceHand
{
    private $nrOfDices;
    private $dices;
    private $sum;
    // private $roll = 0;
    private $arrayDices = [];

    public function __construct(int $nrOfDices = 4)
    {
        $this->nrOfDices = $nrOfDices;

        for ($i = 0; $i <= $this->nrOfDices; $i++) {
            $this->dices[$i] = new Dice();
        }
    }

    public function setNrDices(int $nrDices): void
    {
        $this->nrOfDices = $nrDices;
    }

    public function roll(): array
    {
        $this->sum = 0;
        for ($i = 0; $i < count($this->dices); $i++) {
            $this->arrayDices[] = $this->dices[$i]->roll();
        }
        // var_dump($this->arrayDices);
        return $this->arrayDices;
    }

    public function getLastRoll(): string
    {
        $res = "";
        for ($i = 0; $i <= $this->nrOfDices; $i++) {
            $res .= $this->dices[$i]->getLastRoll() . ", ";
        }
        return $res . " = " . $this->sum;
    }

    public function sum(): int
    {
        return $this->sum;
    }
}
