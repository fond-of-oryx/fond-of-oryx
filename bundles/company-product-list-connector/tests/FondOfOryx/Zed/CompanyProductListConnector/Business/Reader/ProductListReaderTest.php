<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorRepositoryInterface;

class ProductListReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReader
     */
    protected $productListReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyProductListConnectorRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListReader = new ProductListReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetIdsByIdCompany(): void
    {
        $idCompany = 1;
        $productListIds = [1, 2, 3, 5];

        $this->repositoryMock->expects(static::atLeastOnce())
        ->method('getProductListIdsByIdCompany')
        ->with($idCompany)
        ->willReturn($productListIds);

        static::assertEquals(
            $productListIds,
            $this->productListReader->getIdsByIdCompany($idCompany),
        );
    }
}
