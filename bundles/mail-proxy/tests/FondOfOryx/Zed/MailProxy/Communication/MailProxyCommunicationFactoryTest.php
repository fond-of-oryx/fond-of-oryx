<?php

namespace FondOfOryx\Zed\MailProxy\Communication;

use Codeception\Test\Unit;
use FondOfOryx\Zed\MailProxy\MailProxyDependencyProvider;
use FondOfOryx\Zed\MailProxyExtension\Dependency\Plugin\MailExpanderPluginInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class MailProxyCommunicationFactoryTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\MailProxyExtension\Dependency\Plugin\MailExpanderPluginInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MailExpanderPluginInterface|MockObject $mailExpanderPluginMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected Container|MockObject $containerMock;

    /**
     * @var \FondOfOryx\Zed\MailProxy\Communication\MailProxyCommunicationFactory
     */
    protected MailProxyCommunicationFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->mailExpanderPluginMock = $this->getMockBuilder(MailExpanderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new MailProxyCommunicationFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetMailExpanderPlugins(): void
    {
        $mailExpanderPlugins = [
            $this->mailExpanderPluginMock,
        ];

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(MailProxyDependencyProvider::PLUGINS_MAIL_EXPANDER)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(MailProxyDependencyProvider::PLUGINS_MAIL_EXPANDER)
            ->willReturn($mailExpanderPlugins);

        static::assertEquals(
            $mailExpanderPlugins,
            $this->factory->getMailExpanderPlugins(),
        );
    }
}
