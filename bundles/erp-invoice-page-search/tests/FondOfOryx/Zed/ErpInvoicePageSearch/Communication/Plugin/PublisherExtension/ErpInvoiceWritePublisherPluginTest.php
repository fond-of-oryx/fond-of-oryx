<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\PublisherExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Dependency\ErpInvoiceEvents;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\ErpInvoicePageSearchFacade;
use FondOfOryx\Zed\ErpInvoicePageSearch\Communication\ErpInvoicePageSearchCommunicationFactory;
use FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Facade\ErpInvoicePageSearchToEventBehaviorFacadeInterface;
use Generated\Shared\Transfer\EventEntityTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class ErpInvoiceWritePublisherPluginTest extends Unit
{
    protected MockObject|ErpInvoicePageSearchCommunicationFactory $factoryMock;

    protected ErpInvoicePageSearchFacade|MockObject $facadeMock;

    protected ErpInvoicePageSearchToEventBehaviorFacadeInterface|MockObject $eventBehaviorFacadeMock;

    /**
     * @var array<\Generated\Shared\Transfer\EventEntityTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $eventEntityTransferMocks;

    protected ErpInvoiceWritePublisherPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ErpInvoicePageSearchCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(ErpInvoicePageSearchFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventBehaviorFacadeMock = $this->getMockBuilder(ErpInvoicePageSearchToEventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventEntityTransferMocks = [
            $this->getMockBuilder(EventEntityTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->plugin = new ErpInvoiceWritePublisherPlugin();
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
            ErpInvoiceEvents::ENTITY_FOO_ERP_INVOICE_CREATE,
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
            ErpInvoiceEvents::ENTITY_FOO_ERP_INVOICE_CREATE,
        );
    }

    /**
     * @return void
     */
    public function testGetSubscribedEvents(): void
    {
        static::assertEquals(
            [
                ErpInvoiceEvents::ENTITY_FOO_ERP_INVOICE_CREATE,
                ErpInvoiceEvents::ENTITY_FOO_ERP_INVOICE_UPDATE,
                ErpInvoiceEvents::ERP_INVOICE_PUBLISH,
            ],
            $this->plugin->getSubscribedEvents(),
        );
    }
}
