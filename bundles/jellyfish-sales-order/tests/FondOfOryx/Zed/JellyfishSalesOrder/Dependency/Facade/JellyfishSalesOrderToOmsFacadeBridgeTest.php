<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade;

use Codeception\Test\Unit;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Oms\Business\OmsFacadeInterface;

class JellyfishSalesOrderToOmsFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Oms\Business\OmsFacadeInterface
     */
    protected $omsFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\ObjectCollection|mixed
     */
    protected $objectCollectionMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToOmsFacadeBridge
     */
    protected $omsFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->omsFacadeMock = $this->getMockBuilder(OmsFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->objectCollectionMock = $this->getMockBuilder(ObjectCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->omsFacadeBridge = new JellyfishSalesOrderToOmsFacadeBridge(
            $this->omsFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testTriggerEvent(): void
    {
        $eventId = 'Foo';
        $logContext = [];
        $data = [];

        $this->omsFacadeMock->expects(static::atLeastOnce())
            ->method('triggerEvent')
            ->with($eventId, $this->objectCollectionMock, $logContext, $data)
            ->willReturn($data);

        static::assertEquals(
            $data,
            $this->omsFacadeBridge->triggerEvent($eventId, $this->objectCollectionMock, $logContext, $data),
        );
    }
}
