<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandProductListConnectorFacadeInterface;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

class BrandReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandProductListConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandProductListConnectorFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Reader\BrandReader
     */
    protected $brandReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->brandProductListConnectorFacadeMock = $this->getMockBuilder(
            CustomerBrandProductListConnectorToBrandProductListConnectorFacadeInterface::class,
        )->disableOriginalConstructor()->getMock();

        $this->customerProductListRelationTransferMock = $this->getMockBuilder(CustomerProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandReader = new BrandReader($this->brandProductListConnectorFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetBrandIdsByCustomerProductListRelationWithoutProductListIds(): void
    {
        $productListIds = [];

        $this->customerProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getProductListIds')
            ->willReturn($productListIds);

        $this->brandProductListConnectorFacadeMock->expects(static::never())
            ->method('getBrandIdsByProductListIds');

        static::assertEquals(
            [],
            $this->brandReader->getBrandIdsByCustomerProductListRelation($this->customerProductListRelationTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetBrandIdsByCustomerProductListRelation(): void
    {
        $brandIds = [1, 2, 3];
        $productListIds = [1];

        $this->customerProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getProductListIds')
            ->willReturn($productListIds);

        $this->brandProductListConnectorFacadeMock->expects(static::atLeastOnce())
            ->method('getBrandIdsByProductListIds')
            ->with($productListIds)
            ->willReturn($brandIds);

        static::assertEquals(
            $brandIds,
            $this->brandReader->getBrandIdsByCustomerProductListRelation($this->customerProductListRelationTransferMock),
        );
    }
}
