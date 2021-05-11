<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

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
    protected $autoLoginPath;

    /**
     * @var string
     */
    protected $autoLoginParameterName;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordEncoderMock;

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

        $this->autoLoginPath = 'auto-login-path';

        $this->autoLoginParameterName = 'auto-login-parameter-name';

        $this->oneTimePasswordEncoderMock = $this->getMockBuilder(OneTimePasswordEncoderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordLinkGenerator = new OneTimePasswordLinkGenerator(
            $this->oneTimePasswordGeneratorMock,
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
            ->method('getAutoLoginPath')
            ->willReturn($this->autoLoginPath);

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getAutoLoginParameterName')
            ->willReturn($this->autoLoginParameterName);

        $this->assertIsString(
            $this->oneTimePasswordLinkGenerator->generateLoginLink(
                $this->customerTransferMock,
                $this->oneTimePasswordEncoderMock
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
                $this->customerTransferMock,
                $this->oneTimePasswordEncoderMock
            )
        );
    }
}
