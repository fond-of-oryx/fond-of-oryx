<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Event\Listener;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\ProductLocaleRestrictionStorageFacade;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\ProductLocaleRestrictionStorageCommunicationFactory;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToEventBehaviorFacadeInterface;
use Generated\Shared\Transfer\EventEntityTransfer;
use Orm\Zed\ProductLocaleRestriction\Persistence\Map\FooProductAbstractLocaleRestrictionTableMap;

class ProductAbstractLocaleRestrictionListenerTest extends Unit
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
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\EventEntityTransfer>
     */
    protected $eventEntityTransferMocks;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Event\Listener\ProductAbstractLocaleRestrictionListener
     */
    protected ProductAbstractLocaleRestrictionListener $productAbstractLocaleRestrictionListener;

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

        $this->productAbstractLocaleRestrictionListener = new class extends ProductAbstractLocaleRestrictionListener {
            /**
             * @return void
             */
            protected function preventTransaction(): void
            {
            }
        };

        $this->productAbstractLocaleRestrictionListener->setFacade($this->facadeMock);
        $this->productAbstractLocaleRestrictionListener->setFactory($this->factoryMock);
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
            ->method('getEventTransferForeignKeys')
            ->with($this->eventEntityTransferMocks, FooProductAbstractLocaleRestrictionTableMap::COL_FK_PRODUCT_ABSTRACT)
            ->willReturn($eventTransferIds);

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('publish')
            ->with($eventTransferIds);

        $this->productAbstractLocaleRestrictionListener->handleBulk($this->eventEntityTransferMocks, $eventName);
    }
}
