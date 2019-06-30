<?php
declare(strict_types=1);

namespace App\Core\Application\Service;

use App\Core\Application\Validation\TurnControl;
use App\Core\Domain\Model\TicTacToe\Exception\NotAllowedSymbolValue;
use App\Core\Domain\Model\TicTacToe\Game\Game;
use App\Core\Domain\Model\TicTacToe\Game\HistoryInterface;
use App\Core\Domain\Model\TicTacToe\Game\Player;
use App\Core\Domain\Model\TicTacToe\ValueObject\Tile;

/**
 * Class TakeTileService
 * @package App\Core\Application\Service
 */
class TakeTileService
{
    /** @var Game */
    private $game;

    /** @var HistoryInterface */
    private $history;

    /** @var TurnControl */
    private $turnControl;

    /**
     * TakeTileService constructor.
     * @param Game $game
     * @param HistoryInterface $history
     * @param TurnControl $turnControl
     */
    public function __construct(Game $game, HistoryInterface $history, TurnControl $turnControl)
    {
        $this->game = $game;
        $this->history = $history;
        $this->turnControl = $turnControl;
    }

    /**
     * @param Player $player
     * @param Tile $tile
     * @throws NotAllowedSymbolValue
     */
    public function takeTile(Player $player, Tile $tile)
    {
        $this->turnControl->validateTurn($player, $this->game, $this->history);
        $this->game->board()->mark($tile, $player);
        $this->history->saveTurn($player, $tile, $this->game);
    }
}
