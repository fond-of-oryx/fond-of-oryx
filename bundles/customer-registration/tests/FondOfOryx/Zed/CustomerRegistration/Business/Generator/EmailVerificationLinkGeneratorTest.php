<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Generator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfigInterface;
use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\EmailVerificationLinkExpanderPluginInterface;
use Generated\Shared\Transfer\CustomerTransfer;

class EmailVerificationLinkGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfigInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Generator\EmailVerificationLinkGeneratorInterface
     */
    protected $generator;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\EmailVerificationLinkExpanderPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $emailVerificationLinkExtenderPluginMock;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(CustomerRegistrationConfigInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->emailVerificationLinkExtenderPluginMock = $this->getMockBuilder(EmailVerificationLinkExpanderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->generator = new EmailVerificationLinkGenerator(
            $this->configMock,
            [$this->emailVerificationLinkExtenderPluginMock],
        );
    }

    /**
     * @return void
     */
    public function testGenerateLink(): void
    {
        $linkPattern = '';
        $baseUrl = '';

        $this->configMock
            ->expects(static::atLeastOnce())
            ->method('getVerificationLinkPattern')
            ->willReturn($linkPattern);

        $this->configMock
            ->expects(static::atLeastOnce())
            ->method('getBaseUrl')
            ->willReturn($baseUrl);

        $this->emailVerificationLinkExtenderPluginMock
            ->expects(static::atLeastOnce())
            ->method('expand')
            ->with($baseUrl, $this->customerTransferMock)
            ->willReturn($baseUrl);

        $this->generator->generateLink($this->customerTransferMock);
    }
}
