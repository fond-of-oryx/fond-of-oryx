<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\UnPublisher;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface;

class ErpDeliveryNotePageSearchUnpublisherTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface
     */
    protected $erpDeliveryNotePageSearchEntityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\UnPublisher\ErpDeliveryNotePageSearchUnpublisherInterface
     */
    protected $erpDeliveryNotePageSearchUnpublisher;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpDeliveryNotePageSearchEntityManagerMock = $this->getMockBuilder(ErpDeliveryNotePageSearchEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchUnpublisher = new ErpDeliveryNotePageSearchUnpublisher(
            $this->erpDeliveryNotePageSearchEntityManagerMock,
        );
    }

    /**
     * @return void
     */
    public function testUnpublish()
    {
        $this->erpDeliveryNotePageSearchEntityManagerMock->expects($this->atLeastOnce())
            ->method('deleteErpDeliveryNoteSearchPagesByErpDeliveryNoteIds')
            ->with([]);

        $this->erpDeliveryNotePageSearchUnpublisher->unpublish([]);
    }
}
