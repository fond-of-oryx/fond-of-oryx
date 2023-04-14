<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\Mail;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistration\Communication\CustomerRegistrationCommunicationFactory;
use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfig;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeBridge;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\MailTransfer;

class CustomerRegistrationConfirmationMailjetMailTypeBuilderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Communication\CustomerRegistrationCommunicationFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $communicationFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\Mail\CustomerRegistrationConfirmationMailjetMailTypeBuilder
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

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(CustomerRegistrationConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->communicationFactoryMock = $this->getMockBuilder(CustomerRegistrationCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacadeMock = $this->getMockBuilder(CustomerRegistrationToLocaleFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerRegistrationConfirmationMailjetMailTypeBuilder();
        $this->plugin->setConfig($this->configMock);
        $this->plugin->setFactory($this->communicationFactoryMock);
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        static::assertEquals(
            'customer registration confirmation mail',
            $this->plugin->getName(),
        );
    }

    /**
     * @return void
     */
    public function testBuild(): void
    {
        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getConfirmationLink')
            ->willReturn('CONFIRMATION_LINK');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getEmail')
            ->willReturn('john.doe@fondof.de');

        $this->communicationFactoryMock->expects(static::atLeastOnce())
            ->method('getLocaleFacade')
            ->willReturn($this->localeFacadeMock);

        $this->localeFacadeMock->expects(static::atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($this->localeTransferMock);

        $this->localeTransferMock->expects(static::atLeastOnce())
            ->method('getLocaleName')
            ->willReturn('de_DE');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getCustomerRegistrationConfirmationMailTemplateIdByLocale')
            ->with('de_DE')
            ->willReturn(123456);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('setMailjetTemplate')
            ->willReturnSelf();

        static::assertEquals($this->mailTransferMock, $this->plugin->build($this->mailTransferMock));
        static::assertEquals($this->mailTransferMock->getCustomer()->getConfirmationLink(), 'CONFIRMATION_LINK');
    }
}
