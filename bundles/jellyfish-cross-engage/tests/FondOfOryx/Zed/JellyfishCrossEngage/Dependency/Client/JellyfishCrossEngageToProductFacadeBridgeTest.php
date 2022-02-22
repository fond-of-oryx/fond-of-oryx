<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Product\Business\ProductFacadeInterface;

class JellyfishCrossEngageToProductFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductFacadeBridge
     */
    protected $jellyfishCrossEngageToProductFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected $productFacadeMock;

    /**
     * @var string
     */
    protected $sku;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductConcreteTransfer
     */
    protected $productConcreteTransferMock;

    /**
     * @var array<array<string>>
     */
    protected $attributes;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productFacadeMock = $this->getMockBuilder(ProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->sku = 'sku';

        $this->productConcreteTransferMock = $this->getMockBuilder(ProductConcreteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->attributes = [
            ['gender' => 'male'],
        ];

        $this->jellyfishCrossEngageToProductFacadeBridge = new JellyfishCrossEngageToProductFacadeBridge(
            $this->productFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetProductConcrete(): void
    {
        $this->productFacadeMock->expects($this->atLeastOnce())
            ->method('getProductConcrete')
            ->with($this->sku)
            ->willReturn($this->productConcreteTransferMock);

        $this->assertInstanceOf(
            ProductConcreteTransfer::class,
            $this->jellyfishCrossEngageToProductFacadeBridge->getProductConcrete(
                $this->sku,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetCombinedConcreteAttributes(): void
    {
        $this->productFacadeMock->expects($this->atLeastOnce())
            ->method('getCombinedConcreteAttributes')
            ->with($this->productConcreteTransferMock)
            ->willReturn($this->attributes);

        $this->assertSame(
            $this->attributes,
            $this->jellyfishCrossEngageToProductFacadeBridge->getCombinedConcreteAttributes(
                $this->productConcreteTransferMock,
            ),
        );
    }
}
