<?php
declare(strict_types=1);

namespace App\Tests\Core\Domain\Model\TicTacToe;

use App\Core\Domain\Model\TicTacToe\Game\Board\Tile;
use PHPUnit\Framework\TestCase;

class TileTest extends TestCase
{
    /**
     * @test
     */
    public function gets_row_and_column()
    {
        $tile = new Tile(1, 2);
        self::assertEquals(1, $tile->row());
        self::assertEquals(2, $tile->column());
    }

    /**
     * @test
     * @expectedException App\Core\Domain\Model\TicTacToe\Exception\OutOfLegalSizeException
     */
    public function throws_exceptions_on_illegal_position__column()
    {
        new Tile(1, 3);
    }

    /**
     * @test
     * @expectedException App\Core\Domain\Model\TicTacToe\Exception\OutOfLegalSizeException
     */
    public function throws_exceptions_on_illegal_position__row()
    {
        new Tile(3, 1);
    }

    /**
     * @test
     * @expectedException App\Core\Domain\Model\TicTacToe\Exception\OutOfLegalSizeException
     */
    public function throws_exceptions_on_illegal_position__both()
    {
        new Tile(3, 5);
    }
}
