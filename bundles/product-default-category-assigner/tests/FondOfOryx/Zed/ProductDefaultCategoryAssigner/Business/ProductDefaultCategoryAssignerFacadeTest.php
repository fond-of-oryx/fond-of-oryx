<?php

namespace FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\Model\DefaultCategoryAssignerInterface;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductDefaultCategoryAssignerFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\ProductDefaultCategoryAssignerBusinessFactory
     */
    protected $productDefaultCategoryAssignerBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\Model\DefaultCategoryAssignerInterface
     */
    protected $defaultCategoryAssignerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\ProductDefaultCategoryAssignerFacade
     */
    protected $productDefaultCategoryAssignerFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productDefaultCategoryAssignerBusinessFactoryMock = $this->getMockBuilder(ProductDefaultCategoryAssignerBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->defaultCategoryAssignerMock = $this->getMockBuilder(DefaultCategoryAssignerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productDefaultCategoryAssignerFacade = new ProductDefaultCategoryAssignerFacade();
        $this->productDefaultCategoryAssignerFacade->setFactory($this->productDefaultCategoryAssignerBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testAssignProductAbstractToDefaultCategory(): void
    {
        $this->productDefaultCategoryAssignerBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createDefaultCategoryAssigner')
            ->willReturn($this->defaultCategoryAssignerMock);

        $this->defaultCategoryAssignerMock->expects(static::atLeastOnce())
            ->method('assign')
            ->with($this->productAbstractTransferMock)
            ->willReturn($this->productAbstractTransferMock);

        $productAbstractTransfer = $this->productDefaultCategoryAssignerFacade->assignProductAbstractToDefaultCategory(
            $this->productAbstractTransferMock,
        );

        static::assertEquals($this->productAbstractTransferMock, $productAbstractTransfer);
    }
}
