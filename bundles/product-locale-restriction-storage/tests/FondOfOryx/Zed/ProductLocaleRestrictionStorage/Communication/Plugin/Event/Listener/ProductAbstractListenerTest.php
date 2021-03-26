<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Event\Listener;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\ProductLocaleRestrictionStorageFacade;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\ProductLocaleRestrictionStorageCommunicationFactory;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToEventBehaviorFacadeInterface;
use Generated\Shared\Transfer\EventEntityTransfer;

class ProductAbstractListenerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\ProductLocaleRestrictionStorageFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\ProductLocaleRestrictionStorageCommunicationFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToEventBehaviorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $eventBehaviorFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\EventEntityTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $eventEntityTransferMocks;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Event\Listener\ProductAbstractListener
     */
    protected $productAbstractListener;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(ProductLocaleRestrictionStorageFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(ProductLocaleRestrictionStorageCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventBehaviorFacadeMock = $this->getMockBuilder(ProductLocaleRestrictionStorageToEventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventEntityTransferMocks = [
            $this->getMockBuilder(EventEntityTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->productAbstractListener = new class extends ProductAbstractListener {
            /**
             * @return void
             */
            protected function preventTransaction(): void
            {
            }
        };

        $this->productAbstractListener->setFacade($this->facadeMock);
        $this->productAbstractListener->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testHandleBulk(): void
    {
        $eventName = 'foo';
        $eventTransferIds = [1, 2, 3, 4];

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getEventBehaviorFacade')
            ->willReturn($this->eventBehaviorFacadeMock);

        $this->eventBehaviorFacadeMock->expects(static::atLeastOnce())
            ->method('getEventTransferIds')
            ->with($this->eventEntityTransferMocks)
            ->willReturn($eventTransferIds);

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('publish')
            ->with($eventTransferIds);

        $this->productAbstractListener->handleBulk($this->eventEntityTransferMocks, $eventName);
    }
}
