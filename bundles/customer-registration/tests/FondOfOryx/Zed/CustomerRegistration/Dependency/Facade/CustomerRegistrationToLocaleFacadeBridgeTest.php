<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class CustomerRegistrationToLocaleFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface
     */
    protected $facade;

    /**
     * @var \Spryker\Zed\Locale\Business\LocaleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->localeFacadeMock = $this->getMockBuilder(LocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CustomerRegistrationToLocaleFacadeBridge(
            $this->localeFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetLocale(): void
    {
        $this->localeFacadeMock->expects(static::atLeastOnce())->method('getLocale')->willReturn($this->localeTransferMock);

        $this->facade->getLocale(
            'de_DE',
        );
    }

    /**
     * @return void
     */
    public function testGetCurrentLocaleName(): void
    {
        $this->localeFacadeMock->expects(static::atLeastOnce())->method('getCurrentLocaleName')->willReturn('de_DE');

        $this->facade->getCurrentLocaleName();
    }
}
