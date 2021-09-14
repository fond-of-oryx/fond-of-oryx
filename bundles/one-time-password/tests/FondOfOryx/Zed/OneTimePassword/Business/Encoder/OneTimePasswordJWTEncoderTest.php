<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Encoder;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOauthFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OauthResponseTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class OneTimePasswordJWTEncoderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordJWTEncoder
     */
    protected $oneTimePasswordJWTEncoder;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOauthFacadeInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oauthFacadeMock;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordResponseTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $oneTimePasswordPlain;

    /**
     * @var \Generated\Shared\Transfer\OauthResponseTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oauthResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oauthFacadeMock = $this->getMockBuilder(OneTimePasswordToOauthFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->accessToken = 'access-token';

        $this->oneTimePasswordResponseTransferMock = $this->getMockBuilder(OneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->email = 'email';

        $this->oneTimePasswordPlain = 'one-time-password-plain';

        $this->oauthResponseTransferMock = $this->getMockBuilder(OauthResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordJWTEncoder = new OneTimePasswordJWTEncoder(
            $this->oauthFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testEncode(): void
    {
        $this->oneTimePasswordResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerTransfer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getEmail')
            ->willReturn($this->email);

        $this->oneTimePasswordResponseTransferMock->expects($this->atLeastOnce())
            ->method('getOneTimePasswordPlain')
            ->willReturn($this->oneTimePasswordPlain);

        $this->oauthFacadeMock->expects($this->atLeastOnce())
            ->method('processAccessTokenRequest')
            ->willReturn($this->oauthResponseTransferMock);

        $this->oauthResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsValid')
            ->willReturn(true);

        $this->oauthResponseTransferMock->expects($this->atLeastOnce())
            ->method('getAccessToken')
            ->willReturn($this->accessToken);

        $this->assertSame(
            $this->accessToken,
            $this->oneTimePasswordJWTEncoder->encode(
                $this->oneTimePasswordResponseTransferMock
            )
        );
    }
}
