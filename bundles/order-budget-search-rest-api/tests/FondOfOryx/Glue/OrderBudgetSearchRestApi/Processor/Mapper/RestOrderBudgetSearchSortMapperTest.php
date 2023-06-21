<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig;
use FondOfOryx\Shared\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RestOrderBudgetSearchSortMapperTest extends Unit
{
    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetSearchRestApiConfig|MockObject $configMock;

    /**
     * @var (\Generated\Shared\Transfer\OrderBudgetListTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetListTransfer|MockObject $orderBudgetListTransferMock;

    /**
     * @var array<(\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchSortMapper
     */
    protected RestOrderBudgetSearchSortMapper $restOrderBudgetSearchSortMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(OrderBudgetSearchRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetListTransferMock = $this->getMockBuilder(OrderBudgetListTransfer::class)
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

        $this->restOrderBudgetSearchSortMapper = new RestOrderBudgetSearchSortMapper($this->configMock);
    }

    /**
     * @return void
     */
    public function testFromOrderBudgetList(): void
    {
        $sortParamNames = ['name_asc', 'name_desc'];
        $sortParamLocalizedNames = ['order_budget_search_rest_api.sort.name_asc', 'order_budget_search_rest_api.sort.name_desc'];
        $sortFields = ['name'];

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortParamNames')
            ->willReturn($sortParamNames);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($sortParamLocalizedNames);

        $this->orderBudgetListTransferMock->expects(static::atLeastOnce())
            ->method('getFilterFields')
            ->willReturn(new ArrayObject($this->filterFieldTransferMocks));

        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[0]->expects(static::never())
            ->method('getValue');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(OrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_ORDER_BY);

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn('name::asc');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortFields')
            ->willReturn($sortFields);

        $restOrderBudgetSearchSortTransfer = $this->restOrderBudgetSearchSortMapper->fromOrderBudgetList(
            $this->orderBudgetListTransferMock,
        );

        static::assertEquals('asc', $restOrderBudgetSearchSortTransfer->getCurrentSortOrder());
        static::assertEquals($sortParamNames[0], $restOrderBudgetSearchSortTransfer->getCurrentSortParam());
        static::assertEquals($sortParamNames, $restOrderBudgetSearchSortTransfer->getSortParamNames());
        static::assertEquals($sortParamLocalizedNames, $restOrderBudgetSearchSortTransfer->getSortParamLocalizedNames());
    }

    /**
     * @return void
     */
    public function testFromOrderBudgetListWithoutSort(): void
    {
        $sortParamNames = ['name_asc', 'name_desc'];
        $sortParamLocalizedNames = ['order_budget_search_rest_api.sort.name_asc', 'order_budget_search_rest_api.sort.name_desc'];

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortParamNames')
            ->willReturn($sortParamNames);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($sortParamLocalizedNames);

        $this->orderBudgetListTransferMock->expects(static::atLeastOnce())
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

        $restOrderBudgetSearchSortTransfer = $this->restOrderBudgetSearchSortMapper->fromOrderBudgetList(
            $this->orderBudgetListTransferMock,
        );

        static::assertEquals(null, $restOrderBudgetSearchSortTransfer->getCurrentSortOrder());
        static::assertEquals(null, $restOrderBudgetSearchSortTransfer->getCurrentSortParam());
        static::assertEquals($sortParamNames, $restOrderBudgetSearchSortTransfer->getSortParamNames());
        static::assertEquals($sortParamLocalizedNames, $restOrderBudgetSearchSortTransfer->getSortParamLocalizedNames());
    }
}
