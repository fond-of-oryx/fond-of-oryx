<?php

namespace FondOfOryx\Zed\ProductListApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListApi\Persistence\ProductListApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ProductListApiTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductListApi\Business\Model\ProductListApi
     */
    protected $model;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductListApi\Persistence\ProductListApiRepositoryInterface
     */
    protected $repositoryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiRequestTransferMock = $this
            ->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this
            ->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this
            ->getMockBuilder(ProductListApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new ProductListApi($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $data = [
            ['id_product_list' => 1],
        ];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('setData')
            ->with($data)
            ->willReturnSelf();

        static::assertInstanceOf(
            ApiCollectionTransfer::class,
            $this->model->find($this->apiRequestTransferMock),
        );
    }
}
