<?php

namespace FondOfOryx\Zed\StockApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\StockApi\Business\Model\Reader\StockReader;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class StockApiTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\StockApi\Business\Model\Reader\StockReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stockReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Business\Model\StockApi
     */
    protected $stockApi;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->stockReaderMock = $this->getMockBuilder(StockReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApi = new StockApi(
            $this->stockReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testGet()
    {
        $this->stockReaderMock->expects($this->once())
            ->method('getStockById')
            ->willReturn($this->apiItemTransferMock);

        $this->stockApi->get(1);
    }

    /**
     * @return void
     */
    public function testFind()
    {
        $this->stockReaderMock->expects($this->once())
            ->method('findStock')
            ->willReturn($this->apiCollectionTransferMock);

        $this->stockApi->find($this->apiRequestTransferMock);
    }
}
