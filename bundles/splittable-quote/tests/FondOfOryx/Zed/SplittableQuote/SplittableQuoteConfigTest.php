<?php

namespace FondOfOryx\Zed\SplittableQuote;

use Codeception\Test\Unit;
use FondOfOryx\Shared\SplittableQuote\SplittableQuoteConstants;

class SplittableQuoteConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableQuote\SplittableQuoteConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableQuoteConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->splittableQuoteConfig = $this->getMockBuilder(SplittableQuoteConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetSplitItemAttribute(): void
    {
        $this->splittableQuoteConfig->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                SplittableQuoteConstants::SPLIT_ITEM_ATTRIBUTE,
                SplittableQuoteConstants::SPLIT_ITEM_ATTRIBUTE_DEFAULT,
            )->willReturn(SplittableQuoteConstants::SPLIT_ITEM_ATTRIBUTE_DEFAULT);

        static::assertEquals(
            null,
            $this->splittableQuoteConfig->getSplitItemAttribute(),
        );
    }

    /**
     * @return void
     */
    public function testGetCustomSplitItemAttribute(): void
    {
        $this->splittableQuoteConfig->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                SplittableQuoteConstants::SPLIT_ITEM_ATTRIBUTE,
                SplittableQuoteConstants::SPLIT_ITEM_ATTRIBUTE_DEFAULT,
            )->willReturn('foo');

        static::assertEquals(
            'foo',
            $this->splittableQuoteConfig->getSplitItemAttribute(),
        );
    }
}
