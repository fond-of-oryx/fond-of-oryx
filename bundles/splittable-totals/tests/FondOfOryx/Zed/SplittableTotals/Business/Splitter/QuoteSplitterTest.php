<?php

namespace FondOfOryx\Zed\SplittableTotals\Business\Splitter;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotals\SplittableTotalsConfig;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteSplitterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotals\SplittableTotalsConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $itemTransferMocks;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitter
     */
    protected $quoteSplitter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(SplittableTotalsConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->quoteSplitter = new QuoteSplitter($this->configMock);
    }

    /**
     * @return void
     */
    public function testSplit(): void
    {
        $groupKey = 'foo';

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSplitItemAttribute')
            ->willReturn('group_key');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getGroupKey')
            ->willReturn($groupKey);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $quoteTransfers = $this->quoteSplitter->split($this->quoteTransferMock);

        static::assertCount(1, $quoteTransfers);
        static::assertArrayHasKey($groupKey, $quoteTransfers);
    }

    /**
     * @return void
     */
    public function testSplitWithoutSplitItemAttribute(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getSplitItemAttribute')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::never())
            ->method('getItems');

        $this->quoteTransferMock->expects(static::never())
            ->method('toArray');

        $quoteTransfers = $this->quoteSplitter->split($this->quoteTransferMock);

        static::assertCount(1, $quoteTransfers);
        static::assertArrayHasKey('*', $quoteTransfers);
        static::assertEquals($this->quoteTransferMock, $quoteTransfers['*']);
    }

    /**
     * @return void
     */
    public function testSplitWithUndefinedSplitItemAttribute(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getSplitItemAttribute')
            ->willReturn('xxx_yyy_zzz');

        $this->quoteTransferMock->expects(static::never())
            ->method('getItems');

        $this->quoteTransferMock->expects(static::never())
            ->method('toArray');

        $quoteTransfers = $this->quoteSplitter->split($this->quoteTransferMock);

        static::assertCount(1, $quoteTransfers);
        static::assertArrayHasKey('*', $quoteTransfers);
        static::assertEquals($this->quoteTransferMock, $quoteTransfers['*']);
    }
}
