<?php

namespace FondOfOryx\Zed\CompanyProductListApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListApi\Business\Model\CompanyProductListApiInterface;
use FondOfOryx\Zed\CompanyProductListApi\CompanyProductListApiDependencyProvider;
use FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToCompanyProductListConnectorFacadeInterface;
use FondOfOryx\Zed\CompanyProductListApi\Dependency\QueryContainer\CompanyProductListApiToApiQueryContainerInterface;
use Spryker\Zed\Kernel\Container;

class CompanyProductListApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToCompanyProductListConnectorFacadeInterface
     */
    protected $companyProductListApiToCompanyProductListConnectorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyProductListApi\Dependency\QueryContainer\CompanyProductListApiToApiQueryContainerInterface
     */
    protected $companyProductListApiToApiQueryContainerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListApi\Business\CompanyProductListApiBusinessFactory
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

        $this->companyProductListApiToCompanyProductListConnectorFacadeMock = $this
            ->getMockBuilder(CompanyProductListApiToCompanyProductListConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListApiToApiQueryContainerMock = $this
            ->getMockBuilder(CompanyProductListApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyProductListApiBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyProductListApi(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CompanyProductListApiDependencyProvider::FACADE_COMPANY_PRODUCT_LIST_CONNECTOR],
                [CompanyProductListApiDependencyProvider::QUERY_CONTAINER_API],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyProductListApiDependencyProvider::FACADE_COMPANY_PRODUCT_LIST_CONNECTOR],
                [CompanyProductListApiDependencyProvider::QUERY_CONTAINER_API],
            )->willReturnOnConsecutiveCalls(
                $this->companyProductListApiToCompanyProductListConnectorFacadeMock,
                $this->companyProductListApiToApiQueryContainerMock,
            );

        static::assertInstanceOf(
            CompanyProductListApiInterface::class,
            $this->businessFactory->createCompanyProductListApi(),
        );
    }
}
