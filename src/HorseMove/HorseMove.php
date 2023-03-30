<?php

namespace App\HorseMove;
class HorseMove {
    private array $board;     // 2D array to represent the chessboard
    private int $n;         // size of the chessboard
    private array $moves;     // possible moves for the knight

    public function __construct($n) {
        $this->n = $n;
        $this->board = array_fill(0, $n, array_fill(0, $n, 0));
        $this->moves = [
            [2, 1], [1, 2], [-1, 2], [-2, 1],
            [-2, -1], [-1, -2], [1,-2], [2, -1]
        ];
    }
    public function solve(): bool
    {
        return $this->backtrack(0, 0, 1);
    }

    private function isValidMove($x, $y): bool
    {
        return 0 <= $x && $x < $this->n && 0 <= $y && $y < $this->n && $this->board[$x][$y] == 0;
    }

    private function backtrack($x, $y, $step): bool
    {
        $this->board[$x][$y] = $step;

        if ($step == $this->n*$this->n) {
            return true;
        }

        foreach ($this->moves as $move) {
            $newX = $x + $move[0];
            $newY = $y + $move[1];
            if ($this->isValidMove($newX, $newY)) {
                if ($this->backtrack($newX, $newY, $step+1)) {
                    return true;
                }
            }
        }

        $this->board[$x][$y] = 0;
        return false;
    }

    public function getBoard(): array
    {
        $result = [];
        for ($i = 0; $i < $this->n; $i++) {
            $row = [];
            for ($j = 0; $j < $this->n; $j++) {
                $row[] = $this->board[$i][$j];
            }
            $result[] = $row;
        }
        return $result;
    }
}

$knight_tour = new HorseMove(6);
if ($knight_tour->solve()) {
    $board = $knight_tour->getBoard();
    foreach ($board as $row) {
        foreach ($row as $cell) {
            printf("%2d ", $cell);
        }
        echo "\n";
    }
} else {
    echo "No solution found\n";
}