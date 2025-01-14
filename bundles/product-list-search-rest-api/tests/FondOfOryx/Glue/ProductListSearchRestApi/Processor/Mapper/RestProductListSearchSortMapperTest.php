<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ProductListSearchRestApi\ProductListSearchRestApiConfig;
use Generated\Shared\Transfer\ProductListCollectionTransfer;

class RestProductListSearchSortMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\ProductListSearchRestApiConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListCollectionTransferMock;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchSortMapper
     */
    protected RestProductListSearchSortMapper $restProductListSearchSortMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ProductListSearchRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCollectionTransferMock = $this->getMockBuilder(ProductListCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListSearchSortMapper = new RestProductListSearchSortMapper($this->configMock);
    }

    /**
     * @return void
     */
    public function testFromProductListCollection(): void
    {
        $sortParamNames = ['name_asc', 'name_desc'];
        $sortFields = ['name'];

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortParamNames')
            ->willReturn($sortParamNames);

        $this->productListCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($sortParamNames[0]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortFields')
            ->willReturn($sortFields);

        $restProductListSearchSortTransfer = $this->restProductListSearchSortMapper->fromProductListCollection(
            $this->productListCollectionTransferMock,
        );

        static::assertEquals('asc', $restProductListSearchSortTransfer->getCurrentSortOrder());
        static::assertEquals($sortParamNames[0], $restProductListSearchSortTransfer->getCurrentSortParam());
        static::assertEquals($sortParamNames, $restProductListSearchSortTransfer->getSortParamNames());
    }
}
