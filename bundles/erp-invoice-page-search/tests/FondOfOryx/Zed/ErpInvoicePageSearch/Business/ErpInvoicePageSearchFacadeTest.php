<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Publisher\ErpInvoicePageSearchPublisher;

class ErpInvoicePageSearchFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Business\Publisher\ErpInvoicePageSearchPublisher
     */
    protected $erpInvoicePageSearchPublisherMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Communication\ErpInvoicePageSearchCommunicationFactory
     */
    protected $erpInvoicePageSearchBusinessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Business\ErpInvoicePageSearchFacadeInterface
     */
    protected $erpInvoicePageSearchFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpInvoicePageSearchBusinessFactoryMock = $this->getMockBuilder(ErpInvoicePageSearchBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchPublisherMock = $this->getMockBuilder(ErpInvoicePageSearchPublisher::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchFacade = new ErpInvoicePageSearchFacade();
        $this->erpInvoicePageSearchFacade->setFactory($this->erpInvoicePageSearchBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testPublish()
    {
        $this->erpInvoicePageSearchBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpInvoicePageSearchPublisher')
            ->willReturn($this->erpInvoicePageSearchPublisherMock);

        $this->erpInvoicePageSearchPublisherMock->expects(static::atLeastOnce())
            ->method('publish');

        $this->erpInvoicePageSearchFacade->publish([]);
    }
}
