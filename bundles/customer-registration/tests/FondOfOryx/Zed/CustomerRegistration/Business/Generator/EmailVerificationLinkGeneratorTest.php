<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Generator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfig;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToSequenceNumberFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;
use Generated\Shared\Transfer\StoreTransfer;

class EmailVerificationLinkGeneratorTest extends Unit
{
    /**
     * @var string
     */
    protected $localePattern = '{{locale}}';

    /**
     * @var string
     */
    protected $tokenPattern = '{{token}}';

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfigInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Generator\EmailVerificationLinkGeneratorInterface
     */
    protected $generator;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->localeFacadeMock = $this->getMockBuilder(CustomerRegistrationToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeMock = $this->getMockBuilder(CustomerRegistrationToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(CustomerRegistrationConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacadeMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->generator = new EmailVerificationLinkGenerator(
            $this->configMock,
            $this->storeFacadeMock,
            $this->localeFacadeMock,
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

        $this->generator->generateLink();
    }
}
