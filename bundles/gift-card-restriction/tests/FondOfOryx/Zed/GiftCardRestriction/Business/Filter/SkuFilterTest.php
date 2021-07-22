<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business\Filter;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\ItemTransfer;

class SkuFilterTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\Filter\SkuFilter
     */
    protected $skuFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->skuFilter = new SkuFilter();
    }

    /**
     * @return void
     */
    public function testFilterFromItems(): void
    {
        $sku = 'FOO-1';

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($sku);

        $skus = $this->skuFilter->filterFromItems(new ArrayObject([$this->itemTransferMock]));

        static::assertCount(1, $skus);
        static::assertEquals($sku, $skus[0]);
    }
}
