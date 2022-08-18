<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Communication\Plugin\Product;

use Codeception\Test\Unit;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\VertigoPriceProductPriceListFacade;
use Generated\Shared\Transfer\ProductConcreteTransfer;

class PriceListPriceProductConcretePluginUpdateTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\VertigoPriceProductPriceListFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\ProductConcreteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productConcreteTransferMock;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Communication\Plugin\Product\PriceListPriceProductConcretePluginUpdate
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(VertigoPriceProductPriceListFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productConcreteTransferMock = $this->getMockBuilder(ProductConcreteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new PriceListPriceProductConcretePluginUpdate();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('requestMissingPriceProductPriceListByProductConcrete')
            ->with($this->productConcreteTransferMock);

        static::assertEquals(
            $this->productConcreteTransferMock,
            $this->plugin->update($this->productConcreteTransferMock),
        );
    }
}
