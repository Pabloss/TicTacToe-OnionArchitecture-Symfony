<?php
declare(strict_types=1);

namespace App\Tests\integration;

use App\Core\Application\Event\EventManager;
use App\Core\Application\Event\EventSubscriber\TakeTileEventSubscriber;
use App\Core\Domain\Event\EventInterface;
use App\Core\Domain\Model\TicTacToe\Game\Board;
use App\Core\Domain\Model\TicTacToe\Game\Game as TicTacToe;
use App\Core\Domain\Model\TicTacToe\Game\History;
use App\Core\Domain\Model\TicTacToe\Game\Player;
use App\Core\Domain\Model\TicTacToe\ValueObject\Symbol;
use App\Core\Domain\Model\TicTacToe\ValueObject\Tile;
use App\Core\Domain\Service\FindWinner;
use App\Core\Domain\Service\PlayersFactory;
use App\Presentation\Web\Pub\Event\Event;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{

    /**
     * @test
     */
    public function create_players()
    {
        $eventManager = EventManager::getInstance();
        $game = new TicTacToe(new Board(), new History(), new PlayersFactory(), new FindWinner(),
            $eventManager,
            \uniqid()
        );
        list(Symbol::PLAYER_X_SYMBOL => $playerX, Symbol::PLAYER_0_SYMBOL => $player0) = $game->players();
        self::assertInstanceOf(Player::class, $playerX);
        self::assertInstanceOf(Player::class, $player0);
    }

    /**
     * @test
     */
    public function factor_players()
    {
        $eventManager = EventManager::getInstance();
        $game = new TicTacToe(new Board(), new History(), new PlayersFactory(), new FindWinner(),
            $eventManager,
            \uniqid()
        );
        list(Symbol::PLAYER_X_SYMBOL => $playerX, Symbol::PLAYER_0_SYMBOL => $player0) = $game->players();
        self::assertEquals('X', $playerX->symbol()->value());
        self::assertEquals('0', $player0->symbol()->value());
    }


    /**
     * @test
     */
    public function players_take_turns()
    {
        $history = new History();
        TakeTileEventSubscriber::init($history);
        $eventManager = EventManager::getInstance();
        $eventManager->attach(Event::NAME, function (EventInterface $event){
            TakeTileEventSubscriber::onTakenTile($event);
        });
        $game = new TicTacToe(new Board(), $history, new PlayersFactory(), new FindWinner(),
            $eventManager,
            \uniqid()
        );
        list(Symbol::PLAYER_X_SYMBOL => $playerX, Symbol::PLAYER_0_SYMBOL => $player0) = $game->players();
        $playerX->takeTile(new Tile(0, 0), $game, $history);
        $playerX->takeTile(new Tile(1, 1), $game, $history);
        self::assertEquals(
            TicTacToe::DUPLICATED_TURNS_ERROR,
            $game->errors() & TicTacToe::DUPLICATED_TURNS_ERROR
        );
    }

    /**
     * @test
     */
    public function game_could_not_allow_to_be_started_by_player0()
    {
        $eventManager = EventManager::getInstance();
        $history = new History();
        $game = new TicTacToe(new Board(), $history, new PlayersFactory(), new FindWinner(),
            $eventManager,
            \uniqid()
        );
        list(Symbol::PLAYER_X_SYMBOL => $playerX, Symbol::PLAYER_0_SYMBOL => $player0) = $game->players();
        $player0->takeTile(new Tile(0, 0), $game, $history);

        self::assertEquals(
            TicTacToe::GAME_STARTED_BY_PLAYER0_ERROR,
            $game->errors() & TicTacToe::GAME_STARTED_BY_PLAYER0_ERROR
        );
    }
}
