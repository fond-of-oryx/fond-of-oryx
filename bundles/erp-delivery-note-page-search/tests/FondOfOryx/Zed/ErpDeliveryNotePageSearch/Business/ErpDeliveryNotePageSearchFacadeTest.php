<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher\ErpDeliveryNotePageSearchPublisher;

class ErpDeliveryNotePageSearchFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher\ErpDeliveryNotePageSearchPublisher
     */
    protected $erpDeliveryNotePageSearchPublisherMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\ErpDeliveryNotePageSearchCommunicationFactory
     */
    protected $erpDeliveryNotePageSearchBusinessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\ErpDeliveryNotePageSearchFacadeInterface
     */
    protected $erpDeliveryNotePageSearchFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpDeliveryNotePageSearchBusinessFactoryMock = $this->getMockBuilder(ErpDeliveryNotePageSearchBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchPublisherMock = $this->getMockBuilder(ErpDeliveryNotePageSearchPublisher::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchFacade = new ErpDeliveryNotePageSearchFacade();
        $this->erpDeliveryNotePageSearchFacade->setFactory($this->erpDeliveryNotePageSearchBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testPublish()
    {
        $this->erpDeliveryNotePageSearchBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpDeliveryNotePageSearchPublisher')
            ->willReturn($this->erpDeliveryNotePageSearchPublisherMock);

        $this->erpDeliveryNotePageSearchPublisherMock->expects(static::atLeastOnce())
            ->method('publish');

        $this->erpDeliveryNotePageSearchFacade->publish([]);
    }
}
