<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\PublisherExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Dependency\ErpOrderEvents;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\ErpOrderPageSearchFacade;
use FondOfOryx\Zed\ErpOrderPageSearch\Communication\ErpOrderPageSearchCommunicationFactory;
use FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Facade\ErpOrderPageSearchToEventBehaviorFacadeInterface;
use Generated\Shared\Transfer\EventEntityTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class ErpOrderDeletePublisherPluginTest extends Unit
{
    protected MockObject|ErpOrderPageSearchCommunicationFactory $factoryMock;

    protected ErpOrderPageSearchFacade|MockObject $facadeMock;

    protected ErpOrderPageSearchToEventBehaviorFacadeInterface|MockObject $eventBehaviorFacadeMock;

    /**
     * @var array<\Generated\Shared\Transfer\EventEntityTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $eventEntityTransferMocks;

    protected ErpOrderDeletePublisherPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ErpOrderPageSearchCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(ErpOrderPageSearchFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventBehaviorFacadeMock = $this->getMockBuilder(ErpOrderPageSearchToEventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventEntityTransferMocks = [
            $this->getMockBuilder(EventEntityTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->plugin = new ErpOrderDeletePublisherPlugin();
        $this->plugin->setFactory($this->factoryMock);
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testHandleBulk(): void
    {
        $ids = [1];

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getEventBehaviorFacade')
            ->willReturn($this->eventBehaviorFacadeMock);

        $this->eventBehaviorFacadeMock->expects(static::atLeastOnce())
            ->method('getEventTransferIds')
            ->with($this->eventEntityTransferMocks)
            ->willReturn($ids);

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('unpublish')
            ->with($ids);

        $this->plugin->handleBulk(
            $this->eventEntityTransferMocks,
            ErpOrderEvents::ENTITY_FOO_ERP_ORDER_DELETE,
        );
    }

    /**
     * @return void
     */
    public function testHandleBulkWithoutIds(): void
    {
        $ids = [];

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getEventBehaviorFacade')
            ->willReturn($this->eventBehaviorFacadeMock);

        $this->eventBehaviorFacadeMock->expects(static::atLeastOnce())
            ->method('getEventTransferIds')
            ->with($this->eventEntityTransferMocks)
            ->willReturn($ids);

        $this->facadeMock->expects(static::never())
            ->method('unpublish');

        $this->plugin->handleBulk(
            $this->eventEntityTransferMocks,
            ErpOrderEvents::ENTITY_FOO_ERP_ORDER_CREATE,
        );
    }

    /**
     * @return void
     */
    public function testGetSubscribedEvents(): void
    {
        static::assertEquals(
            [
                ErpOrderEvents::ENTITY_FOO_ERP_ORDER_DELETE,
                ErpOrderEvents::ERP_ORDER_UNPUBLISH,
            ],
            $this->plugin->getSubscribedEvents(),
        );
    }
}
