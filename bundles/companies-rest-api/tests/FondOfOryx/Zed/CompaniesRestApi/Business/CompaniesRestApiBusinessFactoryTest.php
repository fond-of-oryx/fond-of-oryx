<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompaniesRestApi\Business\Deleter\CompanyDeleter;
use FondOfOryx\Zed\CompaniesRestApi\CompaniesRestApiDependencyProvider;
use FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeInterface;
use FondOfOryx\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepository;
use Spryker\Zed\Kernel\Container;

class CompaniesRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyDeleterFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompaniesRestApi\Business\CompaniesRestApiBusinessFactory
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

        $this->repositoryMock = $this->getMockBuilder(CompaniesRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyDeleterFacadeMock = $this->getMockBuilder(CompaniesRestApiToCompanyDeleterFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompaniesRestApiBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyDeleter(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompaniesRestApiDependencyProvider::FACADE_COMPANY_DELETER],
            )->willReturnOnConsecutiveCalls(
                $this->companyDeleterFacadeMock,
            );

        static::assertInstanceOf(
            CompanyDeleter::class,
            $this->factory->createCompanyDeleter(),
        );
    }
}
