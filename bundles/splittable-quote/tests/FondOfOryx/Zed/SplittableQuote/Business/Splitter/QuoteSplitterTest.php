<?php

namespace FondOfOryx\Zed\SplittableQuote\Business\Splitter;

use ArrayObject;
use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\SplittableQuote\Dependency\Facade\SplittableQuoteToCalculationFacadeInterface;
use FondOfOryx\Zed\SplittableQuote\SplittableQuoteConfig;
use FondOfOryx\Zed\SplittableQuoteExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteSplitterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableQuote\Dependency\Facade\SplittableQuoteToCalculationFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $calculationFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuote\SplittableQuoteConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\FondOfOryx\Zed\SplittableQuoteExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface>
     */
    protected $splittedQuoteExpanderPluginMocks;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\ItemTransfer>
     */
    protected $itemTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittedQuoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuote\Business\Splitter\QuoteSplitter
     */
    protected $quoteSplitter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->calculationFacadeMock = $this->getMockBuilder(SplittableQuoteToCalculationFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(SplittableQuoteConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittedQuoteExpanderPluginMocks = [
            $this->getMockBuilder(SplittedQuoteExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->splittedQuoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteSplitter = new QuoteSplitter(
            $this->calculationFacadeMock,
            $this->configMock,
            $this->splittedQuoteExpanderPluginMocks,
        );
    }

    /**
     * @return void
     */
    public function testSplit(): void
    {
        $self = $this;

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

        $callCount = $this->atLeastOnce();
        $this->calculationFacadeMock->expects($callCount)
            ->method('recalculateQuote')
            ->willReturnCallback(static function (QuoteTransfer $quoteTransfer, bool $executeQuotePlugins = true) use ($self, $callCount, $groupKey) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertNull($quoteTransfer->getIdQuote());
                        $self->assertNull($quoteTransfer->getUuid());
                        $self->assertFalse($quoteTransfer->getIsDefault());
                        $self->assertSame($quoteTransfer->getSplitKey(), $groupKey);
                        $self->assertFalse($executeQuotePlugins);

                        return $self->splittedQuoteTransferMock;
                    case 2:
                        $self->assertEquals($self->splittedQuoteTransferMock, $quoteTransfer);
                        $self->assertFalse($executeQuotePlugins);

                        return $self->splittedQuoteTransferMock;
                }

                throw new Exception('Unexpected call count');
            });

        $this->splittedQuoteExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->splittedQuoteTransferMock)
            ->willReturn($this->quoteTransferMock);

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

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setSplitKey')
            ->with('*')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::never())
            ->method('getItems');

        $this->quoteTransferMock->expects(static::never())
            ->method('toArray');

        $this->splittedQuoteExpanderPluginMocks[0]->expects(static::never())
            ->method('expand');

        $this->calculationFacadeMock->expects(static::never())
            ->method('recalculateQuote');

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

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setSplitKey')
            ->with('*')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::never())
            ->method('getItems');

        $this->quoteTransferMock->expects(static::never())
            ->method('toArray');

        $this->splittedQuoteExpanderPluginMocks[0]->expects(static::never())
            ->method('expand');

        $this->calculationFacadeMock->expects(static::never())
            ->method('recalculateQuote');

        $quoteTransfers = $this->quoteSplitter->split($this->quoteTransferMock);

        static::assertCount(1, $quoteTransfers);
        static::assertArrayHasKey('*', $quoteTransfers);
        static::assertEquals($this->quoteTransferMock, $quoteTransfers['*']);
    }
}
