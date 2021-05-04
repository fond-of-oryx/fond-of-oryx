<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader\SplittableTotalsReaderInterface;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;

class SplittableTotalsRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Business\SplittableTotalsRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader\SplittableTotalsReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsReaderMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Business\SplittableTotalsRestApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(SplittableTotalsRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsRequestTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsResponseTransferMock = $this->getMockBuilder(RestSplittableTotalsResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsReaderMock = $this->getMockBuilder(SplittableTotalsReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new SplittableTotalsRestApiFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testGetSplittableTotals(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createSplittableTotalsReader')
            ->willReturn($this->splittableTotalsReaderMock);

        $this->splittableTotalsReaderMock->expects(static::atLeastOnce())
            ->method('getByRestSplittableTotalsRequest')
            ->with($this->restSplittableTotalsRequestTransferMock)
            ->willReturn($this->restSplittableTotalsResponseTransferMock);

        static::assertEquals(
            $this->restSplittableTotalsResponseTransferMock,
            $this->facade->getSplittableTotals($this->restSplittableTotalsRequestTransferMock)
        );
    }
}
