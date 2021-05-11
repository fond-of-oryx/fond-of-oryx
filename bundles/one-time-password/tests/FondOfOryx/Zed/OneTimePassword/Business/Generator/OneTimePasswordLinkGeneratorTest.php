<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class OneTimePasswordLinkGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordLinkGenerator
     */
    protected $oneTimePasswordLinkGenerator;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordGeneratorMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordConfigMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordResponseTransferMock;

    /**
     * @var string
     */
    protected $encodedLoginCredentials;

    /**
     * @var string
     */
    protected $loginLinkPath;

    /**
     * @var string
     */
    protected $loginLinkParameterName;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordEncoderMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var string
     */
    protected $loginLinkOrderReferenceName;

    /**
     * @var string
     */
    protected $orderReference;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordGeneratorMock = $this->getMockBuilder(OneTimePasswordGeneratorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordConfigMock = $this->getMockBuilder(OneTimePasswordConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordResponseTransferMock = $this->getMockBuilder(OneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->encodedLoginCredentials = 'encoded-login-credentials';

        $this->loginLinkPath = 'auto-login-path';

        $this->loginLinkParameterName = 'auto-login-parameter-name';

        $this->oneTimePasswordEncoderMock = $this->getMockBuilder(OneTimePasswordEncoderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loginLinkOrderReferenceName = 'auto-login-order-reference-name';

        $this->orderReference = 'order-reference';

        $this->oneTimePasswordLinkGenerator = new OneTimePasswordLinkGenerator(
            $this->oneTimePasswordGeneratorMock,
            $this->oneTimePasswordEncoderMock,
            $this->oneTimePasswordConfigMock
        );
    }

    /**
     * @return void
     */
    public function testGenerateLoginLink(): void
    {
        $this->oneTimePasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('generateOneTimePassword')
            ->with($this->customerTransferMock)
            ->willReturn($this->oneTimePasswordResponseTransferMock);

        $this->oneTimePasswordResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $this->oneTimePasswordEncoderMock->expects($this->atLeastOnce())
            ->method('encode')
            ->with($this->oneTimePasswordResponseTransferMock)
            ->willReturn($this->encodedLoginCredentials);

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getLoginLinkPath')
            ->willReturn($this->loginLinkPath);

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getLoginLinkParameterName')
            ->willReturn($this->loginLinkParameterName);

        $this->assertIsString(
            $this->oneTimePasswordLinkGenerator->generateLoginLink(
                $this->customerTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGenerateLoginLinkNull(): void
    {
        $this->oneTimePasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('generateOneTimePassword')
            ->with($this->customerTransferMock)
            ->willReturn($this->oneTimePasswordResponseTransferMock);

        $this->oneTimePasswordResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(false);

        $this->assertNull(
            $this->oneTimePasswordLinkGenerator->generateLoginLink(
                $this->customerTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGenerateLoginLinkWithOrderReference(): void
    {
        $this->orderTransferMock->expects($this->atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->oneTimePasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('generateOneTimePassword')
            ->with($this->customerTransferMock)
            ->willReturn($this->oneTimePasswordResponseTransferMock);

        $this->oneTimePasswordResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $this->oneTimePasswordEncoderMock->expects($this->atLeastOnce())
            ->method('encode')
            ->with($this->oneTimePasswordResponseTransferMock)
            ->willReturn($this->encodedLoginCredentials);

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getLoginLinkPath')
            ->willReturn($this->loginLinkPath);

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getLoginLinkParameterName')
            ->willReturn($this->loginLinkParameterName);

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getLoginLinkOrderReferenceName')
            ->willReturn($this->loginLinkOrderReferenceName);

        $this->orderTransferMock->expects($this->atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($this->orderReference);

        $this->assertIsString(
            $this->oneTimePasswordLinkGenerator->generateLoginLinkWithOrderReference(
                $this->orderTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGenerateLoginLinkWithOrderReferenceCustomerNull(): void
    {
        $this->orderTransferMock->expects($this->atLeastOnce())
            ->method('getCustomer')
            ->willReturn(null);

        $this->assertNull(
            $this->oneTimePasswordLinkGenerator->generateLoginLinkWithOrderReference(
                $this->orderTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGenerateLoginLinkWithOrderReferenceLinkNull(): void
    {
        $this->orderTransferMock->expects($this->atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->oneTimePasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('generateOneTimePassword')
            ->with($this->customerTransferMock)
            ->willReturn($this->oneTimePasswordResponseTransferMock);

        $this->oneTimePasswordResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(false);

        $this->assertNull(
            $this->oneTimePasswordLinkGenerator->generateLoginLinkWithOrderReference(
                $this->orderTransferMock
            )
        );
    }
}
