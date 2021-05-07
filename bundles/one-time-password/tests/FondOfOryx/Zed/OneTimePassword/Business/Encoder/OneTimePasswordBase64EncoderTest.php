<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Encoder;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class OneTimePasswordBase64EncoderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordBase64Encoder
     */
    protected $oneTimePasswordBase64Encoder;

    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
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
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordResponseTransferMock = $this->getMockBuilder(OneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->email = 'email';

        $this->oneTimePasswordPlain = 'one-time-password-plain';

        $this->oneTimePasswordBase64Encoder = new OneTimePasswordBase64Encoder();
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

        $this->assertIsString(
            $this->oneTimePasswordBase64Encoder->encode(
                $this->oneTimePasswordResponseTransferMock
            )
        );
    }
}
