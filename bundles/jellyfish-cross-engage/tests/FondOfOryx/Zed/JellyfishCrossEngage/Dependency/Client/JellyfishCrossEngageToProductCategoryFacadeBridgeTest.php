<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CategoryCollectionTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\ProductCategory\Business\ProductCategoryFacadeInterface;

class JellyfishCrossEngageToProductCategoryFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductCategoryFacadeBridge
     */
    protected $jellyfishCrossEngageToProductCategoryFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\ProductCategory\Business\ProductCategoryFacadeInterface
     */
    protected $productCategoryFacadeMock;

    /**
     * @var int
     */
    protected $idProductAbstract;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\LocaleTransfer
     */
    protected $localeTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CategoryCollectionTransfer
     */
    protected $categoryCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productCategoryFacadeMock = $this->getMockBuilder(ProductCategoryFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idProductAbstract = 1;

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryCollectionTransferMock = $this->getMockBuilder(CategoryCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishCrossEngageToProductCategoryFacadeBridge = new JellyfishCrossEngageToProductCategoryFacadeBridge(
            $this->productCategoryFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetCategoryTransferCollectionByIdProductAbstract(): void
    {
        $this->productCategoryFacadeMock->expects($this->atLeastOnce())
            ->method('getCategoryTransferCollectionByIdProductAbstract')
            ->with(
                $this->idProductAbstract,
                $this->localeTransferMock
            )->willReturn($this->categoryCollectionTransferMock);

        $this->assertInstanceOf(
            CategoryCollectionTransfer::class,
            $this->jellyfishCrossEngageToProductCategoryFacadeBridge->getCategoryTransferCollectionByIdProductAbstract(
                $this->idProductAbstract,
                $this->localeTransferMock
            )
        );
    }
}
