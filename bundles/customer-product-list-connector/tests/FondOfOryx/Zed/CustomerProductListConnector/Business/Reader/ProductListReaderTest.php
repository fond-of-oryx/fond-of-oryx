<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorRepositoryInterface;

class ProductListReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReader
     */
    protected $productListReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CustomerProductListConnectorRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListReader = new ProductListReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetIdsByIdCustomer(): void
    {
        $idCustomer = 1;
        $productListIds = [1, 2, 3, 5];

        $this->repositoryMock->expects(static::atLeastOnce())
        ->method('getProductListIdsByIdCustomer')
        ->with($idCustomer)
        ->willReturn($productListIds);

        static::assertEquals(
            $productListIds,
            $this->productListReader->getIdsByIdCustomer($idCustomer),
        );
    }
}
