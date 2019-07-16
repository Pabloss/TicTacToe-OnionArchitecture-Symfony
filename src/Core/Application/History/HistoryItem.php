<?php
declare(strict_types=1);

namespace App\Core\Application\History;

use App\Core\Domain\Model\TicTacToe\Game\Board\Tile;
use App\Core\Domain\Model\TicTacToe\Game\Game;
use App\Core\Domain\Model\TicTacToe\Game\Player\Player;


/**
 * Class HistoryItem
 * @package App\Tests\Stubs\History
 */
class HistoryItem
{
    /** @var \App\Core\Domain\Model\TicTacToe\Game\Player\Player */
    private $player;

    /** @var Tile */
    private $tile;

    /** @var Game */
    private $game;

    /**
     * HistoryItem constructor.
     * @param \App\Core\Domain\Model\TicTacToe\Game\Player\Player $player
     * @param Tile $tile
     * @param Game $game
     */
    public function __construct(Player $player = null, Tile $tile = null, Game $game = null)
    {
        $this->player = $player;
        $this->tile = $tile;
        $this->game = $game;
    }

    /**
     * @return \App\Core\Domain\Model\TicTacToe\Game\Player\Player
     */
    public function player(): ?Player
    {
        return $this->player;
    }

    /**
     * @return Tile
     */
    public function tile(): ?Tile
    {
        return $this->tile;
    }

    /**
     * @return array
     */
    public function getTileArray(): array
    {
        return [$this->tile->row(), $this->tile->column()];
    }

    /**
     * @return Game
     */
    public function game(): ?Game
    {
        return $this->game;
    }
}
