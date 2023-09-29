<?php

namespace FondOfOryx\Zed\BusinessOnBehalfCompanyUserSearchRestApi\Communication\Plugin\CompanyUserSearchRestApiExtension;

use FondOfOryx\Shared\BusinessOnBehalfCompanyUserSearchRestApi\BusinessOnBehalfCompanyUserSearchRestApiConstants;
use FondOfOryx\Zed\CompanyUserSearchRestApiExtension\Dependency\Plugin\SearchCompanyUserQueryExpanderPluginInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class BusinessOnBehalfSearchCompanyUserQueryExpanderPlugin extends AbstractPlugin implements SearchCompanyUserQueryExpanderPluginInterface
{
    /**
     * @var string
     */
    protected const REQUIRED_FILTER_FIELD_TYPE = BusinessOnBehalfCompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_IS_DEFAULT;

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
        $isDefault = null;

        foreach ($filterFieldTransfers as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() !== static::REQUIRED_FILTER_FIELD_TYPE) {
                continue;
            }

            $isDefault = $filterFieldTransfer->getValue();

            break;
        }

        if ($isDefault === null) {
            return $queryJoinCollectionTransfer;
        }

        return $queryJoinCollectionTransfer->addQueryJoin(
            (new QueryJoinTransfer())->addQueryWhereCondition(
                (new QueryWhereConditionTransfer())
                    ->setColumn(SpyCompanyUserTableMap::COL_IS_DEFAULT)
                    ->setComparison(Criteria::EQUAL)
                    ->setValue($isDefault),
            ),
        );
    }
}
