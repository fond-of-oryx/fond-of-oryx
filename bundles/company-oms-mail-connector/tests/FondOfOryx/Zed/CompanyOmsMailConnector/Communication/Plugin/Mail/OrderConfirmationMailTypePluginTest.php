<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Communication\Plugin\Mail;

use Codeception\Test\Unit;
use Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilder;

class OrderConfirmationMailTypePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyOmsMailConnector\Communication\Plugin\Mail\OrderConfirmationMailTypePlugin
     */
    protected $orderConfirmationMailTypePlugin;

    /**
     * @var \Spryker\Zed\Mail\Business\Model\Mail\Builder\MailBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailBuilderMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->mailBuilderMock = $this->getMockBuilder(MailBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderConfirmationMailTypePlugin = new OrderConfirmationMailTypePlugin();
    }

    /**
     * @return void
     */
    public function testBuild(): void
    {
        $this->mailBuilderMock->expects(static::atLeastOnce())
            ->method('setSubject');

        $this->mailBuilderMock->expects(static::atLeastOnce())
            ->method('setHtmlTemplate');

        $this->mailBuilderMock->expects(static::atLeastOnce())
            ->method('setTextTemplate');

        $this->mailBuilderMock->expects(static::atLeastOnce())
            ->method('useDefaultSender');

        $this->orderConfirmationMailTypePlugin->build($this->mailBuilderMock);
    }
}
