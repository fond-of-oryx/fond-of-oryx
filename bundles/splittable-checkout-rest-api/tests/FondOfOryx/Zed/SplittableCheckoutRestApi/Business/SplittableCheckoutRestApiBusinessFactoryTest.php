<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Processor\PlaceOrderProcessor;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\SplittableTotalsReader;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableTotalsFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\SplittableCheckoutRestApiDependencyProvider;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class SplittableCheckoutRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected Container|MockObject $containerMock;

    /**
     * @var (\FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|SplittableCheckoutRestApiToCartFacadeInterface $cartFacadeMock;

    /**
     * @var (\FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|SplittableCheckoutRestApiToQuoteFacadeInterface $quoteFacadeMock;

    /**
     * @var (\FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface|MockObject $splittableCheckoutFacadeMock;

    /**
     * @var (\FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableTotalsFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|SplittableCheckoutRestApiToSplittableTotalsFacadeInterface $splittableTotalsFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckoutRestApiBusinessFactory
     */
    protected SplittableCheckoutRestApiBusinessFactory $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartFacadeMock = $this->getMockBuilder(SplittableCheckoutRestApiToCartFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteFacadeMock = $this->getMockBuilder(SplittableCheckoutRestApiToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutFacadeMock = $this->getMockBuilder(SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsFacadeMock = $this->getMockBuilder(SplittableCheckoutRestApiToSplittableTotalsFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new SplittableCheckoutRestApiBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreatePlaceOrderProcessor(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case SplittableCheckoutRestApiDependencyProvider::PLUGINS_QUOTE_EXPANDER:
                        return [];
                    case SplittableCheckoutRestApiDependencyProvider::FACADE_CART:
                        return $self->cartFacadeMock;
                    case SplittableCheckoutRestApiDependencyProvider::FACADE_QUOTE:
                        return $self->quoteFacadeMock;
                    case SplittableCheckoutRestApiDependencyProvider::FACADE_SPLITTABLE_CHECKOUT:
                        return $self->splittableCheckoutFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            PlaceOrderProcessor::class,
            $this->businessFactory->createPlaceOrderProcessor(),
        );
    }

    /**
     * @return void
     */
    public function testCreateSplittableTotalsReader(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case SplittableCheckoutRestApiDependencyProvider::PLUGINS_QUOTE_EXPANDER:
                        return [];
                    case SplittableCheckoutRestApiDependencyProvider::FACADE_CART:
                        return $self->cartFacadeMock;
                    case SplittableCheckoutRestApiDependencyProvider::FACADE_QUOTE:
                        return $self->quoteFacadeMock;
                    case SplittableCheckoutRestApiDependencyProvider::FACADE_SPLITTABLE_TOTALS:
                        return $self->splittableTotalsFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            SplittableTotalsReader::class,
            $this->businessFactory->createSplittableTotalsReader(),
        );
    }
}
