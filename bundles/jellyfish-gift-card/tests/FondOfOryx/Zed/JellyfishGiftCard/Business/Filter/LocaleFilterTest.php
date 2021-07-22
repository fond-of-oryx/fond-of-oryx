<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Filter;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardConfig;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class LocaleFilterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Filter\LocaleFilter
     */
    protected $localeFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(JellyfishGiftCardConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFilter = new LocaleFilter($this->configMock);
    }

    /**
     * @return void
     */
    public function testFromOrder(): void
    {
        $localeName = 'en_US';

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->localeTransferMock->expects(static::atLeastOnce())
            ->method('getLocaleName')
            ->willReturn($localeName);

        $this->configMock->expects(static::never())
            ->method('getFallbackLocaleName');

        static::assertEquals($this->localeTransferMock, $this->localeFilter->fromOrder($this->orderTransferMock));
    }

    /**
     * @return void
     */
    public function testFromOrderWithFallback(): void
    {
        $fallbackLocaleName = 'en_US';

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn(null);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getFallbackLocaleName')
            ->willReturn($fallbackLocaleName);

        $localeTransfer = $this->localeFilter->fromOrder($this->orderTransferMock);

        static::assertEquals($fallbackLocaleName, $localeTransfer->getLocaleName());
    }
}
