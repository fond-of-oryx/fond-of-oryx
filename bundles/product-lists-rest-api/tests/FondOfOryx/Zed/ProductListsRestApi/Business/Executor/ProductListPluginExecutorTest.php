<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business\Executor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListPostUpdatePluginInterface;
use FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListUpdatePreCheckPluginInterface;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class ProductListPluginExecutorTest extends Unit
{
    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListUpdatePreCheckPluginInterface>
     */
    protected $productListUpdatePreCheckPluginMocks;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListPostUpdatePluginInterface>
     */
    protected $productListPostUpdatePluginMocks;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\Executor\ProductListPluginExecutor
     */
    protected $productListPluginExecutor;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListUpdatePreCheckPluginMocks = [
            $this->getMockBuilder(ProductListUpdatePreCheckPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ProductListUpdatePreCheckPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->productListPostUpdatePluginMocks = [
            $this->getMockBuilder(ProductListPostUpdatePluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListPluginExecutor = new ProductListPluginExecutor(
            $this->productListUpdatePreCheckPluginMocks,
            $this->productListPostUpdatePluginMocks,
        );
    }

    /**
     * @return void
     */
    public function testExecuteUpdatePreCheckPlugins(): void
    {
        foreach ($this->productListUpdatePreCheckPluginMocks as $productListUpdatePreCheckPluginMock) {
            $productListUpdatePreCheckPluginMock->expects(static::atLeastOnce())
                ->method('preCheck')
                ->with(
                    $this->restProductListUpdateRequestTransferMock,
                    $this->productListTransferMock,
                )->willReturn(true);
        }

        static::assertTrue(
            $this->productListPluginExecutor->executeUpdatePreCheckPlugins(
                $this->restProductListUpdateRequestTransferMock,
                $this->productListTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExecuteUpdatePreCheckPluginsWithInvalidData(): void
    {
        foreach ($this->productListUpdatePreCheckPluginMocks as $index => $productListUpdatePreCheckPluginMock) {
            $productListUpdatePreCheckPluginMock->expects(static::atLeastOnce())
                ->method('preCheck')
                ->with(
                    $this->restProductListUpdateRequestTransferMock,
                    $this->productListTransferMock,
                )->willReturn($index < (count($this->productListUpdatePreCheckPluginMocks) - 1));
        }

        static::assertFalse(
            $this->productListPluginExecutor->executeUpdatePreCheckPlugins(
                $this->restProductListUpdateRequestTransferMock,
                $this->productListTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExecutePostUpdatePlugins(): void
    {
        foreach ($this->productListPostUpdatePluginMocks as $productListPostUpdatePluginMock) {
            $productListPostUpdatePluginMock->expects(static::atLeastOnce())
                ->method('postUpdate')
                ->with(
                    $this->restProductListUpdateRequestTransferMock,
                    $this->productListTransferMock,
                )->willReturn($this->productListTransferMock);
        }

        static::assertEquals(
            $this->productListTransferMock,
            $this->productListPluginExecutor->executePostUpdatePlugins(
                $this->restProductListUpdateRequestTransferMock,
                $this->productListTransferMock,
            ),
        );
    }
}
