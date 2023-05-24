<?php

namespace FondOfOryx\Zed\CompanyTypeCompanyUserSearchRestApi\Communication\Plugin\CompanyUserSearchRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Shared\CompanyTypeCompanyUserSearchRestApi\CompanyTypeCompanyUserSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\CompanyType\Persistence\Map\FosCompanyTypeTableMap;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use PHPUnit\Framework\MockObject\MockObject;
use Propel\Runtime\ActiveQuery\Criteria;

class CompanyTypeSearchCompanyUserQueryExpanderPluginTest extends Unit
{
    /**
     * @var array<(\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var (\Generated\Shared\Transfer\QueryJoinCollectionTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

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

        $this->plugin = new CompanyTypeSearchCompanyUserQueryExpanderPlugin();
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
            ->willReturn(CompanyTypeCompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_TYPE);

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
        $companyType = 'manufacturer';

        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyTypeCompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_TYPE);

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($companyType);

        $this->queryJoinCollectionTransferMock->expects(static::atLeastOnce())
            ->method('addQueryJoin')
            ->withConsecutive([
                static::callback(
                    static fn (
                        QueryJoinTransfer $queryJoinTransfer
                    ) => $queryJoinTransfer->getLeft() == [SpyCompanyUserTableMap::COL_FK_COMPANY]
                            && $queryJoinTransfer->getRight() == [SpyCompanyTableMap::COL_ID_COMPANY]
                            && $queryJoinTransfer->getJoinType() === Criteria::INNER_JOIN
                            && $queryJoinTransfer->getWhereConditions()->count() === 0
                ),
            ], [
                static::callback(
                    fn (
                        QueryJoinTransfer $queryJoinTransfer
                    ) => $queryJoinTransfer->getLeft() == [SpyCompanyTableMap::COL_FK_COMPANY_TYPE]
                        && $queryJoinTransfer->getRight() == [FosCompanyTypeTableMap::COL_ID_COMPANY_TYPE]
                        && $queryJoinTransfer->getJoinType() === Criteria::INNER_JOIN
                        && $queryJoinTransfer->getWhereConditions()->count() === 1
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getColumn() === FosCompanyTypeTableMap::COL_NAME
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getComparison() === Criteria::EQUAL
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getValue() === $companyType
                ),
            ])->willReturn($this->queryJoinCollectionTransferMock);

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->plugin->expand(
                $this->filterFieldTransferMocks,
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }
}
