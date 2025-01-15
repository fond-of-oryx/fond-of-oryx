<?php

namespace FondOfOryx\Zed\CompanyBrandsRestApi\Communication\Plugin\BrandExtension;

use Codeception\Test\Unit;
use Exception;
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
        $self = $this;

        $companyUuid = 'cb3eb2e7-3c15-438d-870f-5206d594879b';

        $this->filterFieldTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyBrandsRestApiConstants::FILTER_FIELD_TYPE_COMPANY_UUID);

        $this->filterFieldTransferMock->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($companyUuid);

        $callCount = $this->atLeastOnce();
        $this->queryJoinCollectionTransferMock->expects($callCount)
            ->method('addQueryJoin')
            ->willReturnCallback(static function (QueryJoinTransfer $queryJoinTransfer) use ($self, $callCount, $companyUuid) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertEquals([FosBrandTableMap::COL_ID_BRAND], $queryJoinTransfer->getLeft());
                        $self->assertEquals([FosBrandCompanyTableMap::COL_FK_BRAND], $queryJoinTransfer->getRight());
                        $self->assertCount(0, $queryJoinTransfer->getWhereConditions());

                        return $self->queryJoinCollectionTransferMock;
                    case 2:
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertEquals([FosBrandCompanyTableMap::COL_FK_COMPANY], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCompanyTableMap::COL_ID_COMPANY], $queryJoinTransfer->getRight());
                        $self->assertCount(1, $queryJoinTransfer->getWhereConditions());
                        $self->assertSame($companyUuid, $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getValue());
                        $self->assertSame(SpyCompanyTableMap::COL_UUID, $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getColumn());
                        $self->assertSame(Criteria::EQUAL, $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getComparison());

                        return $self->queryJoinCollectionTransferMock;
                }

                throw new Exception('Unexpected call count');
            });

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
