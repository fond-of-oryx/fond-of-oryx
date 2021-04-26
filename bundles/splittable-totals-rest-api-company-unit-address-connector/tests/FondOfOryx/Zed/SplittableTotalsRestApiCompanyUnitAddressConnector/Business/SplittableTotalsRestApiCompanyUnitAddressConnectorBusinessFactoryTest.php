<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence\SplittableTotalsRestApiCompanyUnitAddressConnectorRepository;
use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\SplittableTotalsRestApiCompanyUnitAddressConnectorDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableTotalsRestApiCompanyUnitAddressConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence\SplittableTotalsRestApiCompanyUnitAddressConnectorRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\SplittableTotalsRestApiCompanyUnitAddressConnectorBusinessFactory
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

        $this->repositoryMock = $this->getMockBuilder(SplittableTotalsRestApiCompanyUnitAddressConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new SplittableTotalsRestApiCompanyUnitAddressConnectorBusinessFactory();
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
            ->with(SplittableTotalsRestApiCompanyUnitAddressConnectorDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS)
            ->willReturn($this->companyUnitAddressFacadeMock);

        static::assertInstanceOf(
            QuoteExpander::class,
            $this->businessFactory->createQuoteExpander()
        );
    }
}
