<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToLocaleFacadeInterface;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToStoreFacadeInterface;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\StoreTransfer;

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
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToStoreFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $storeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToLocaleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $localeFacadeMock;

    /**
     * @var string
     */
    protected $currentLocaleName;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $storeTransferMock;

    /**
     * @var array<string>
     */
    protected $availableLocaleIsoCodes;

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

        $this->storeFacadeMock = $this->getMockBuilder(OneTimePasswordToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacadeMock = $this->getMockBuilder(OneTimePasswordToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->currentLocaleName = 'current-locale-name';

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->availableLocaleIsoCodes = [
            'url-locale' => $this->currentLocaleName,
        ];

        $this->oneTimePasswordLinkGenerator = new OneTimePasswordLinkGenerator(
            $this->oneTimePasswordGeneratorMock,
            $this->oneTimePasswordEncoderMock,
            $this->storeFacadeMock,
            $this->localeFacadeMock,
            $this->oneTimePasswordConfigMock,
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

        $this->localeFacadeMock->expects($this->atLeastOnce())
            ->method('getCurrentLocaleName')
            ->willReturn($this->currentLocaleName);

        $this->storeFacadeMock->expects($this->atLeastOnce())
            ->method('getCurrentStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects($this->atLeastOnce())
            ->method('getAvailableLocaleIsoCodes')
            ->willReturn($this->availableLocaleIsoCodes);

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getLoginLinkParameterName')
            ->willReturn($this->loginLinkParameterName);

        $this->oneTimePasswordResponseTransferMock->expects($this->atLeastOnce())
            ->method('setLoginLink')
            ->willReturnSelf();

        $this->assertSame(
            $this->oneTimePasswordResponseTransferMock,
            $this->oneTimePasswordLinkGenerator->generateLoginLink(
                $this->customerTransferMock,
            ),
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

        $this->assertSame(
            $this->oneTimePasswordResponseTransferMock,
            $this->oneTimePasswordLinkGenerator->generateLoginLink(
                $this->customerTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGenerateLoginLinkWithOrderReference(): void
    {
        $this->orderTransferMock->expects($this->atLeastOnce())
            ->method('requireCustomer')
            ->willReturnSelf();

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

        $this->localeFacadeMock->expects($this->atLeastOnce())
            ->method('getCurrentLocaleName')
            ->willReturn($this->currentLocaleName);

        $this->storeFacadeMock->expects($this->atLeastOnce())
            ->method('getCurrentStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects($this->atLeastOnce())
            ->method('getAvailableLocaleIsoCodes')
            ->willReturn($this->availableLocaleIsoCodes);

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getLoginLinkParameterName')
            ->willReturn($this->loginLinkParameterName);

        $this->oneTimePasswordConfigMock->expects($this->atLeastOnce())
            ->method('getLoginLinkOrderReferenceName')
            ->willReturn($this->loginLinkOrderReferenceName);

        $this->orderTransferMock->expects($this->atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($this->orderReference);

        $this->oneTimePasswordResponseTransferMock->expects($this->atLeastOnce())
            ->method('setLoginLink')
            ->willReturnSelf();

        $this->assertSame(
            $this->oneTimePasswordResponseTransferMock,
            $this->oneTimePasswordLinkGenerator->generateLoginLinkWithOrderReference(
                $this->orderTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGenerateLoginLinkWithOrderReferenceLinkNull(): void
    {
        $this->orderTransferMock->expects($this->atLeastOnce())
            ->method('requireCustomer')
            ->willReturnSelf();

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

        $this->assertSame(
            $this->oneTimePasswordResponseTransferMock,
            $this->oneTimePasswordLinkGenerator->generateLoginLinkWithOrderReference(
                $this->orderTransferMock,
            ),
        );
    }
}
