<?php

namespace FondOfOryx\Zed\CompanyBrandsRestApi\Communication\Plugin\BrandExtension;

use Codeception\Test\Unit;
use FondOfOryx\Shared\CompanyBrandsRestApi\CompanyBrandsRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Orm\Zed\Brand\Persistence\Map\FosBrandTableMap;
use Orm\Zed\BrandCompany\Persistence\Map\FosBrandCompanyTableMap;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Propel\Runtime\ActiveQuery\Criteria;

class CompanySearchBrandQueryExpanderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $filterFieldTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QueryJoinCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $queryJoinCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBrandsRestApi\Communication\Plugin\BrandExtension\CompanySearchBrandQueryExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->filterFieldTransferMock = $this->getMockBuilder(FilterFieldTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryJoinCollectionTransferMock = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanySearchBrandQueryExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testIsApplicableWithoutAnyEntry(): void
    {
        static::assertFalse($this->plugin->isApplicable([]));
    }

    /**
     * @return void
     */
    public function testIsApplicable(): void
    {
        $this->filterFieldTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyBrandsRestApiConstants::FILTER_FIELD_TYPE_COMPANY_UUID);

        static::assertTrue($this->plugin->isApplicable([$this->filterFieldTransferMock]));
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $companyUuid = 'cb3eb2e7-3c15-438d-870f-5206d594879b';

        $this->filterFieldTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyBrandsRestApiConstants::FILTER_FIELD_TYPE_COMPANY_UUID);

        $this->filterFieldTransferMock->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($companyUuid);

        $this->queryJoinCollectionTransferMock->expects(static::atLeastOnce())
            ->method('addQueryJoin')
            ->withConsecutive(
                [
                    static::callback(
                        static function (QueryJoinTransfer $queryJoinTransfer) {
                            return $queryJoinTransfer->getJoinType() === Criteria::INNER_JOIN
                                && $queryJoinTransfer->getLeft() == [FosBrandTableMap::COL_ID_BRAND]
                                && $queryJoinTransfer->getRight() == [FosBrandCompanyTableMap::COL_FK_BRAND]
                                && $queryJoinTransfer->getWhereConditions()->count() === 0;
                        },
                    ),
                ],
                [
                    static::callback(
                        static function (QueryJoinTransfer $queryJoinTransfer) use ($companyUuid) {
                            return $queryJoinTransfer->getJoinType() === Criteria::INNER_JOIN
                                && $queryJoinTransfer->getLeft() == [FosBrandCompanyTableMap::COL_FK_COMPANY]
                                && $queryJoinTransfer->getRight() == [SpyCompanyTableMap::COL_ID_COMPANY]
                                && $queryJoinTransfer->getWhereConditions()->count() === 1
                                && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getValue() === $companyUuid
                                && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getColumn() === SpyCompanyTableMap::COL_UUID
                                && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getComparison() === Criteria::EQUAL;
                        },
                    ),
                ],
            )->willReturn($this->queryJoinCollectionTransferMock);

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->plugin->expand(
                [$this->filterFieldTransferMock],
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithEmptyFilterField(): void
    {
        $this->queryJoinCollectionTransferMock->expects(static::never())
            ->method('addQueryJoin');

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->plugin->expand(
                [],
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithUnexpectedFilterFields(): void
    {
        $this->filterFieldTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMock->expects(static::never())
            ->method('getValue');

        $this->queryJoinCollectionTransferMock->expects(static::never())
            ->method('addQueryJoin');

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->plugin->expand(
                [$this->filterFieldTransferMock],
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }
}
