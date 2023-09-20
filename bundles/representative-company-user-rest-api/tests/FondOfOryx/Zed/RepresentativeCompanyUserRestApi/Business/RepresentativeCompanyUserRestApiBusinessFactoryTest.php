<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\RepresentationManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence\RepresentativeCompanyUserRestApiRepository;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiDependencyProvider;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;
use Spryker\Zed\Kernel\Container;

class RepresentativeCompanyUserRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected Container|MockObject $containerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface|MockObject $facadeMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence\RepresentativeCompanyUserRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RepresentativeCompanyUserRestApiRepository|MockObject $repositoryMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected LoggerInterface|MockObject $loggerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\RepresentativeCompanyUserRestApiBusinessFactory
     */
    protected RepresentativeCompanyUserRestApiBusinessFactory|MockObject $factory;

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

        $this->loggerMock = $this
            ->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->loggerMock) extends RepresentativeCompanyUserRestApiBusinessFactory {
            /**
             * @var \Psr\Log\LoggerInterface
             */
            protected LoggerInterface $loggerMock;

            /**
             * @param \Psr\Log\LoggerInterface $loggerMock
             */
            public function __construct(LoggerInterface $loggerMock)
            {
                $this->loggerMock = $loggerMock;
            }

            /**
             * @param \Spryker\Shared\Log\Config\LoggerConfigInterface|null $loggerConfig
             *
             * @return \Psr\Log\LoggerInterface
             */
            public function getLogger(?LoggerConfigInterface $loggerConfig = null): LoggerInterface
            {
                return $this->loggerMock;
            }
        };
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
