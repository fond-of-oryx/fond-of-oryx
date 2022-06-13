<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Expander;

use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Reader\CompanyBusinessUnitReaderInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\Quote\Persistence\Map\SpyQuoteTableMap;
use Propel\Runtime\ActiveQuery\Criteria;

class QueryJoinCollectionExpander implements QueryJoinCollectionExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Reader\CompanyBusinessUnitReaderInterface
     */
    protected $companyBusinessUnitReader;

    /**
     * @param \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Reader\CompanyBusinessUnitReaderInterface $companyBusinessUnitReader
     */
    public function __construct(CompanyBusinessUnitReaderInterface $companyBusinessUnitReader)
    {
        $this->companyBusinessUnitReader = $companyBusinessUnitReader;
    }

    /**
     * @param array $filterFieldTransfers
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\QueryJoinCollectionTransfer
     */
    public function expand(
        array $filterFieldTransfers,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): QueryJoinCollectionTransfer {
        $idCompanyBusinessUnit = $this->companyBusinessUnitReader->getIdByFilterFields($filterFieldTransfers);

        if ($idCompanyBusinessUnit === null) {
            $idCompanyBusinessUnit = -1;
        }

        $whereCondition = (new QueryWhereConditionTransfer())
            ->setValue((string)$idCompanyBusinessUnit)
            ->setColumn(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT)
            ->setComparison(Criteria::EQUAL);

        return $queryJoinCollectionTransfer->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([SpyQuoteTableMap::COL_CUSTOMER_REFERENCE])
                ->setRight([SpyCustomerTableMap::COL_CUSTOMER_REFERENCE]),
        )->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([SpyCompanyUserTableMap::COL_FK_COMPANY])
                ->setRight([SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY])
                ->addQueryWhereCondition($whereCondition),
        )->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY])
                ->setRight([SpyCompanyTableMap::COL_ID_COMPANY]),
        );
    }
}
