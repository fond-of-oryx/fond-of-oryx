<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\CompanyUserCreationNotificationMailHandler;
use FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\MailHandler;
use FondOfOryx\Zed\CompanyUserMailConnector\CompanyUserMailConnectorConfig;
use FondOfOryx\Zed\CompanyUserMailConnector\CompanyUserMailConnectorDependencyProvider;
use FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToLocaleFacadeInterface;
use FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface;
use FondOfOryx\Zed\CompanyUserMailConnector\Persistence\CompanyUserMailConnectorRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class CompanyUserMailConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected Container|MockObject $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Business\CompanyUserMailConnectorBusinessFactory
     */
    protected CompanyUserMailConnectorBusinessFactory $factory;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserMailConnectorToMailFacadeInterface|MockObject $mailFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\CompanyUserMailConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserMailConnectorConfig|MockObject $configMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Persistence\CompanyUserMailConnectorRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserMailConnectorRepository|MockObject $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToLocaleFacadeInterface
     */
    protected MockObject|CompanyUserMailConnectorToLocaleFacadeInterface $localeFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacadeMock = $this->getMockBuilder(CompanyUserMailConnectorToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailFacadeMock = $this->getMockBuilder(CompanyUserMailConnectorToMailFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(CompanyUserMailConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyUserMailConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyUserMailConnectorBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateMailHandler(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CompanyUserMailConnectorDependencyProvider::FACADE_LOCALE],
                [CompanyUserMailConnectorDependencyProvider::FACADE_MAIL],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyUserMailConnectorDependencyProvider::FACADE_LOCALE],
                [CompanyUserMailConnectorDependencyProvider::FACADE_MAIL],
            )->willReturnOnConsecutiveCalls(
                $this->localeFacadeMock,
                $this->mailFacadeMock,
            );

        static::assertInstanceOf(
            MailHandler::class,
            $this->factory->createMailHandler(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserCreationNotificationMailHandler(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CompanyUserMailConnectorDependencyProvider::FACADE_LOCALE],
                [CompanyUserMailConnectorDependencyProvider::FACADE_MAIL],
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyUserMailConnectorDependencyProvider::FACADE_LOCALE],
                [CompanyUserMailConnectorDependencyProvider::FACADE_MAIL],
            )->willReturnOnConsecutiveCalls(
                $this->localeFacadeMock,
                $this->mailFacadeMock,
            );

        static::assertInstanceOf(
            CompanyUserCreationNotificationMailHandler::class,
            $this->factory->createCompanyUserCreationNotificationMailHandler(),
        );
    }
}
