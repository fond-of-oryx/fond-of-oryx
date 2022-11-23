<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business\Executor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListPostUpdatePluginInterface;
use FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\ProductListUpdatePreCheckPluginInterface;
use FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\RestProductListUpdateRequestExpanderPluginInterface;
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
     * @var array<\PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin\RestProductListUpdateRequestExpanderPluginInterface>
     */
    protected $restProductListUpdateRequestExpanderPluginMocks;

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

        $this->restProductListUpdateRequestExpanderPluginMocks = [
            $this->getMockBuilder(RestProductListUpdateRequestExpanderPluginInterface::class)
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
            $this->restProductListUpdateRequestExpanderPluginMocks,
        );
    }

    /**
     * @return void
     */
    public function testExecuteProductListUpdatePreCheckPlugins(): void
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
            $this->productListPluginExecutor->executeProductListUpdatePreCheckPlugins(
                $this->restProductListUpdateRequestTransferMock,
                $this->productListTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExecuteProductListUpdatePreCheckPluginsWithInvalidData(): void
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
            $this->productListPluginExecutor->executeProductListUpdatePreCheckPlugins(
                $this->restProductListUpdateRequestTransferMock,
                $this->productListTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExecuteProductListPostUpdatePlugins(): void
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
            $this->productListPluginExecutor->executeProductListPostUpdatePlugins(
                $this->restProductListUpdateRequestTransferMock,
                $this->productListTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExecuteRestProductListUpdateRequestExpanderPlugins(): void
    {
        foreach ($this->restProductListUpdateRequestExpanderPluginMocks as $restProductListUpdateRequestExpanderPluginMock) {
            $restProductListUpdateRequestExpanderPluginMock->expects(static::atLeastOnce())
                ->method('expand')
                ->with($this->restProductListUpdateRequestTransferMock)
                ->willReturn($this->restProductListUpdateRequestTransferMock);
        }

        static::assertEquals(
            $this->restProductListUpdateRequestTransferMock,
            $this->productListPluginExecutor->executeRestProductListUpdateRequestExpanderPlugins(
                $this->restProductListUpdateRequestTransferMock,
            ),
        );
    }
}
