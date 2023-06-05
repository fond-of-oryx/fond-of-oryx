<?php

namespace FondOfOryx\Zed\CompanyTypeCompanySearchRestApi\Communication\Plugin\CompanySearchRestApiExtension;

use FondOfOryx\Shared\CompanyTypeCompanySearchRestApi\CompanyTypeCompanySearchRestApiConstants;
use FondOfOryx\Zed\CompanySearchRestApiExtension\Dependency\Plugin\SearchCompanyQueryExpanderPluginInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\CompanyType\Persistence\Map\FosCompanyTypeTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CompanyTypeSearchCompanyQueryExpanderPlugin extends AbstractPlugin implements SearchCompanyQueryExpanderPluginInterface
{
    /**
     * @var string
     */
    protected const REQUIRED_FILTER_FIELD_TYPE = CompanyTypeCompanySearchRestApiConstants::FILTER_FIELD_TYPE_TYPE;

    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return bool
     */
    public function isApplicable(array $filterFieldTransfers): bool
    {
        foreach ($filterFieldTransfers as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() !== static::REQUIRED_FILTER_FIELD_TYPE) {
                continue;
            }

            return true;
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
        $type = null;

        foreach ($filterFieldTransfers as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() !== static::REQUIRED_FILTER_FIELD_TYPE) {
                continue;
            }

            $type = $filterFieldTransfer->getValue();

            break;
        }

        if ($type === null) {
            return $queryJoinCollectionTransfer;
        }

        return $queryJoinCollectionTransfer->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([SpyCompanyTableMap::COL_FK_COMPANY_TYPE])
                ->setRight([FosCompanyTypeTableMap::COL_ID_COMPANY_TYPE])
                ->addQueryWhereCondition(
                    (new QueryWhereConditionTransfer())
                        ->setColumn(FosCompanyTypeTableMap::COL_NAME)
                        ->setComparison(Criteria::EQUAL)
                        ->setValue($type),
                ),
        );
    }
}
