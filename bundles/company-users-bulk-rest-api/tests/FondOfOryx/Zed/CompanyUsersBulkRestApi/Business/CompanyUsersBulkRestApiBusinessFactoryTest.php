<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Manager\BulkManagerInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\CompanyUsersBulkRestApiDependencyProvider;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToCompanyUserFacadeInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToEventFacadeInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;
use Spryker\Zed\Kernel\Container;

class CompanyUsersBulkRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected Container|MockObject $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToEventFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUsersBulkRestApiToEventFacadeInterface|MockObject $eventFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Dependency\Facade\CompanyUsersBulkRestApiToCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUsersBulkRestApiToCompanyUserFacadeInterface|MockObject $companyUserFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUsersBulkRestApiRepository|MockObject $repositoryMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected LoggerInterface|MockObject $loggerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\CompanyUsersBulkRestApiBusinessFactory
     */
    protected CompanyUsersBulkRestApiBusinessFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this
            ->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventFacadeMock = $this
            ->getMockBuilder(CompanyUsersBulkRestApiToEventFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserFacadeMock = $this
            ->getMockBuilder(CompanyUsersBulkRestApiToCompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this
            ->getMockBuilder(CompanyUsersBulkRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this
            ->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->loggerMock) extends CompanyUsersBulkRestApiBusinessFactory {
            /**
             * @var \Psr\Log\LoggerInterface
             */
            protected LoggerInterface $loggerMock;

            /**
             * @param \Psr\Log\LoggerInterface $logger
             */
            public function __construct(LoggerInterface $logger)
            {
                $this->loggerMock = $logger;
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
    public function testCreateBulkManager(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyUsersBulkRestApiDependencyProvider::FACADE_EVENT],
                [CompanyUsersBulkRestApiDependencyProvider::FACADE_COMPANY_USER],
                [CompanyUsersBulkRestApiDependencyProvider::PLUGINS_DATA_EXPANDER],
                [CompanyUsersBulkRestApiDependencyProvider::PLUGINS_PRE_HANDLING],
                [CompanyUsersBulkRestApiDependencyProvider::PLUGINS_POST_HANDLING],
            )
            ->willReturnOnConsecutiveCalls(
                $this->eventFacadeMock,
                $this->companyUserFacadeMock,
                [],
                [],
                [],
            );

        static::assertInstanceOf(
            BulkManagerInterface::class,
            $this->factory->createBulkManager(),
        );
    }
}
