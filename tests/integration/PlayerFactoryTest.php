<?php
declare(strict_types=1);

namespace App\Tests\integration;

use App\Core\Domain\Model\TicTacToe\Game\Player;
use App\Core\Domain\Model\TicTacToe\ValueObject\Symbol;
use App\Core\Domain\Service\PlayersFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class PlayerFactoryTest
 * @package App\Tests\integration
 */
class PlayerFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function createPlayers()
    {
        $factory = new PlayersFactory();
        list(Symbol::PLAYER_X_SYMBOL => $playerX, Symbol::PLAYER_0_SYMBOL => $player0) = $factory->create();
        self::assertInstanceOf(Player::class, $playerX);
        self::assertInstanceOf(Player::class, $player0);
    }

    /**
     * @test
     */
    public function factor_players()
    {
        $factory = new PlayersFactory();
        list(Symbol::PLAYER_X_SYMBOL => $playerX, Symbol::PLAYER_0_SYMBOL => $player0) = $factory->create();
        self::assertEquals('X', $playerX->symbol()->value());
        self::assertEquals('0', $player0->symbol()->value());
    }
}