<?php
declare(strict_types=1);

namespace App\AppCore\DomainModel\History;

use App\AppCore\DomainModel\Game\GameInterface;

/**
 * Interface HistoryRepositoryInterface
 * @package App\AppCore\DomainModel\History
 */
interface HistoryRepositoryInterface
{
    /**
     * @param GameInterface $game
     * @return HistoryItem|null
     */
    public function getLastByGame(GameInterface $game): ?HistoryItem;

    /**
     * @param GameInterface $game
     * @return HistoryContent|null
     */
    public function getByGame(GameInterface $game): ?HistoryContent;

    /**
     * @param HistoryItem $historyItem
     */
    public function save(HistoryItem $historyItem): void;
}
