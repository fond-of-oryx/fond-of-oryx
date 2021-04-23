<?php

namespace FondOfOryx\Zed\SplittableTotals\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotals\Business\Reader\SplittableTotalsReaderInterface;
use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\SplittableTotalsResponseTransfer;

class SplittableTotalsFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\Reader\SplittableTotalsReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsReaderMock;

    /**
     * @var \Generated\Shared\Transfer\SplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SplittableTotalsResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(SplittableTotalsBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsReaderMock = $this->getMockBuilder(SplittableTotalsReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsRequestTransferMock = $this->getMockBuilder(SplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsResponseTransferMock = $this->getMockBuilder(SplittableTotalsResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new SplittableTotalsFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testGetSplittableTotalsBySplittableTotalsRequest(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createSplittableTotalsReader')
            ->willReturn($this->splittableTotalsReaderMock);

        $this->splittableTotalsReaderMock->expects(static::atLeastOnce())
            ->method('getBySplittableTotalsRequest')
            ->with($this->splittableTotalsRequestTransferMock)
            ->willReturn($this->splittableTotalsResponseTransferMock);

        static::assertEquals(
            $this->splittableTotalsResponseTransferMock,
            $this->facade->getSplittableTotalsBySplittableTotalsRequest(
                $this->splittableTotalsRequestTransferMock
            )
        );
    }
}
