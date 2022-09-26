<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductListTransfer;

class RestProductListMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer&\PHPUnit\Framework\MockObject\MockObject|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\Mapper\RestProductListMapper
     */
    protected $restProductListMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListMapper = new RestProductListMapper();
    }

    /**
     * @return void
     */
    public function testFromProductList(): void
    {
        $data = [
            'title' => 'Foo',
        ];

        $this->productListTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $restProductListTransfer = $this->restProductListMapper->fromProductList($this->productListTransferMock);

        static::assertEquals(
            $data['title'],
            $restProductListTransfer->getTitle(),
        );
    }
}
