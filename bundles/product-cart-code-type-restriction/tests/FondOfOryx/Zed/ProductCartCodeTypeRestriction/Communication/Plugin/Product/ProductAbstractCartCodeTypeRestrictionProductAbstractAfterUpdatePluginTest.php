<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Communication\Plugin\Product;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\ProductCartCodeTypeRestrictionFacade;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractCartCodeTypeRestrictionProductAbstractAfterUpdatePluginTest extends Unit
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
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Communication\Plugin\Product\ProductAbstractCartCodeTypeRestrictionProductAbstractAfterUpdatePlugin
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

        $this->plugin = new ProductAbstractCartCodeTypeRestrictionProductAbstractAfterUpdatePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('persistProductAbstractCartCodeTypeRestrictions')
            ->with($this->productAbstractTransferMock);

        static::assertEquals(
            $this->productAbstractTransferMock,
            $this->plugin->update($this->productAbstractTransferMock),
        );
    }
}
