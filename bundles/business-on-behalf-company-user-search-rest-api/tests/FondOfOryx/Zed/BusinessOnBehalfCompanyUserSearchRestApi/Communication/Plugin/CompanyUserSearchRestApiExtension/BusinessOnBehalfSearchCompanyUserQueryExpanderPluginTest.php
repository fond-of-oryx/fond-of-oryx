<?php

namespace FondOfOryx\Zed\BusinessOnBehalfCompanyUserSearchRestApi\Communication\Plugin\CompanyUserSearchRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Shared\BusinessOnBehalfCompanyUserSearchRestApi\BusinessOnBehalfCompanyUserSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use PHPUnit\Framework\MockObject\MockObject;
use Propel\Runtime\ActiveQuery\Criteria;

class BusinessOnBehalfSearchCompanyUserQueryExpanderPluginTest extends Unit
{
    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\QueryJoinCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfCompanyUserSearchRestApi\Communication\Plugin\CompanyUserSearchRestApiExtension\BusinessOnBehalfSearchCompanyUserQueryExpanderPlugin
     */
    protected BusinessOnBehalfSearchCompanyUserQueryExpanderPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->queryJoinCollectionTransferMock = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new BusinessOnBehalfSearchCompanyUserQueryExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testIsApplicable(): void
    {
        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(BusinessOnBehalfCompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_IS_DEFAULT);

        static::assertTrue($this->plugin->isApplicable($this->filterFieldTransferMocks));
    }

    /**
     * @return void
     */
    public function testIsApplicableWithInvalidFilterFieldTypes(): void
    {
        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('bar');

        static::assertFalse($this->plugin->isApplicable($this->filterFieldTransferMocks));
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $isDefault = 'true';

        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(BusinessOnBehalfCompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_IS_DEFAULT);

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($isDefault);

        $this->queryJoinCollectionTransferMock->expects(static::atLeastOnce())
            ->method('addQueryJoin')
            ->with(
                static::callback(
                    fn (
                        QueryJoinTransfer $queryJoinTransfer
                    ) => $queryJoinTransfer->getWhereConditions()->count() === 1
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getColumn() === SpyCompanyUserTableMap::COL_IS_DEFAULT
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getComparison() === Criteria::EQUAL
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getValue() === $isDefault,
                ),
            )->willReturn($this->queryJoinCollectionTransferMock);

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->plugin->expand(
                $this->filterFieldTransferMocks,
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }
}
