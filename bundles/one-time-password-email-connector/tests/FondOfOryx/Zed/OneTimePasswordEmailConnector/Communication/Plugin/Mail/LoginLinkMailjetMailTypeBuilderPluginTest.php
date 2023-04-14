<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\Plugin\Mail;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\OneTimePasswordEmailConnectorCommunicationFactory;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\Dependency\Facade\OneTimePasswordEmailConnectorToLocaleFacadeBridge;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\OneTimePasswordEmailConnectorConfig;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\MailTransfer;

class LoginLinkMailjetMailTypeBuilderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\OneTimePasswordEmailConnectorCommunicationFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\OneTimePasswordEmailConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\Dependency\Facade\OneTimePasswordEmailConnectorToLocaleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\Plugin\Mail\LoginLinkMailjetMailTypeBuilderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(OneTimePasswordEmailConnectorCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(OneTimePasswordEmailConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacadeMock = $this->getMockBuilder(OneTimePasswordEmailConnectorToLocaleFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new LoginLinkMailjetMailTypeBuilderPlugin();
        $this->plugin->setConfig($this->configMock);
        $this->plugin->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testBuild(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getLocaleFacade')
            ->willReturn($this->localeFacadeMock);

        $this->localeFacadeMock->expects(static::atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($this->localeTransferMock);

        $this->localeTransferMock->expects(static::atLeastOnce())
            ->method('getLocaleName')
            ->willReturn('de_DE');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getOneTimePasswordLoginLinkMailTemplateIdByLocale')
            ->with('de_DE')
            ->willReturn(1000);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerOrFail')
            ->willReturn($this->customerTransferMock);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getOneTimePasswordLoginLink')
            ->willReturn('oneTimePasswordLoginLink');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getFirstName')
            ->willReturn('John');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getLastName')
            ->willReturn('Doe');

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('setMailjetTemplate')
            ->willReturnSelf();

        $this->plugin->build($this->mailTransferMock);
    }
}
