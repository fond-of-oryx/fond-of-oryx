<?php

namespace FondOfOryx\Zed\SalesLocaleConnector\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class SalesLocaleConnectorToLocaleFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected $localeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\LocaleTransfer
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\SalesLocaleConnector\Dependency\Facade\SalesLocaleConnectorToLocaleFacadeBridge
     */
    protected $salesLocaleConnectorToLocaleFacadeBridge;

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

        $this->salesLocaleConnectorToLocaleFacadeBridge = new SalesLocaleConnectorToLocaleFacadeBridge(
            $this->localeFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetLocaleById(): void
    {
        $idLocale = 1;

        $this->localeFacadeMock->expects($this->atLeastOnce())
            ->method('getLocaleById')
            ->with($idLocale)
            ->willReturn($this->localeTransferMock);

        $this->assertEquals(
            $this->localeTransferMock,
            $this->salesLocaleConnectorToLocaleFacadeBridge->getLocaleById($idLocale)
        );
    }
}
