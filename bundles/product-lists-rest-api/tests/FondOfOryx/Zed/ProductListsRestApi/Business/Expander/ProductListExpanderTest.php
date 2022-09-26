<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListsRestApi\ProductListsRestApiConfig;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class ProductListExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\ProductListsRestApiConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\Expander\ProductListExpander
     */
    protected $productListExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ProductListsRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListTransferMock = $this->getMockBuilder(RestProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListExpander = new ProductListExpander($this->configMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $newData = [
            'title' => 'Foo',
            'foo' => 'bar',
        ];

        $allowedFieldsToPatchInQuote = ['title'];

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->restProductListTransferMock);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getAllowedFieldsToPatch')
            ->willReturn($allowedFieldsToPatchInQuote);

        $this->restProductListTransferMock->expects(static::atLeastOnce())
            ->method('modifiedToArray')
            ->willReturn($newData);

        $this->productListTransferMock->expects(static::atLeastOnce())
            ->method('setTitle')
            ->with($newData['title'])
            ->willReturn($this->productListTransferMock);

        static::assertEquals(
            $this->productListTransferMock,
            $this->productListExpander->expand(
                $this->productListTransferMock,
                $this->restProductListUpdateRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutRestProductList(): void
    {
        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn(null);

        $this->configMock->expects(static::never())
            ->method('getAllowedFieldsToPatch');

        static::assertEquals(
            $this->productListTransferMock,
            $this->productListExpander->expand(
                $this->productListTransferMock,
                $this->restProductListUpdateRequestTransferMock,
            ),
        );
    }
}
