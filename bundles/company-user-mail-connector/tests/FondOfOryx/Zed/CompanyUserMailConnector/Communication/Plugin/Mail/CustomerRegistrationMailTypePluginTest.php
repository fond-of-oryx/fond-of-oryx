<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Communication\Plugin\CompanyUsersRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserMailConnector\Communication\Plugin\Mail\CustomerRegistrationMailTypePlugin;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface;

class CustomerRegistrationMailTypePluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $customerTransferMock;

    /**
     * @var \Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $mailBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $mailTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Communication\Plugin\Mail\CustomerRegistrationMailTypePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->mailBuilderMock = $this->getMockBuilder(MailBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerRegistrationMailTypePlugin();
    }

    /**
     * @return void
     */
    public function testBuild(): void
    {
        $this->mailBuilderMock->expects(static::atLeastOnce())
            ->method('getMailTransfer')
            ->willReturn($this->mailTransferMock);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('requireCustomer')
            ->willReturnSelf();

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getEmail')
            ->willReturn('max.mustermann@example.com');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getFirstName')
            ->willReturn('Max');

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getLastName')
            ->willReturn('Mustermann');

        $this->plugin->build($this->mailBuilderMock);
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        static::assertEquals('customer registration mail', $this->plugin->getName());
    }
}
