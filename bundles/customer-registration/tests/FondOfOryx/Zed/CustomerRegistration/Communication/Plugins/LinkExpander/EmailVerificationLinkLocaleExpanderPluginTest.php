<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\LinkExpander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistration\Communication\CustomerRegistrationCommunicationFactory;
use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfig;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\StoreTransfer;

class EmailVerificationLinkLocaleExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\LinkExpander\EmailVerificationLinkLocaleExpanderPlugin
     */
    protected $emailVerificationLinkLocaleExpanderPlugin;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Communication\CustomerRegistrationCommunicationFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationCommunicationFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfigInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationConfigMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected $localeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerRegistrationCommunicationFactoryMock = $this->getMockBuilder(CustomerRegistrationCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationConfigMock = $this->getMockBuilder(CustomerRegistrationConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacadeMock = $this->getMockBuilder(CustomerRegistrationToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeMock = $this->getMockBuilder(CustomerRegistrationToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->emailVerificationLinkLocaleExpanderPlugin = new EmailVerificationLinkLocaleExpanderPlugin();
        $this->emailVerificationLinkLocaleExpanderPlugin->setFactory($this->customerRegistrationCommunicationFactoryMock);
        $this->emailVerificationLinkLocaleExpanderPlugin->setConfig($this->customerRegistrationConfigMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $locale = 'locale';
        $link = '{{locale}}';

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->customerRegistrationCommunicationFactoryMock->expects(static::atLeastOnce())
            ->method('getLocaleFacade')
            ->willReturn($this->localeFacadeMock);

        $this->localeFacadeMock->expects(static::atLeastOnce())
            ->method('getCurrentLocaleName')
            ->willReturn('other-locale');

        $this->localeTransferMock->expects(static::atLeastOnce())
            ->method('getLocaleName')
            ->willReturn($locale);

        $this->customerRegistrationCommunicationFactoryMock->expects(static::atLeastOnce())
            ->method('getStoreFacade')
            ->willReturn($this->storeFacadeMock);

        $this->storeFacadeMock->expects(static::atLeastOnce())
            ->method('getCurrentStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects(static::atLeastOnce())
            ->method('getAvailableLocaleIsoCodes')
            ->willReturn([$locale => $locale]);

        $this->assertSame(
            $locale,
            $this->emailVerificationLinkLocaleExpanderPlugin->expand(
                $link,
                $this->customerTransferMock,
            ),
        );
    }
}
