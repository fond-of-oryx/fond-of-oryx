<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyRoleApi\Business\Model\CompanyRoleApi;
use FondOfOryx\Zed\CompanyRoleApi\CompanyRoleApiConfig;
use FondOfOryx\Zed\CompanyRoleApi\CompanyRoleApiDependencyProvider;
use FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToCompanyRoleFacadeInterface;
use FondOfOryx\Zed\CompanyRoleApi\Dependency\QueryContainer\CompanyRoleApiToApiQueryContainerInterface;
use FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiQueryContainer;
use FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiRepository;
use Spryker\Zed\Kernel\Container;

class CompanyRoleApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyRoleApi\CompanyRoleApiConfig
     */
    protected $companyRoleApiConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiQueryContainer
     */
    protected $queryContainerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyRoleApi\Business\CompanyRoleApiBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyRoleApiConfigMock = $this->getMockBuilder(CompanyRoleApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryContainerMock = $this->getMockBuilder(CompanyRoleApiQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyRoleApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyRoleApiBusinessFactory();

        $this->businessFactory->setConfig($this->companyRoleApiConfigMock);
        $this->businessFactory->setQueryContainer($this->queryContainerMock);
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyRoleApi(): void
    {
        $apiQueryContainerMock = $this->getMockBuilder(CompanyRoleApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $apiToCompanyFacadeMock = $this->getMockBuilder(CompanyRoleApiToCompanyRoleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CompanyRoleApiDependencyProvider::QUERY_CONTAINER_API],
                [CompanyRoleApiDependencyProvider::FACADE_COMPANY_ROLE],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyRoleApiDependencyProvider::QUERY_CONTAINER_API],
                [CompanyRoleApiDependencyProvider::FACADE_COMPANY_ROLE],
            )
            ->willReturnOnConsecutiveCalls(
                $apiQueryContainerMock,
                $apiToCompanyFacadeMock,
            );

        static::assertInstanceOf(CompanyRoleApi::class, $this->businessFactory->createCompanyRoleApi());
    }
}
