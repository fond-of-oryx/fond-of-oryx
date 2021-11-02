<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Communication\Plugin\Product;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\ProductCartCodeTypeRestrictionFacade;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractCartCodeTypeRestrictionProductAbstractAfterCreatePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\ProductCartCodeTypeRestrictionFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Communication\Plugin\Product\ProductAbstractCartCodeTypeRestrictionProductAbstractAfterCreatePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(ProductCartCodeTypeRestrictionFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ProductAbstractCartCodeTypeRestrictionProductAbstractAfterCreatePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('persistProductAbstractCartCodeTypeRestrictions')
            ->with($this->productAbstractTransferMock);

        static::assertEquals(
            $this->productAbstractTransferMock,
            $this->plugin->create($this->productAbstractTransferMock),
        );
    }
}
