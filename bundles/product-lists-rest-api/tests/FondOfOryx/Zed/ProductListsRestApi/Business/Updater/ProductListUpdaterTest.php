<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business\Updater;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListsRestApi\Business\Executor\ProductListPluginExecutorInterface;
use FondOfOryx\Zed\ProductListsRestApi\Business\Expander\ProductListExpanderInterface;
use FondOfOryx\Zed\ProductListsRestApi\Business\Mapper\RestProductListMapperInterface;
use FondOfOryx\Zed\ProductListsRestApi\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeInterface;
use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Generated\Shared\Transfer\RestProductListUpdateResponseTransfer;

class ProductListUpdaterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\Reader\ProductListReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListReaderMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\Expander\ProductListExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListExpanderMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\Executor\ProductListPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListPluginExecutorMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\Mapper\RestProductListMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListMapperMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\Updater\ProductListUpdater
     */
    protected $productListUpdater;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListReaderMock = $this->getMockBuilder(ProductListReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListExpanderMock = $this->getMockBuilder(ProductListExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListPluginExecutorMock = $this->getMockBuilder(ProductListPluginExecutorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListMapperMock = $this->getMockBuilder(RestProductListMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListFacadeMock = $this->getMockBuilder(ProductListsRestApiToProductListFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateResponseTransferMock = $this->getMockBuilder(RestProductListUpdateResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListResponseTransferMock = $this->getMockBuilder(ProductListResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListTransferMock = $this->getMockBuilder(RestProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListUpdater = new ProductListUpdater(
            $this->productListReaderMock,
            $this->productListExpanderMock,
            $this->productListPluginExecutorMock,
            $this->restProductListMapperMock,
            $this->productListFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->productListReaderMock->expects(static::atLeastOnce())
            ->method('getByRestProductListUpdateRequest')
            ->with($this->restProductListUpdateRequestTransferMock)
            ->willReturn($this->productListTransferMock);

        $this->productListPluginExecutorMock->expects(static::atLeastOnce())
            ->method('executeUpdatePreCheckPlugins')
            ->with(
                $this->restProductListUpdateRequestTransferMock,
                $this->productListTransferMock,
            )->willReturn(true);

        $this->productListExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with(
                $this->productListTransferMock,
                $this->restProductListUpdateRequestTransferMock,
            )->willReturn(
                $this->productListTransferMock,
            );

        $this->productListFacadeMock->expects(static::atLeastOnce())
            ->method('updateProductList')
            ->with($this->productListTransferMock)
            ->willReturn($this->productListResponseTransferMock);

        $this->productListResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->productListPluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePostUpdatePlugins')
            ->with(
                $this->restProductListUpdateRequestTransferMock,
                $this->productListTransferMock,
            )->willReturn(
                $this->productListTransferMock,
            );

        $this->restProductListMapperMock->expects(static::atLeastOnce())
            ->method('fromProductList')
            ->with($this->productListTransferMock)
            ->willReturn($this->restProductListTransferMock);

        $restProductListUpdateResponseTransfer = $this->productListUpdater->update(
            $this->restProductListUpdateRequestTransferMock,
        );

        static::assertEquals(
            $this->restProductListTransferMock,
            $restProductListUpdateResponseTransfer->getProductList(),
        );

        static::assertEquals(
            true,
            $restProductListUpdateResponseTransfer->getIsSuccessful(),
        );
    }

    /**
     * @return void
     */
    public function testUpdateWithoutExistingProductList(): void
    {
        $this->productListReaderMock->expects(static::atLeastOnce())
            ->method('getByRestProductListUpdateRequest')
            ->with($this->restProductListUpdateRequestTransferMock)
            ->willReturn(null);

        $this->productListPluginExecutorMock->expects(static::never())
            ->method('executeUpdatePreCheckPlugins');

        $this->productListExpanderMock->expects(static::never())
            ->method('expand');

        $this->productListFacadeMock->expects(static::never())
            ->method('updateProductList');

        $this->productListPluginExecutorMock->expects(static::never())
            ->method('executePostUpdatePlugins');

        $this->restProductListMapperMock->expects(static::never())
            ->method('fromProductList');

        $restProductListUpdateResponseTransfer = $this->productListUpdater->update(
            $this->restProductListUpdateRequestTransferMock,
        );

        static::assertEquals(
            null,
            $restProductListUpdateResponseTransfer->getProductList(),
        );

        static::assertEquals(
            false,
            $restProductListUpdateResponseTransfer->getIsSuccessful(),
        );
    }

    /**
     * @return void
     */
    public function testUpdateWithInvalidRestProductList(): void
    {
        $this->productListReaderMock->expects(static::atLeastOnce())
            ->method('getByRestProductListUpdateRequest')
            ->with($this->restProductListUpdateRequestTransferMock)
            ->willReturn($this->productListTransferMock);

        $this->productListPluginExecutorMock->expects(static::atLeastOnce())
            ->method('executeUpdatePreCheckPlugins')
            ->with(
                $this->restProductListUpdateRequestTransferMock,
                $this->productListTransferMock,
            )->willReturn(false);

        $this->productListExpanderMock->expects(static::never())
            ->method('expand');

        $this->productListFacadeMock->expects(static::never())
            ->method('updateProductList');

        $this->productListPluginExecutorMock->expects(static::never())
            ->method('executePostUpdatePlugins');

        $this->restProductListMapperMock->expects(static::never())
            ->method('fromProductList');

        $restProductListUpdateResponseTransfer = $this->productListUpdater->update(
            $this->restProductListUpdateRequestTransferMock,
        );

        static::assertEquals(
            null,
            $restProductListUpdateResponseTransfer->getProductList(),
        );

        static::assertEquals(
            false,
            $restProductListUpdateResponseTransfer->getIsSuccessful(),
        );
    }

    /**
     * @return void
     */
    public function testUpdateWithError(): void
    {
        $this->productListReaderMock->expects(static::atLeastOnce())
            ->method('getByRestProductListUpdateRequest')
            ->with($this->restProductListUpdateRequestTransferMock)
            ->willReturn($this->productListTransferMock);

        $this->productListPluginExecutorMock->expects(static::atLeastOnce())
            ->method('executeUpdatePreCheckPlugins')
            ->with(
                $this->restProductListUpdateRequestTransferMock,
                $this->productListTransferMock,
            )->willReturn(true);

        $this->productListExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with(
                $this->productListTransferMock,
                $this->restProductListUpdateRequestTransferMock,
            )->willReturn(
                $this->productListTransferMock,
            );

        $this->productListFacadeMock->expects(static::atLeastOnce())
            ->method('updateProductList')
            ->with($this->productListTransferMock)
            ->willReturn($this->productListResponseTransferMock);

        $this->productListResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->productListPluginExecutorMock->expects(static::never())
            ->method('executePostUpdatePlugins');

        $this->restProductListMapperMock->expects(static::never())
            ->method('fromProductList');

        $restProductListUpdateResponseTransfer = $this->productListUpdater->update(
            $this->restProductListUpdateRequestTransferMock,
        );

        static::assertEquals(
            null,
            $restProductListUpdateResponseTransfer->getProductList(),
        );

        static::assertEquals(
            false,
            $restProductListUpdateResponseTransfer->getIsSuccessful(),
        );
    }
}
