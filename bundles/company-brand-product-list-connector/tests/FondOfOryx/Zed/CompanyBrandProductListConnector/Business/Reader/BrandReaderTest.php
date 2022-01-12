<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandProductListConnectorFacadeInterface;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

class BrandReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandProductListConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandProductListConnectorFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Reader\BrandReader
     */
    protected $brandReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->brandProductListConnectorFacadeMock = $this->getMockBuilder(
            CompanyBrandProductListConnectorToBrandProductListConnectorFacadeInterface::class,
        )->disableOriginalConstructor()->getMock();

        $this->companyProductListRelationTransferMock = $this->getMockBuilder(CompanyProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandReader = new BrandReader($this->brandProductListConnectorFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetBrandIdsByCompanyProductListRelationWithoutProductListIds(): void
    {
        $productListIds = [];

        $this->companyProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getProductListIds')
            ->willReturn($productListIds);

        $this->brandProductListConnectorFacadeMock->expects(static::never())
            ->method('getBrandIdsByProductListIds');

        static::assertEquals(
            [],
            $this->brandReader->getBrandIdsByCompanyProductListRelation($this->companyProductListRelationTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetBrandIdsByCompanyProductListRelation(): void
    {
        $brandIds = [1, 2, 3];
        $productListIds = [1];

        $this->companyProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getProductListIds')
            ->willReturn($productListIds);

        $this->brandProductListConnectorFacadeMock->expects(static::atLeastOnce())
            ->method('getBrandIdsByProductListIds')
            ->with($productListIds)
            ->willReturn($brandIds);

        static::assertEquals(
            $brandIds,
            $this->brandReader->getBrandIdsByCompanyProductListRelation($this->companyProductListRelationTransferMock),
        );
    }
}
