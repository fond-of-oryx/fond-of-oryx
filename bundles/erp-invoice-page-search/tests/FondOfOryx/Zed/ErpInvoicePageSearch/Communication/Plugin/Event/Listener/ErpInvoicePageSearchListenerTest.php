<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\Event\Listener;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Dependency\ErpInvoiceEvents;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\ErpInvoicePageSearchFacade;
use FondOfOryx\Zed\ErpInvoicePageSearch\Communication\ErpInvoicePageSearchCommunicationFactory;
use FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Facade\ErpInvoicePageSearchToEventBehaviorFacadeInterface;

class ErpInvoicePageSearchListenerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\Event\Listener\ErpInvoicePageSearchListener
     */
    protected $erpInvoicePageSearchListener;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Facade\ErpInvoicePageSearchToEventBehaviorFacadeInterface
     */
    protected $erpInvoicePageSearchToEventBehaviorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Communication\ErpInvoicePageSearchCommunicationFactory
     */
    protected $erpInvoicePageSearchCommunicationFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Business\ErpInvoicePageSearchFacadeInterface
     */
    protected $erpInvoicePageSearchFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpInvoicePageSearchCommunicationFactoryMock = $this->getMockBuilder(ErpInvoicePageSearchCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchFacadeMock = $this->getMockBuilder(ErpInvoicePageSearchFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchToEventBehaviorFacadeMock = $this->getMockBuilder(ErpInvoicePageSearchToEventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchListener = new ErpInvoicePageSearchListener();
        $this->erpInvoicePageSearchListener->setFactory($this->erpInvoicePageSearchCommunicationFactoryMock);
        $this->erpInvoicePageSearchListener->setFacade($this->erpInvoicePageSearchFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetSubscribedEvents()
    {
        $transfers = [];

        $this->erpInvoicePageSearchCommunicationFactoryMock->expects(static::atLeastOnce())
            ->method('getEventBehaviorFacade')
            ->willReturn($this->erpInvoicePageSearchToEventBehaviorFacadeMock);

        $this->erpInvoicePageSearchToEventBehaviorFacadeMock->expects(static::atLeastOnce())
            ->method('getEventTransferIds')
            ->with($transfers)
            ->willReturn([]);

        $this->erpInvoicePageSearchFacadeMock->expects(static::atLeastOnce())
            ->method('publish');

        $this->erpInvoicePageSearchListener->handleBulk(
            $transfers,
            ErpInvoiceEvents::ERP_INVOICE_PUBLISH,
        );
    }
}
