<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Communication\Plugin\ProductExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\VertigoPriceProductPriceListFacade;
use Generated\Shared\Transfer\ProductConcreteTransfer;

class PriceListPriceProductConcreteCreatePluginTest extends Unit
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
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Communication\Plugin\ProductExtension\PriceListPriceProductConcreteCreatePlugin
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

        $this->plugin = new PriceListPriceProductConcreteCreatePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('requestMissingPriceProductPriceListByProductConcrete')
            ->with($this->productConcreteTransferMock);

        static::assertEquals(
            $this->productConcreteTransferMock,
            $this->plugin->create($this->productConcreteTransferMock),
        );
    }
}
