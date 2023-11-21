<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\LocaleTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class CompanyUserMailConnectorToLocaleFacadeBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\Locale\Business\LocaleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected LocaleFacadeInterface|MockObject $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected LocaleTransfer|MockObject $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToLocaleFacadeInterface
     */
    protected CompanyUserMailConnectorToLocaleFacadeInterface $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(LocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CompanyUserMailConnectorToLocaleFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testGetCurrentLocale(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($this->localeTransferMock);

        static::assertEquals(
            $this->localeTransferMock,
            $this->bridge->getCurrentLocale(),
        );
    }

    /**
     * @return void
     */
    public function testGetLocaleById(): void
    {
        $idLocale = 1;

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getLocaleById')
            ->with($idLocale)
            ->willReturn($this->localeTransferMock);

        static::assertEquals(
            $this->localeTransferMock,
            $this->bridge->getLocaleById($idLocale),
        );
    }
}
