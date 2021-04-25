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
    private $arrayDices = [];

    public function __construct(int $nrOfDices = 4)
    {
        $this->nrOfDices = $nrOfDices;

        for ($i = 0; $i < $this->nrOfDices; $i++) {
            $this->dices[$i] = new Dice();
        }
    }

    public function roll(): array
    {
        for ($i = 0; $i < count($this->dices); $i++) {
            $this->arrayDices[] = $this->dices[$i]->roll();
        }
        return $this->arrayDices;
    }

    public function getLastRoll(): array
    {
        $res = [];
        for ($i = 0; $i < $this->nrOfDices; $i++) {
            $res[] = $this->dices[$i]->getLastRoll();
        }
        return $res;
    }
}
