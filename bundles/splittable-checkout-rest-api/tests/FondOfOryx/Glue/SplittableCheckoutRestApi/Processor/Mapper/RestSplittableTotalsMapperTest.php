<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\SplittableTotalsTransfer;
use Generated\Shared\Transfer\TaxTotalTransfer;
use Generated\Shared\Transfer\TotalsTransfer;
use Laminas\Stdlib\ArrayObject;

class RestSplittableTotalsMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\SplittableTotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsTransferMock;

    /**
     * @var array<string, \Generated\Shared\Transfer\TotalsTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $totalsTransferMocks;

    /**
     * @var array<string, \Generated\Shared\Transfer\TaxTotalTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $taxTotalTransferMocks;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableTotalsMapper
     */
    protected $restSplittableTotalsMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->splittableTotalsTransferMock = $this->getMockBuilder(SplittableTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->totalsTransferMocks = [
            'foo' => $this->getMockBuilder(TotalsTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            'bar' => $this->getMockBuilder(TotalsTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->taxTotalTransferMocks = [
            'foo' => $this->getMockBuilder(TaxTotalTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            'bar' => $this->getMockBuilder(TaxTotalTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restSplittableTotalsMapper = new RestSplittableTotalsMapper();
    }

    /**
     * @return void
     */
    public function testFromSplittableTotals(): void
    {
        $this->splittableTotalsTransferMock->expects(static::atLeastOnce())
            ->method('getTotalsList')
            ->willReturn(new ArrayObject($this->totalsTransferMocks));

        foreach ($this->totalsTransferMocks as $index => $totalsTransferMock) {
            $totalsTransferMock->expects(static::atLeastOnce())
                ->method('toArray')
                ->willReturn([]);

            $totalsTransferMock->expects(static::atLeastOnce())
                ->method('getTaxTotal')
                ->willReturn($this->taxTotalTransferMocks[$index]);

            $this->taxTotalTransferMocks[$index]->expects(static::atLeastOnce())
                ->method('getAmount')
                ->willReturn(100);
        }

        $restSplittableTotalsTransfer = $this->restSplittableTotalsMapper
            ->fromSplittableTotals($this->splittableTotalsTransferMock);

        static::assertEquals(array_keys($this->totalsTransferMocks), $restSplittableTotalsTransfer->getSplitKeys());
        static::assertCount(2, $restSplittableTotalsTransfer->getTotalsList());
    }
}
