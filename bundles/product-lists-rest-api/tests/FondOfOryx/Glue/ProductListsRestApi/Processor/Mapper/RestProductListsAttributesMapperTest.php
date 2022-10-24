<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductListTransfer;

class RestProductListsAttributesMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListsAttributesMapper
     */
    protected $restProductListsAttributesMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListsAttributesMapper = new RestProductListsAttributesMapper();
    }

    /**
     * @return void
     */
    public function testFromProductList(): void
    {
        $data = [
            'title' => 'foo',
            'type' => 'blacklist',
        ];

        $this->productListTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $restProductListsAttributesTransfer = $this->restProductListsAttributesMapper->fromProductList(
            $this->productListTransferMock,
        );

        static::assertEquals($data['title'], $restProductListsAttributesTransfer->getTitle());
        static::assertEquals($data['type'], $restProductListsAttributesTransfer->getType());
    }
}
