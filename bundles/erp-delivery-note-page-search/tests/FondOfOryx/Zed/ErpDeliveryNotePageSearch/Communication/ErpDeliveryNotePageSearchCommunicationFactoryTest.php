<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\ErpDeliveryNotePageSearchCommunicationFactory;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Facade\ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\Container;

class ErpDeliveryNotePageSearchCommunicationFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\ErpDeliveryNotePageSearchCommunicationFactory
     */
    protected $erpDeliveryNotePageSearchCommunicationFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Facade\ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface
     */
    protected $erpDeliveryNotePageSearchToEventBehaviorFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchToEventBehaviorFacadeMock = $this->getMockBuilder(ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchCommunicationFactory = new ErpDeliveryNotePageSearchCommunicationFactory();
        $this->erpDeliveryNotePageSearchCommunicationFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetEventBehaviorFacade()
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR)
            ->willReturn($this->erpDeliveryNotePageSearchToEventBehaviorFacadeMock);

        $this->assertInstanceOf(
            ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface::class,
            $this->erpDeliveryNotePageSearchCommunicationFactory->getEventBehaviorFacade(),
        );
    }
}
