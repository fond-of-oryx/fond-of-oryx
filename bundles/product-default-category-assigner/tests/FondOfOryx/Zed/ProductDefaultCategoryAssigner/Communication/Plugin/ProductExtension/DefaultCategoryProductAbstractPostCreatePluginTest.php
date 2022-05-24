<?php

namespace FondOfOryx\Zed\ProductDefaultCategoryAssigner\Communication\Plugin\ProductExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\ProductDefaultCategoryAssignerFacade;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class DefaultCategoryProductAbstractPostCreatePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\ProductDefaultCategoryAssignerFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productDefaultCategoryAssignerFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductDefaultCategoryAssigner\Communication\Plugin\ProductExtension\DefaultCategoryProductAbstractPostCreatePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productDefaultCategoryAssignerFacadeMock = $this->getMockBuilder(ProductDefaultCategoryAssignerFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new DefaultCategoryProductAbstractPostCreatePlugin();
        $this->plugin->setFacade(
            $this->productDefaultCategoryAssignerFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testPostCreate(): void
    {
        $this->productDefaultCategoryAssignerFacadeMock->expects(static::atLeastOnce())
            ->method('assignProductAbstractToDefaultCategory')
            ->with($this->productAbstractTransferMock)
            ->willReturn($this->productAbstractTransferMock);

        static::assertEquals(
            $this->productAbstractTransferMock,
            $this->plugin->postCreate($this->productAbstractTransferMock),
        );
    }
}
