<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig;
use FondOfOryx\Shared\CartSearchRestApi\CartSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QuoteListTransfer;

class RestCartSearchSortMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $quoteListTransferMock;

    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchSortMapper
     */
    protected $restCartSearchSortMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(CartSearchRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteListTransferMock = $this->getMockBuilder(QuoteListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restCartSearchSortMapper = new RestCartSearchSortMapper($this->configMock);
    }

    /**
     * @return void
     */
    public function testFromQuoteList(): void
    {
        $sortParamNames = ['name_asc', 'name_desc'];
        $sortParamLocalizedNames = ['cart_search_rest_api.sort.name_asc', 'cart_search_rest_api.sort.name_desc'];
        $sortFields = ['name'];

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortParamNames')
            ->willReturn($sortParamNames);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($sortParamLocalizedNames);

        $this->quoteListTransferMock->expects(static::atLeastOnce())
            ->method('getFilterFields')
            ->willReturn(new ArrayObject($this->filterFieldTransferMocks));

        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[0]->expects(static::never())
            ->method('getValue');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CartSearchRestApiConstants::FILTER_FIELD_TYPE_ORDER_BY);

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn('name::asc');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortFields')
            ->willReturn($sortFields);

        $restCartSearchSortTransfer = $this->restCartSearchSortMapper->fromQuoteList(
            $this->quoteListTransferMock,
        );

        static::assertEquals('asc', $restCartSearchSortTransfer->getCurrentSortOrder());
        static::assertEquals($sortParamNames[0], $restCartSearchSortTransfer->getCurrentSortParam());
        static::assertEquals($sortParamNames, $restCartSearchSortTransfer->getSortParamNames());
        static::assertEquals($sortParamLocalizedNames, $restCartSearchSortTransfer->getSortParamLocalizedNames());
    }

    /**
     * @return void
     */
    public function testFromQuoteListWithoutSort(): void
    {
        $sortParamNames = ['name_asc', 'name_desc'];
        $sortParamLocalizedNames = ['cart_search_rest_api.sort.name_asc', 'cart_search_rest_api.sort.name_desc'];

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortParamNames')
            ->willReturn($sortParamNames);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($sortParamLocalizedNames);

        $this->quoteListTransferMock->expects(static::atLeastOnce())
            ->method('getFilterFields')
            ->willReturn(new ArrayObject($this->filterFieldTransferMocks));

        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[0]->expects(static::never())
            ->method('getValue');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('bar');

        $this->filterFieldTransferMocks[1]->expects(static::never())
            ->method('getValue');

        $this->configMock->expects(static::never())
            ->method('getSortFields');

        $restCartSearchSortTransfer = $this->restCartSearchSortMapper->fromQuoteList(
            $this->quoteListTransferMock,
        );

        static::assertEquals(null, $restCartSearchSortTransfer->getCurrentSortOrder());
        static::assertEquals(null, $restCartSearchSortTransfer->getCurrentSortParam());
        static::assertEquals($sortParamNames, $restCartSearchSortTransfer->getSortParamNames());
        static::assertEquals($sortParamLocalizedNames, $restCartSearchSortTransfer->getSortParamLocalizedNames());
    }
}
