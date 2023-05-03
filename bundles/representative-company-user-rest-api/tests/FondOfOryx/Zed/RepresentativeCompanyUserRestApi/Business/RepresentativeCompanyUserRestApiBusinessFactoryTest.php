<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\RepresentationManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence\RepresentativeCompanyUserRestApiRepository;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiDependencyProvider;
use Spryker\Zed\Kernel\Container;

class RepresentativeCompanyUserRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence\RepresentativeCompanyUserRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\RepresentativeCompanyUserRestApiBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this
            ->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this
            ->getMockBuilder(RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this
            ->getMockBuilder(RepresentativeCompanyUserRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new RepresentativeCompanyUserRestApiBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateRepresentationManager(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(RepresentativeCompanyUserRestApiDependencyProvider::FACADE_REPRESENTATIVE_COMPANY_USER)
            ->willReturn($this->facadeMock);

        static::assertInstanceOf(
            RepresentationManagerInterface::class,
            $this->factory->createRepresentationManager(),
        );
    }
}
