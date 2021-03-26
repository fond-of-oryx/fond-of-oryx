<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToEventBehaviorFacadeInterface;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductLocaleRestrictionStorageCommunicationFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToEventBehaviorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $eventBehaviorFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\ProductLocaleRestrictionStorageCommunicationFactory
     */
    protected $productLocaleRestrictionStorageCommunicationFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventBehaviorFacadeMock = $this->getMockBuilder(ProductLocaleRestrictionStorageToEventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionStorageCommunicationFactory = new ProductLocaleRestrictionStorageCommunicationFactory();
        $this->productLocaleRestrictionStorageCommunicationFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetEventBehaviorFacade(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ProductLocaleRestrictionStorageDependencyProvider::FACADE_EVENT_BEHAVIOR)
            ->willReturn($this->eventBehaviorFacadeMock);

        static::assertEquals(
            $this->eventBehaviorFacadeMock,
            $this->productLocaleRestrictionStorageCommunicationFactory->getEventBehaviorFacade()
        );
    }
}
