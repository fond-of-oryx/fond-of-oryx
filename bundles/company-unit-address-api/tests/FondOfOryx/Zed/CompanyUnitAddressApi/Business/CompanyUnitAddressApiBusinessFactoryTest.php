<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\CompanyUnitAddressApi;
use FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\Validator\CompanyUnitAddressApiValidator;
use FondOfOryx\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiDependencyProvider;
use FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface;
use FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerInterface;
use FondOfOryx\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiRepository;
use Spryker\Zed\Kernel\Container;

class CompanyUnitAddressApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerInterface
     */
    protected $apiQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiRepository
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiBusinessFactory
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

        $this->apiQueryContainerMock = $this->getMockBuilder(CompanyUnitAddressApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyUnitAddressApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyUnitAddressApiBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressApi(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyUnitAddressApiDependencyProvider::QUERY_CONTAINER_API],
                [CompanyUnitAddressApiDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS],
            )->willReturnOnConsecutiveCalls(
                $this->apiQueryContainerMock,
                $this->companyUnitAddressFacadeMock,
            );

        static::assertInstanceOf(
            CompanyUnitAddressApi::class,
            $this->factory->createCompanyUnitAddressApi(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressApiValidator(): void
    {
        static::assertInstanceOf(
            CompanyUnitAddressApiValidator::class,
            $this->factory->createCompanyUnitAddressApiValidator(),
        );
    }
}
