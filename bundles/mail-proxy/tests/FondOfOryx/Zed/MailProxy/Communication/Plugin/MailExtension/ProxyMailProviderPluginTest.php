<?php

namespace FondOfOryx\Zed\MailProxy\Communication\Plugin\MailExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\MailProxy\Communication\MailProxyCommunicationFactory;
use FondOfOryx\Zed\MailProxyExtension\Dependency\Plugin\MailExpanderPluginInterface;
use Generated\Shared\Transfer\MailTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface;

class ProxyMailProviderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected MockObject|MailProviderPluginInterface $mailProviderPluginMock;

    /**
     * @var (\FondOfOryx\Zed\MailProxy\Communication\MailProxyCommunicationFactory&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|MailProxyCommunicationFactory $factoryMock;

    /**
     * @var (\FondOfOryx\Zed\MailProxyExtension\Dependency\Plugin\MailExpanderPluginInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MailExpanderPluginInterface|MockObject $mailExpanderPluginMock;

    /**
     * @var (\Generated\Shared\Transfer\MailTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|MailTransfer $mailTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailProxy\Communication\Plugin\MailExtension\ProxyMailProviderPlugin
     */
    protected ProxyMailProviderPlugin $proxyMailProviderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->mailProviderPluginMock = $this->getMockBuilder(MailProviderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(MailProxyCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailExpanderPluginMock = $this->getMockBuilder(MailExpanderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->proxyMailProviderPlugin = new ProxyMailProviderPlugin(
            $this->mailProviderPluginMock,
        );

        $this->proxyMailProviderPlugin->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testSendMail(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getMailExpanderPlugins')
            ->willReturn(
                [
                    $this->mailExpanderPluginMock,
                ],
            );

        $this->mailExpanderPluginMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->mailTransferMock)
            ->willReturn($this->mailTransferMock);

        $this->mailProviderPluginMock->expects(static::atLeastOnce())
            ->method('sendMail')
            ->with($this->mailTransferMock);

        $this->proxyMailProviderPlugin->sendMail($this->mailTransferMock);
    }
}
