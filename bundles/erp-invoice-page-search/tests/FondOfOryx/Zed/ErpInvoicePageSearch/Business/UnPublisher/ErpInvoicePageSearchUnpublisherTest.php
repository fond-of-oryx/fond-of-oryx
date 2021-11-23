<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business\UnPublisher;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManagerInterface;

class ErpInvoicePageSearchUnpublisherTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManagerInterface
     */
    protected $erpInvoicePageSearchEntityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Business\UnPublisher\ErpInvoicePageSearchUnpublisherInterface
     */
    protected $erpInvoicePageSearchUnpublisher;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpInvoicePageSearchEntityManagerMock = $this->getMockBuilder(ErpInvoicePageSearchEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchUnpublisher = new ErpInvoicePageSearchUnpublisher(
            $this->erpInvoicePageSearchEntityManagerMock,
        );
    }

    /**
     * @return void
     */
    public function testUnpublish()
    {
        $this->erpInvoicePageSearchEntityManagerMock->expects($this->atLeastOnce())
            ->method('deleteErpInvoiceSearchPagesByErpInvoiceIds')
            ->with([]);

        $this->erpInvoicePageSearchUnpublisher->unpublish([]);
    }
}
