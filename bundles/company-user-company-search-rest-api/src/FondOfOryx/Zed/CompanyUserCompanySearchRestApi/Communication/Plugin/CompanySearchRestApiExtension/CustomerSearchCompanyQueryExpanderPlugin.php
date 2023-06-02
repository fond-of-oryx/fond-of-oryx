<?php

namespace FondOfOryx\Zed\CompanyUserCompanySearchRestApi\Communication\Plugin\CompanySearchRestApiExtension;

use ArrayObject;
use FondOfOryx\Shared\CompanyUserCompanySearchRestApi\CompanyUserCompanySearchRestApiConstants;
use FondOfOryx\Zed\CompanySearchRestApiExtension\Dependency\Plugin\SearchCompanyQueryExpanderPluginInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CustomerSearchCompanyQueryExpanderPlugin extends AbstractPlugin implements SearchCompanyQueryExpanderPluginInterface
{
    /**
     * @var string
     */
    protected const REQUIRED_FILTER_FIELD_TYPE = CompanyUserCompanySearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER;

    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return bool
     */
    public function isApplicable(array $filterFieldTransfers): bool
    {
        foreach ($filterFieldTransfers as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() === static::REQUIRED_FILTER_FIELD_TYPE) {
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
    public function expand(array $filterFieldTransfers, QueryJoinCollectionTransfer $queryJoinCollectionTransfer): QueryJoinCollectionTransfer
    {
        $idCustomer = null;

        foreach ($filterFieldTransfers as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() !== static::REQUIRED_FILTER_FIELD_TYPE) {
                continue;
            }

            $idCustomer = $filterFieldTransfer->getValue();
        }

        $whereConditions = [
            (new QueryWhereConditionTransfer())
                ->setValue($idCustomer)
                ->setColumn(SpyCompanyUserTableMap::COL_FK_CUSTOMER)
                ->setComparison(Criteria::EQUAL),
            (new QueryWhereConditionTransfer())
                ->setValue('true')
                ->setColumn(SpyCompanyUserTableMap::COL_IS_ACTIVE)
                ->setComparison(Criteria::EQUAL),
        ];

        return $queryJoinCollectionTransfer->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([SpyCompanyTableMap::COL_ID_COMPANY])
                ->setRight([SpyCompanyUserTableMap::COL_FK_COMPANY])
                ->setWhereConditions(new ArrayObject($whereConditions)),
        );
    }
}
