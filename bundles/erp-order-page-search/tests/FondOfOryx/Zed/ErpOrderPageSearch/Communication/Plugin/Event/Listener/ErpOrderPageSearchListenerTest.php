<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Event\Listener;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Dependency\ErpOrderEvents;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\ErpOrderPageSearchFacade;
use FondOfOryx\Zed\ErpOrderPageSearch\Communication\ErpOrderPageSearchCommunicationFactory;
use FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Facade\ErpOrderPageSearchToEventBehaviorFacadeInterface;

class ErpOrderPageSearchListenerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Event\Listener\ErpOrderPageSearchListener
     */
    protected $erpOrderPageSearchListener;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Facade\ErpOrderPageSearchToEventBehaviorFacadeInterface
     */
    protected $erpOrderPageSearchToEventBehaviorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Communication\ErpOrderPageSearchCommunicationFactory
     */
    protected $erpOrderPageSearchCommunicationFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Business\ErpOrderPageSearchFacadeInterface
     */
    protected $erpOrderPageSearchFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpOrderPageSearchCommunicationFactoryMock = $this->getMockBuilder(ErpOrderPageSearchCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchFacadeMock = $this->getMockBuilder(ErpOrderPageSearchFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToEventBehaviorFacadeMock = $this->getMockBuilder(ErpOrderPageSearchToEventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchListener = new ErpOrderPageSearchListener();
        $this->erpOrderPageSearchListener->setFactory($this->erpOrderPageSearchCommunicationFactoryMock);
        $this->erpOrderPageSearchListener->setFacade($this->erpOrderPageSearchFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetSubscribedEvents()
    {
        $transfers = [];

        $this->erpOrderPageSearchCommunicationFactoryMock->expects(static::atLeastOnce())
            ->method('getEventBehaviorFacade')
            ->willReturn($this->erpOrderPageSearchToEventBehaviorFacadeMock);

        $this->erpOrderPageSearchToEventBehaviorFacadeMock->expects(static::atLeastOnce())
            ->method('getEventTransferIds')
            ->with($transfers)
            ->willReturn([]);

        $this->erpOrderPageSearchFacadeMock->expects(static::atLeastOnce())
            ->method('publish');

        $this->erpOrderPageSearchListener->handleBulk(
            $transfers,
            ErpOrderEvents::ERP_ORDER_PUBLISH,
        );
    }
}
