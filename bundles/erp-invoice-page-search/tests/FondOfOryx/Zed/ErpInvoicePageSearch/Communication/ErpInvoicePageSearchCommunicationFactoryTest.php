<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoicePageSearch\Communication\ErpInvoicePageSearchCommunicationFactory;
use FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Facade\ErpInvoicePageSearchToEventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\Container;

class ErpInvoicePageSearchCommunicationFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Communication\ErpInvoicePageSearchCommunicationFactory
     */
    protected $erpInvoicePageSearchCommunicationFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Facade\ErpInvoicePageSearchToEventBehaviorFacadeInterface
     */
    protected $erpInvoicePageSearchToEventBehaviorFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchToEventBehaviorFacadeMock = $this->getMockBuilder(ErpInvoicePageSearchToEventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchCommunicationFactory = new ErpInvoicePageSearchCommunicationFactory();
        $this->erpInvoicePageSearchCommunicationFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetEventBehaviorFacade()
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpInvoicePageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpInvoicePageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR)
            ->willReturn($this->erpInvoicePageSearchToEventBehaviorFacadeMock);

        $this->assertInstanceOf(
            ErpInvoicePageSearchToEventBehaviorFacadeInterface::class,
            $this->erpInvoicePageSearchCommunicationFactory->getEventBehaviorFacade(),
        );
    }
}
