<?php
declare(strict_types=1);

namespace App\Core\Domain\Model\TicTacToe\Game\Board;

use App\Core\Domain\Model\TicTacToe\Game\Player\Player;
use App\Core\Domain\Model\TicTacToe\Game\Player\Symbol;

/**
 * Class Board
 * @package App\Core\Domain\Model\TicTacToe\Game
 */
class Board
{
    /** @var array */
    private $board;

    /**
     * Board constructor.
     */
    public function __construct()
    {
        $this->board = array_fill(0, 9, null);
    }
    
    public static function fromContents(array $contents)
    {
        $board = new self();
        /**
         * @var  $index
         * @var Player $content
         */
        foreach ($contents as $index => $content){
            $board->mark(
                new Tile(($index - ($index % 3)) / 3, $index % 3),
                new Player(new Symbol($content), '1')
            );
        }
        //  [($index - ($index % 3)) / 3 , $index % 3]
        return $board;
    }

    /**
     * @param Tile $tile
     * @param Player $player
     */
    public function mark(Tile $tile, Player $player): void
    {
        $this->board[$tile->column() + 3 * $tile->row()] = $player;
    }

    /**
     * @return array
     */
    public function &contents(): array
    {
        return $this->board;
    }

    /**
     * @param Tile $tile
     * @return mixed
     */
    public function getPlayer(Tile $tile)
    {
        return $this->board[$tile->column() + 3 * $tile->row()];
    }
}