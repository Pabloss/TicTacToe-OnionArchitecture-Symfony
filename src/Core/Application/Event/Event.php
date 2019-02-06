<?php
declare(strict_types=1);

namespace App\Core\Application\Event;

use App\Core\Domain\Event\EventInterface;
use App\Core\Domain\Event\Params\ParamsInterface;

/**
 * Class Event
 * @package App\Core\Domain\Event
 */
class Event implements EventInterface
{
    /** @var string */
    private $name;
    /** @var ParamsInterface */
    private $params;

    /**
     * Event constructor.
     * @param string $name
     * @param ParamsInterface $params
     */
    public function __construct(string $name, ParamsInterface $params)
    {
        $this->name = $name;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ParamsInterface
     */
    public function getParams(): ParamsInterface
    {
        return $this->params;
    }
}
