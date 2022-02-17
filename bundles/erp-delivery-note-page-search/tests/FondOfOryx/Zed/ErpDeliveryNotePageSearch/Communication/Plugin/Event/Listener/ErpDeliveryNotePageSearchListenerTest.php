<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\Event\Listener;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNote\Dependency\ErpDeliveryNoteEvents;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\ErpDeliveryNotePageSearchFacade;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\ErpDeliveryNotePageSearchCommunicationFactory;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Facade\ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface;

class ErpDeliveryNotePageSearchListenerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\Event\Listener\ErpDeliveryNotePageSearchListener
     */
    protected $erpDeliveryNotePageSearchListener;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Facade\ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface
     */
    protected $erpDeliveryNotePageSearchToEventBehaviorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\ErpDeliveryNotePageSearchCommunicationFactory
     */
    protected $erpDeliveryNotePageSearchCommunicationFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\ErpDeliveryNotePageSearchFacadeInterface
     */
    protected $erpDeliveryNotePageSearchFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpDeliveryNotePageSearchCommunicationFactoryMock = $this->getMockBuilder(ErpDeliveryNotePageSearchCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchFacadeMock = $this->getMockBuilder(ErpDeliveryNotePageSearchFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchToEventBehaviorFacadeMock = $this->getMockBuilder(ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchListener = new ErpDeliveryNotePageSearchListener();
        $this->erpDeliveryNotePageSearchListener->setFactory($this->erpDeliveryNotePageSearchCommunicationFactoryMock);
        $this->erpDeliveryNotePageSearchListener->setFacade($this->erpDeliveryNotePageSearchFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetSubscribedEvents()
    {
        $transfers = [];

        $this->erpDeliveryNotePageSearchCommunicationFactoryMock->expects(static::atLeastOnce())
            ->method('getEventBehaviorFacade')
            ->willReturn($this->erpDeliveryNotePageSearchToEventBehaviorFacadeMock);

        $this->erpDeliveryNotePageSearchToEventBehaviorFacadeMock->expects(static::atLeastOnce())
            ->method('getEventTransferIds')
            ->with($transfers)
            ->willReturn([]);

        $this->erpDeliveryNotePageSearchFacadeMock->expects(static::atLeastOnce())
            ->method('publish');

        $this->erpDeliveryNotePageSearchListener->handleBulk(
            $transfers,
            ErpDeliveryNoteEvents::ERP_DELIVERY_NOTE_PUBLISH,
        );
    }
}
