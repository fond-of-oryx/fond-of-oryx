<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Persister\CompanyBrandRelationPersister;
use FondOfOryx\Zed\CompanyBrandProductListConnector\CompanyBrandProductListConnectorDependencyProvider;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandCompanyFacadeInterface;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandProductListConnectorFacadeInterface;
use Spryker\Zed\Kernel\Container;

class CompanyBrandProductListConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandProductListConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandProductListConnectorFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandCompanyFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandCompanyFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Business\CompanyBrandProductListConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandProductListConnectorFacadeMock = $this->getMockBuilder(
            CompanyBrandProductListConnectorToBrandProductListConnectorFacadeInterface::class,
        )->disableOriginalConstructor()->getMock();

        $this->brandCompanyFacadeMock = $this->getMockBuilder(
            CompanyBrandProductListConnectorToBrandCompanyFacadeInterface::class,
        )->disableOriginalConstructor()->getMock();

        $this->factory = new CompanyBrandProductListConnectorBusinessFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyBrandRelationPersister(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CompanyBrandProductListConnectorDependencyProvider::FACADE_BRAND_PRODUCT_LIST_CONNECTOR],
                [CompanyBrandProductListConnectorDependencyProvider::FACADE_BRAND_COMPANY],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyBrandProductListConnectorDependencyProvider::FACADE_BRAND_PRODUCT_LIST_CONNECTOR],
                [CompanyBrandProductListConnectorDependencyProvider::FACADE_BRAND_COMPANY],
            )->willReturnOnConsecutiveCalls(
                $this->brandProductListConnectorFacadeMock,
                $this->brandCompanyFacadeMock,
            );

        static::assertInstanceOf(
            CompanyBrandRelationPersister::class,
            $this->factory->createCompanyBrandRelationPersister(),
        );
    }
}
