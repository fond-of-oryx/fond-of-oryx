<?php

namespace FondOfOryx\Zed\SplittableTotals;

use Codeception\Test\Unit;
use FondOfOryx\Shared\SplittableTotals\SplittableTotalsConstants;

class SplittableTotalsConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotals\SplittableTotalsConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->splittableTotalsConfig = $this->getMockBuilder(SplittableTotalsConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetSplitItemAttribute(): void
    {
        $this->splittableTotalsConfig->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                SplittableTotalsConstants::SPLIT_ITEM_ATTRIBUTE,
                SplittableTotalsConstants::SPLIT_ITEM_ATTRIBUTE_DEFAULT
            )->willReturn(SplittableTotalsConstants::SPLIT_ITEM_ATTRIBUTE_DEFAULT);

        static::assertEquals(
            null,
            $this->splittableTotalsConfig->getSplitItemAttribute()
        );
    }

    /**
     * @return void
     */
    public function testGetCustomSplitItemAttribute(): void
    {
        $this->splittableTotalsConfig->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                SplittableTotalsConstants::SPLIT_ITEM_ATTRIBUTE,
                SplittableTotalsConstants::SPLIT_ITEM_ATTRIBUTE_DEFAULT
            )->willReturn('foo');

        static::assertEquals(
            'foo',
            $this->splittableTotalsConfig->getSplitItemAttribute()
        );
    }
}
