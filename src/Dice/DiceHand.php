<?php

declare(strict_types=1);

namespace sigridjonsson\Dice;

/**
 * Class DiceHand.
 */
class DiceHand
{
    public $nrOfDices;
    private $dices;
    private $sum;

    public function __construct(int $nrOfDices = 1)
    {
        $this->nrOfDices = $nrOfDices;

        for ($i = 0; $i <= $this->nrOfDices; $i++) {
            $this->dices[$i] = new Dice();
        }
    }

    public function roll(): void
    {
        $this->sum = 0;
        for ($i = 0; $i <= $this->nrOfDices; $i++) {
            $this->sum += $this->dices[$i]->roll();
        }
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
