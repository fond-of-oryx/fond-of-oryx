<?php

namespace FondOfOryx\Zed\CompanyTypeCompanyUserSearchRestApi\Communication\Plugin\CompanyUserSearchRestApiExtension;

use FondOfOryx\Shared\CompanyTypeCompanyUserSearchRestApi\CompanyTypeCompanyUserSearchRestApiConstants;
use FondOfOryx\Zed\CompanyUserSearchRestApiExtension\Dependency\Plugin\SearchCompanyUserQueryExpanderPluginInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\CompanyType\Persistence\Map\FoiCompanyTypeTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CompanyTypeSearchCompanyUserQueryExpanderPlugin extends AbstractPlugin implements SearchCompanyUserQueryExpanderPluginInterface
{
    /**
     * @var string
     */
    protected const REQUIRED_FILTER_FIELD_TYPE = CompanyTypeCompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_TYPE;

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
        $companyType = null;

        foreach ($filterFieldTransfers as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() !== static::REQUIRED_FILTER_FIELD_TYPE) {
                continue;
            }

            $companyType = $filterFieldTransfer->getValue();

            break;
        }

        if ($companyType === null) {
            return $queryJoinCollectionTransfer;
        }

        return $queryJoinCollectionTransfer->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([SpyCompanyTableMap::COL_FK_COMPANY_TYPE])
                ->setRight([FoiCompanyTypeTableMap::COL_ID_COMPANY_TYPE])
                ->addQueryWhereCondition(
                    (new QueryWhereConditionTransfer())
                        ->setColumn(FoiCompanyTypeTableMap::COL_NAME)
                        ->setComparison(Criteria::EQUAL)
                        ->setValue($companyType),
                ),
        );
    }
}
