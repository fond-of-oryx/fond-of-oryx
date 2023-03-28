<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Writer\CompanyUserWriterInterface;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiDependencyProvider;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence\BusinessOnBehalfRestApiRepository;
use Spryker\Zed\Kernel\Container;

class BusinessOnBehalfRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessOnBehalfFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container|mixed
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserFacadeMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence\BusinessOnBehalfRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\BusinessOnBehalfRestApiBusinessFactory
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

        $this->companyUserFacadeMock = $this->getMockBuilder(BusinessOnBehalfRestApiToCompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessOnBehalfFacadeMock = $this->getMockBuilder(BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(BusinessOnBehalfRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new BusinessOnBehalfRestApiBusinessFactory();
        $this->businessFactory->setRepository($this->repositoryMock);
        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserWriter(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [BusinessOnBehalfRestApiDependencyProvider::FACADE_COMPANY_USER],
                [BusinessOnBehalfRestApiDependencyProvider::FACADE_BUSINESS_ON_BEHALF],
            )
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [BusinessOnBehalfRestApiDependencyProvider::FACADE_COMPANY_USER],
                [BusinessOnBehalfRestApiDependencyProvider::FACADE_BUSINESS_ON_BEHALF],
            )
            ->willReturnOnConsecutiveCalls(
                $this->companyUserFacadeMock,
                $this->businessOnBehalfFacadeMock,
            );

        static::assertInstanceOf(
            CompanyUserWriterInterface::class,
            $this->businessFactory->createCompanyUserWriter(),
        );
    }
}
