<?php

namespace FondOfOryx\Zed\GiftCardApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardApi\Persistence\GiftCardApiRepository;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class GiftCardApiTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Business\Model\GiftCardApi
     */
    protected $model;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Persistence\GiftCardApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(GiftCardApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new GiftCardApi($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findByApiRequest')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertInstanceOf(
            ApiCollectionTransfer::class,
            $this->model->find($this->apiRequestTransferMock),
        );
    }
}
