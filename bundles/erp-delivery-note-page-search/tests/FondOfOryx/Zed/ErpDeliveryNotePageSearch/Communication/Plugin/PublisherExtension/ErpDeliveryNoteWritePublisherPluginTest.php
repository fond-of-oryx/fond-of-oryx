<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\PublisherExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNote\Dependency\ErpDeliveryNoteEvents;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\ErpDeliveryNotePageSearchFacade;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\ErpDeliveryNotePageSearchCommunicationFactory;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Facade\ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface;
use Generated\Shared\Transfer\EventEntityTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class ErpDeliveryNoteWritePublisherPluginTest extends Unit
{
    protected MockObject|ErpDeliveryNotePageSearchCommunicationFactory $factoryMock;

    protected ErpDeliveryNotePageSearchFacade|MockObject $facadeMock;

    protected ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface|MockObject $eventBehaviorFacadeMock;

    /**
     * @var array<\Generated\Shared\Transfer\EventEntityTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $eventEntityTransferMocks;

    protected ErpDeliveryNoteWritePublisherPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ErpDeliveryNotePageSearchCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(ErpDeliveryNotePageSearchFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventBehaviorFacadeMock = $this->getMockBuilder(ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventEntityTransferMocks = [
            $this->getMockBuilder(EventEntityTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->plugin = new ErpDeliveryNoteWritePublisherPlugin();
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
            ->method('publish')
            ->with($ids);

        $this->plugin->handleBulk(
            $this->eventEntityTransferMocks,
            ErpDeliveryNoteEvents::ENTITY_FOO_ERP_DELIVERY_NOTE_CREATE,
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
            ->method('publish');

        $this->plugin->handleBulk(
            $this->eventEntityTransferMocks,
            ErpDeliveryNoteEvents::ENTITY_FOO_ERP_DELIVERY_NOTE_CREATE,
        );
    }

    /**
     * @return void
     */
    public function testGetSubscribedEvents(): void
    {
        static::assertEquals(
            [
                ErpDeliveryNoteEvents::ENTITY_FOO_ERP_DELIVERY_NOTE_CREATE,
                ErpDeliveryNoteEvents::ENTITY_FOO_ERP_DELIVERY_NOTE_UPDATE,
                ErpDeliveryNoteEvents::ERP_DELIVERY_NOTE_PUBLISH,
            ],
            $this->plugin->getSubscribedEvents(),
        );
    }
}
