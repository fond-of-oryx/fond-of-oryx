<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Filter;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardConfig;
use Orm\Zed\Locale\Persistence\SpyLocale;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class LocaleFilterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesOrderItemEntityMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Filter\LocaleFilter
     */
    protected $localeFilter;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesOrderEntityMock;

    /**
     * @var \Orm\Zed\Locale\Persistence\SpyLocale|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeEntityMock;

    /**
     * @var array
     */
    protected $localeArray;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(JellyfishGiftCardConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderItemEntityMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderEntityMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeEntityMock = $this->getMockBuilder(SpyLocale::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->locale = 'de_DE';

        $this->localeArray = [
            'locale_name' => $this->locale,
        ];

        $this->localeFilter = new LocaleFilter($this->configMock);
    }

    /**
     * @return void
     */
    public function testFromSpySalesOrderItem(): void
    {
        $this->salesOrderItemEntityMock->expects(static::atLeastOnce())
            ->method('getOrder')
            ->willReturn($this->salesOrderEntityMock);

        $this->salesOrderEntityMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeEntityMock);

        $this->localeEntityMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($this->localeArray);

        $this->configMock->expects(static::never())
            ->method('getFallbackLocaleName');

        $localeTransfer = $this->localeFilter->fromSpySalesOrderItem($this->salesOrderItemEntityMock);

        static::assertEquals($localeTransfer->getLocaleName(), $this->locale);
    }

    /**
     * @return void
     */
    public function testFromSpySalesOrderItemWithFallback(): void
    {
        $fallbackLocaleName = 'en_US';

        $this->salesOrderItemEntityMock->expects(static::atLeastOnce())
            ->method('getOrder')
            ->willReturn($this->salesOrderEntityMock);

        $this->salesOrderEntityMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn(null);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getFallbackLocaleName')
            ->willReturn($fallbackLocaleName);

        $localeTransfer = $this->localeFilter->fromSpySalesOrderItem($this->salesOrderItemEntityMock);

        static::assertEquals($fallbackLocaleName, $localeTransfer->getLocaleName());
    }
}
