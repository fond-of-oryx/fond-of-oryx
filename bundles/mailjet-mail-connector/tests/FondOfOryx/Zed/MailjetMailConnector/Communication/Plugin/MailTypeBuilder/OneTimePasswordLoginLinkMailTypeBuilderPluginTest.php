<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Communication\Plugin\MailTypeBuilder;

use Codeception\Test\Unit;
use FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesCustomerMapper;
use FondOfOryx\Zed\MailjetMailConnector\Communication\MailjetMailConnectorCommunicationFactory;
use FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\MailTransfer;

class OneTimePasswordLoginLinkMailTypeBuilderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Communication\MailjetMailConnectorCommunicationFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesCustomerMapper|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailjetTemplateVariablesCustomerMapperMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Communication\Plugin\MailTypeBuilder\OneTimePasswordLoginLinkMailTypeBuilderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(MailjetMailConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(MailjetMailConnectorCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailjetTemplateVariablesCustomerMapperMock = $this->getMockBuilder(MailjetTemplateVariablesCustomerMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new OneTimePasswordLoginLinkMailTypeBuilderPlugin();
        $this->plugin->setConfig($this->configMock);
        $this->plugin->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testBuild(): void
    {
        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->localeTransferMock->expects(static::atLeastOnce())
            ->method('getLocaleName')
            ->willReturn('de_DE');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getOneTimePasswordLoginLinkMailTemplateIdByLocale')
            ->with('de_DE')
            ->willReturn(99);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('setMailjetTemplate')
            ->willReturnSelf();

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getOneTimePasswordLoginLink')
            ->willReturn('https://example.link');

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $response = $this->plugin->build($this->mailTransferMock);
    }
}
