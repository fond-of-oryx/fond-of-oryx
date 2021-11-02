<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\DeliveryDateRestriction\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\DeliveryDateRestriction\Business\Validator\QuoteValidator;
use FondOfOryx\Zed\DeliveryDateRestriction\DeliveryDateRestrictionDependencyProvider;
use FondOfOryx\Zed\DeliveryDateRestriction\Dependency\Facade\DeliveryDateRestrictionToPermissionFacadeInterface;
use Spryker\Zed\Kernel\Container;

class DeliveryDateRestrictionBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Dependency\Facade\DeliveryDateRestrictionToPermissionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $permissionFacadeMock;

    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Business\DeliveryDateRestrictionBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionFacadeMock = $this->getMockBuilder(DeliveryDateRestrictionToPermissionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new DeliveryDateRestrictionBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateQuoteExpander(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(DeliveryDateRestrictionDependencyProvider::FACADE_PERMISSION)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(DeliveryDateRestrictionDependencyProvider::FACADE_PERMISSION)
            ->willReturn($this->permissionFacadeMock);

        static::assertInstanceOf(
            QuoteExpander::class,
            $this->businessFactory->createQuoteExpander(),
        );
    }

    /**
     * @return void
     */
    public function testCreateQuoteValidator(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(DeliveryDateRestrictionDependencyProvider::FACADE_PERMISSION)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(DeliveryDateRestrictionDependencyProvider::FACADE_PERMISSION)
            ->willReturn($this->permissionFacadeMock);

        static::assertInstanceOf(
            QuoteValidator::class,
            $this->businessFactory->createQuoteValidator(),
        );
    }
}
