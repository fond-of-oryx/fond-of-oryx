<?php

namespace FondOfOryx\Client\CustomerStatistic;

use Codeception\Test\Unit;
use FondOfOryx\Client\CustomerStatistic\Dependency\Client\CustomerStatisticToZedRequestClientInterface;
use FondOfOryx\Client\CustomerStatistic\Zed\CustomerStatisticZedStub;
use Spryker\Client\Kernel\Container;

class CustomerStatisticFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\CustomerStatistic\Dependency\Client\CustomerStatisticToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CustomerStatistic\CustomerStatisticFactory
     */
    protected $customerStatisticFactory;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(CustomerStatisticToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticFactory = new CustomerStatisticFactory();
        $this->customerStatisticFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCustomerStatisticZedStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(CustomerStatisticDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CustomerStatisticDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            CustomerStatisticZedStub::class,
            $this->customerStatisticFactory->createCustomerStatisticZedStub(),
        );
    }
}
