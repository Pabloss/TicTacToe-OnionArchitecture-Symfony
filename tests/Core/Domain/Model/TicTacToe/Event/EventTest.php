<?php
declare(strict_types=1);

namespace App\Tests\Core\Domain\Model\TicTacToe\Event;

use App\Core\Domain\Event\EventInterface;
use App\Core\Domain\Event\Params\ParamsInterface;
use App\Tests\Stubs\Event\Framework\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    /** @var ParamsInterface */
    private $params;

    /**
     * @test
     */
    public function isInstance()
    {
        $event = new Event('test', $this->params);
        self::assertInstanceOf(EventInterface::class, $event);
    }

    /**
     * @test
     */
    public function getEventName()
    {
        $event = new Event('test', $this->params);
        self::assertEquals('test', $event->name());
    }

    /**
     * @test
     */
    public function getEventParams()
    {
        $event = new Event('test', $this->params);
        self::assertInstanceOf(ParamsInterface::class, $event->params());
        self::assertSame($this->params, $event->params());
    }

    /**
     * @test
     */
    public function eventParamsCouldBeNull()
    {
        $event = new Event('test');
        self::assertEquals('test', $event->name()); // tu już event spełnia asercię, ale możemy dodać nową, gdybyśmy użyli $event->getParams();
        self::assertNull($event->params()); // dopiero Event::getParams(): ?ParamsInterface poprawiło to
    }

    protected function setUp()
    {
        $this->params = $this->prophesize(ParamsInterface::class)->reveal();
    }
}
