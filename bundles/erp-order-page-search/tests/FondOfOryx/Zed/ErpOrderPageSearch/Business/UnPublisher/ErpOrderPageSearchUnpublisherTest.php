<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\UnPublisher;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface;

class ErpOrderPageSearchUnpublisherTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface
     */
    protected $erpOrderPageSearchEntityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Business\UnPublisher\ErpOrderPageSearchUnpublisherInterface
     */
    protected $erpOrderPageSearchUnpublisher;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpOrderPageSearchEntityManagerMock = $this->getMockBuilder(ErpOrderPageSearchEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchUnpublisher = new ErpOrderPageSearchUnpublisher(
            $this->erpOrderPageSearchEntityManagerMock,
        );
    }

    /**
     * @return void
     */
    public function testUnpublish()
    {
        $this->erpOrderPageSearchEntityManagerMock->expects($this->atLeastOnce())
            ->method('deleteErpOrderSearchPagesByErpOrderIds')
            ->with([]);

        $this->erpOrderPageSearchUnpublisher->unpublish([]);
    }
}
