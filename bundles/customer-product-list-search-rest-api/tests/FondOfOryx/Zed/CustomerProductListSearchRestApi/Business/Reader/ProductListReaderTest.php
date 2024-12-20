<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Persistence\CustomerProductListSearchRestApiRepositoryInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class ProductListReaderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface
     */
    protected MockObject|IdCustomerFilterInterface $idCustomerFilterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CustomerProductListSearchRestApi\Persistence\CustomerProductListSearchRestApiRepositoryInterface
     */
    protected MockObject|CustomerProductListSearchRestApiRepositoryInterface $repositoryMock;

    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Reader\ProductListReader
     */
    protected ProductListReader $productListReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->idCustomerFilterMock = $this->getMockBuilder(IdCustomerFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CustomerProductListSearchRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->productListReader = new ProductListReader(
            $this->idCustomerFilterMock,
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testGetIdByFilterFields(): void
    {
        $idCustomer = 1;
        $productListIds = [5, 10, 11];

        $this->idCustomerFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($idCustomer);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getProductListIdsByIdCustomer')
            ->with($idCustomer)
            ->willReturn($productListIds);

        static::assertEquals(
            $productListIds,
            $this->productListReader->getIdsByFilterFields($this->filterFieldTransferMocks),
        );
    }

    /**
     * @return void
     */
    public function testGetIdByFilterFieldsWithoutIdCustomer(): void
    {
        $idCustomer = null;

        $this->idCustomerFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($idCustomer);

        $this->repositoryMock->expects(static::never())
            ->method('getProductListIdsByIdCustomer');

        static::assertEquals(
            [],
            $this->productListReader->getIdsByFilterFields($this->filterFieldTransferMocks),
        );
    }
}
