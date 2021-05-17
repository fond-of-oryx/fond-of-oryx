<?php

namespace FondOfOryx\Zed\OneTimePassword\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordLinkGeneratorInterface;
use FondOfOryx\Zed\OneTimePassword\Business\Resetter\OneTimePasswordResetterInterface;
use FondOfOryx\Zed\OneTimePassword\Business\Sender\OneTimePasswordSenderInterface;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordDependencyProvider;
use FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManager;
use Spryker\Zed\Kernel\Container;

class OneTimePasswordBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordBusinessFactory
     */
    protected $oneTimePasswordBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordEmailConnectorFacadeMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordEntityManagerMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordConfigMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordEmailConnectorFacadeMock = $this->getMockBuilder(OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordEntityManagerMock = $this->getMockBuilder(OneTimePasswordEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordConfigMock = $this->getMockBuilder(OneTimePasswordConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordBusinessFactory = new OneTimePasswordBusinessFactory();
        $this->oneTimePasswordBusinessFactory->setEntityManager($this->oneTimePasswordEntityManagerMock);
        $this->oneTimePasswordBusinessFactory->setConfig($this->oneTimePasswordConfigMock);
        $this->oneTimePasswordBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateOneTimePasswordSender(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(OneTimePasswordDependencyProvider::FACADE_ONE_TIME_PASSWORD_EMAIL_CONNECTOR)
            ->willReturn($this->oneTimePasswordEmailConnectorFacadeMock);

        $this->assertInstanceOf(
            OneTimePasswordSenderInterface::class,
            $this->oneTimePasswordBusinessFactory->createOneTimePasswordSender()
        );
    }

    /**
     * @return void
     */
    public function testCreateOneTimePasswordResetter(): void
    {
        $this->assertInstanceOf(
            OneTimePasswordResetterInterface::class,
            $this->oneTimePasswordBusinessFactory->createOneTimePasswordResetter()
        );
    }

    /**
     * @return void
     */
    public function testCreateOneTimePasswordLinkGenerator(): void
    {
        $this->assertInstanceOf(
            OneTimePasswordLinkGeneratorInterface::class,
            $this->oneTimePasswordBusinessFactory->createOneTimePasswordLinkGenerator()
        );
    }
}
