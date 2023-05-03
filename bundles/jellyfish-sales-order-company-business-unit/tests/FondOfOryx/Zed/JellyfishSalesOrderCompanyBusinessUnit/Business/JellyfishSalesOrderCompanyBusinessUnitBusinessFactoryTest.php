<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Business\Expander\JellyfishOrderExpander;
use FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Dependency\Facade\JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\JellyfishSalesOrderCompanyBusinessUnitDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishSalesOrderCompanyBusinessUnitBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Dependency\Facade\JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserReferenceFacadeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Business\JellyfishSalesOrderCompanyBusinessUnitBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceFacadeMock = $this->getMockBuilder(
            JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeInterface::class,
        )->disableOriginalConstructor()->getMock();

        $this->factory = new JellyfishSalesOrderCompanyBusinessUnitBusinessFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateJellyfishOrderExpander(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [JellyfishSalesOrderCompanyBusinessUnitDependencyProvider::FACADE_COMPANY_USER_REFERENCE],
            )->willReturnOnConsecutiveCalls(
                $this->companyUserReferenceFacadeMock,
            );

        static::assertInstanceOf(
            JellyfishOrderExpander::class,
            $this->factory->createJellyfishOrderExpander(),
        );
    }
}
