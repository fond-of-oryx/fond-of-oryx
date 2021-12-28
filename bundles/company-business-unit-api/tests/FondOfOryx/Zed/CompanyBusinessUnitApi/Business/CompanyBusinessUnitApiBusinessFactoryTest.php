<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiBusinessFactory;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\CompanyBusinessUnitApi;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidator;
use FondOfOryx\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig;
use FondOfOryx\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiDependencyProvider;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryContainerInterface;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiRepository;
use Spryker\Zed\Kernel\Container;

class CompanyBusinessUnitApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig
     */
    protected $companyBusinessUnitApiConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiQueryContainerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitApiConfigMock = $this->getMockBuilder(CompanyBusinessUnitApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyBusinessUnitApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryContainerMock = $this->getMockBuilder(CompanyBusinessUnitApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitFacadeMock = $this->getMockBuilder(CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyBusinessUnitApiBusinessFactory();

        $this->businessFactory->setConfig($this->companyBusinessUnitApiConfigMock);
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyBusinessUnitApi(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CompanyBusinessUnitApiDependencyProvider::QUERY_CONTAINER_API],
                [CompanyBusinessUnitApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyBusinessUnitApiDependencyProvider::QUERY_CONTAINER_API],
                [CompanyBusinessUnitApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT],
            )
            ->willReturnOnConsecutiveCalls(
                $this->apiQueryContainerMock,
                $this->companyBusinessUnitFacadeMock,
            );

        static::assertInstanceOf(
            CompanyBusinessUnitApi::class,
            $this->businessFactory->createCompanyBusinessUnitApi(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyBusinessUnitApiValidator(): void
    {
        static::assertInstanceOf(
            CompanyBusinessUnitApiValidator::class,
            $this->businessFactory->createCompanyBusinessUnitApiValidator(),
        );
    }
}
