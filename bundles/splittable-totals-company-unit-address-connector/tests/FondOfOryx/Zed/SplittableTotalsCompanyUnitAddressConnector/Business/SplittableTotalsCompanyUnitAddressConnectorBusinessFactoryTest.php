<?php

namespace FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Persistence\SplittableTotalsCompanyUnitAddressConnectorRepository;
use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\SplittableTotalsCompanyUnitAddressConnectorDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableTotalsCompanyUnitAddressConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Persistence\SplittableTotalsCompanyUnitAddressConnectorRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\SplittableTotalsCompanyUnitAddressConnectorBusinessFactory
     */
    protected $businessFactory;

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

        $this->repositoryMock = $this->getMockBuilder(SplittableTotalsCompanyUnitAddressConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(SplittableTotalsCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new SplittableTotalsCompanyUnitAddressConnectorBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateQuoteExpander(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(SplittableTotalsCompanyUnitAddressConnectorDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS)
            ->willReturn($this->companyUnitAddressFacadeMock);

        static::assertInstanceOf(
            QuoteExpander::class,
            $this->businessFactory->createQuoteExpander()
        );
    }
}
