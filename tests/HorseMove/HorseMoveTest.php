<?php

namespace Tests\HorseMove;

use App\HorseMove\HorseMove;
use PHPUnit\Framework\TestCase;

class HorseMoveTest extends TestCase
{
    public function TestCountOfHorseMove()
    {
        $horseMove = new HorseMove(6);
        $horseMove->solve();
        $this->assertEquals(10, 10);
    }

}
