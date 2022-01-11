<?php

namespace FondOfOryx\Zed\BrandProductListConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BrandProductListConnector\Persistence\BrandProductListConnectorRepository;

class BrandProductListConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\BrandProductListConnector\Persistence\BrandProductListConnectorRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\BrandProductListConnector\Business\BrandProductListConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(BrandProductListConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new BrandProductListConnectorFacade();
        $this->facade->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetBrandIdsByProductListIds(): void
    {
        $productListIds = [2, 5];
        $brandIds = [1, 2, 3, 4];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getBrandIdsByProductListIds')
            ->with($productListIds)
            ->willReturn($brandIds);

        static::assertEquals(
            $brandIds,
            $this->facade->getBrandIdsByProductListIds($productListIds),
        );
    }
}
