<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class JellyfishCrossEngageToLocaleFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToLocaleFacadeBridge
     */
    protected $jellyfishCrossEngageToLocaleFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected $localeFacadeMock;

    /**
     * @var string
     */
    protected $localeName;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\LocaleTransfer
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

        $this->localeName = 'en_US';

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishCrossEngageToLocaleFacadeBridge = new JellyfishCrossEngageToLocaleFacadeBridge(
            $this->localeFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetLocale(): void
    {
        $this->localeFacadeMock->expects($this->atLeastOnce())
            ->method('getLocale')
            ->with($this->localeName)
            ->willReturn($this->localeTransferMock);

        $this->assertInstanceOf(
            LocaleTransfer::class,
            $this->jellyfishCrossEngageToLocaleFacadeBridge->getLocale(
                $this->localeName,
            ),
        );
    }
}
