<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Writer\CompanyUserWriter;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiDependencyProvider;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence\BusinessOnBehalfRestApiRepository;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence\BusinessOnBehalfRestApiRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class BusinessOnBehalfRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface $businessOnBehalfFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected MockObject|Container $containerMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfRestApiToCompanyUserFacadeInterface|MockObject $companyUserFacadeMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence\BusinessOnBehalfRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|BusinessOnBehalfRestApiRepositoryInterface $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\BusinessOnBehalfRestApiBusinessFactory
     */
    protected BusinessOnBehalfRestApiBusinessFactory $businessFactory;

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
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case BusinessOnBehalfRestApiDependencyProvider::FACADE_COMPANY_USER:
                        return $self->companyUserFacadeMock;
                    case BusinessOnBehalfRestApiDependencyProvider::FACADE_BUSINESS_ON_BEHALF:
                        return $self->businessOnBehalfFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            CompanyUserWriter::class,
            $this->businessFactory->createCompanyUserWriter(),
        );
    }
}
