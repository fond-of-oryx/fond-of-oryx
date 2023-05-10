<?php

namespace FondOfOryx\Zed\CompanyUserOrderBudgetSearchRestApi\Communication\Plugin\OrderBudgetSearchRestApiExtension;

use FondOfOryx\Shared\CompanyUserOrderBudgetSearchRestApi\CompanyUserOrderBudgetSearchRestApiConstants;
use FondOfOryx\Zed\OrderBudgetSearchRestApiExtension\Dependency\Plugin\SearchOrderBudgetQueryExpanderPluginInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\OrderBudget\Persistence\Map\FooOrderBudgetTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CompanyUserSearchOrderBudgetQueryExpanderPlugin extends AbstractPlugin implements SearchOrderBudgetQueryExpanderPluginInterface
{
    /**
     * @var array<string>
     */
    protected const REQUIRED_FILTER_FIELD_TYPES = [
        CompanyUserOrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_USER_REFERENCE,
        CompanyUserOrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER,
    ];

    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return bool
     */
    public function isApplicable(array $filterFieldTransfers): bool
    {
        $foundFilterFieldTypes = [];

        foreach ($filterFieldTransfers as $filterFieldTransfer) {
            if (!in_array($filterFieldTransfer->getType(), static::REQUIRED_FILTER_FIELD_TYPES, true)) {
                continue;
            }

            $foundFilterFieldTypes[$filterFieldTransfer->getType()] = $filterFieldTransfer;

            if (count($foundFilterFieldTypes) === 2) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\QueryJoinCollectionTransfer
     */
    public function expand(
        array $filterFieldTransfers,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): QueryJoinCollectionTransfer {
        $filterFieldValues = [];

        foreach ($filterFieldTransfers as $filterFieldTransfer) {
            if (!in_array($filterFieldTransfer->getType(), static::REQUIRED_FILTER_FIELD_TYPES, true)) {
                continue;
            }

            $filterFieldValues[$filterFieldTransfer->getType()] = $filterFieldTransfer->getValue();

            if (count($filterFieldValues) === 2) {
                break;
            }
        }

        return $queryJoinCollectionTransfer->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([FooOrderBudgetTableMap::COL_ID_ORDER_BUDGET])
                ->setRight([SpyCompanyBusinessUnitTableMap::COL_FK_ORDER_BUDGET]),
        )->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT])
                ->setRight([SpyCompanyUserTableMap::COL_FK_COMPANY_BUSINESS_UNIT])
                ->addQueryWhereCondition(
                    (new QueryWhereConditionTransfer())
                        ->setValue($filterFieldValues[CompanyUserOrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_USER_REFERENCE])
                        ->setColumn(SpyCompanyUserTableMap::COL_COMPANY_USER_REFERENCE)
                        ->setComparison(Criteria::EQUAL),
                ),
        )->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([SpyCompanyUserTableMap::COL_FK_CUSTOMER])
                ->setRight([SpyCustomerTableMap::COL_ID_CUSTOMER])
                ->addQueryWhereCondition(
                    (new QueryWhereConditionTransfer())
                        ->setValue($filterFieldValues[CompanyUserOrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER])
                        ->setColumn(SpyCustomerTableMap::COL_ID_CUSTOMER)
                        ->setComparison(Criteria::EQUAL),
                ),
        );
    }
}
