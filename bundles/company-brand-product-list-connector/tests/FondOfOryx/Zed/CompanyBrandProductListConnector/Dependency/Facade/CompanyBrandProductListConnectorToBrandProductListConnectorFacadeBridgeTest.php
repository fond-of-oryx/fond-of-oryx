<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BrandProductListConnector\Business\BrandProductListConnectorFacadeInterface;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandProductListConnectorFacadeBridge;

class CompanyBrandProductListConnectorToBrandProductListConnectorFacadeBridgeTest extends Unit
{
 /**
  * @var \FondOfOryx\Zed\BrandProductListConnector\Business\BrandProductListConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
  */
    protected $brandProductListConnectorFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandProductListConnectorFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->brandProductListConnectorFacadeMock = $this->getMockBuilder(BrandProductListConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CompanyBrandProductListConnectorToBrandProductListConnectorFacadeBridge(
            $this->brandProductListConnectorFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetBrandIdsByProductListIds(): void
    {
        $brandIds = [1, 2, 3];
        $productListIds = [1];

        $this->brandProductListConnectorFacadeMock->expects(static::atLeastOnce())
            ->method('getBrandIdsByProductListIds')
            ->with($productListIds)
            ->willReturn($brandIds);

        static::assertEquals(
            $brandIds,
            $this->bridge->getBrandIdsByProductListIds($productListIds),
        );
    }
}
