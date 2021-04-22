<?php

namespace FondOfOryx\Zed\OneTimePassword\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacade;
use Generated\Shared\Transfer\OauthResponseTransfer;

class ResetOneTimePasswordPostAuthPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Communication\Plugin\ResetOneTimePasswordPostAuthPlugin
     */
    protected $resetOneTimePasswordPostAuthPlugin;

    /**
     * @var \Generated\Shared\Transfer\OauthResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oauthResponseTransferMock;

    /**
     * @var string
     */
    protected $customerReference;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oauthResponseTransferMock = $this->getMockBuilder(OauthResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerReference = 'customer-reference';

        $this->oneTimePasswordFacadeMock = $this->getMockBuilder(OneTimePasswordFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resetOneTimePasswordPostAuthPlugin = new ResetOneTimePasswordPostAuthPlugin();
        $this->resetOneTimePasswordPostAuthPlugin->setFacade($this->oneTimePasswordFacadeMock);
    }

    /**
     * @return void
     */
    public function testPostAuth(): void
    {
        $this->oauthResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($this->customerReference);

        $this->oneTimePasswordFacadeMock->expects($this->atLeastOnce())
            ->method('resetOneTimePassword');

        $this->resetOneTimePasswordPostAuthPlugin->postAuth($this->oauthResponseTransferMock);
    }
}
