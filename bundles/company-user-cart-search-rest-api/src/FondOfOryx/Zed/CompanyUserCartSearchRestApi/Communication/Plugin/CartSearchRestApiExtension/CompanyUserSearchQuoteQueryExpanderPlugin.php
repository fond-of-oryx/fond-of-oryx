<?php

namespace FondOfOryx\Zed\CompanyUserCartSearchRestApi\Communication\Plugin\CartSearchRestApiExtension;

use FondOfOryx\Shared\CompanyUserCartSearchRestApi\CompanyUserCartSearchRestApiConstants;
use FondOfOryx\Zed\CartSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\Quote\Persistence\Map\SpyQuoteTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CompanyUserSearchQuoteQueryExpanderPlugin extends AbstractPlugin implements SearchQuoteQueryExpanderPluginInterface
{
    /**
     * @var string
     */
    protected const REQUIRED_FILTER_FIELD_TYPE = CompanyUserCartSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_USER_REFERENCE;

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
        $companyUserReference = null;

        foreach ($filterFieldTransfers as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() !== static::REQUIRED_FILTER_FIELD_TYPE) {
                continue;
            }

            $companyUserReference = $filterFieldTransfer->getValue();

            break;
        }

        if ($companyUserReference === null) {
            return $queryJoinCollectionTransfer;
        }

        return $queryJoinCollectionTransfer->addQueryJoin(
            (new QueryJoinTransfer())->addQueryWhereCondition(
                (new QueryWhereConditionTransfer())
                    ->setColumn(SpyQuoteTableMap::COL_COMPANY_USER_REFERENCE)
                    ->setComparison(Criteria::EQUAL)
                    ->setValue($companyUserReference),
            ),
        );
    }
}
