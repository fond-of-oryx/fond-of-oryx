<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Communication\Plugin\CartSearchRestApiExtension;

use FondOfOryx\Shared\CompanyBusinessUnitCartSearchRestApi\CompanyBusinessUnitCartSearchRestApiConstants;
use FondOfOryx\Zed\CartSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\CompanyBusinessUnitCartSearchRestApiFacadeInterface getFacade()
 */
class CompanyBusinessUnitSearchQuoteQueryExpanderPlugin extends AbstractPlugin implements SearchQuoteQueryExpanderPluginInterface
{
    /**
     * @var array<string>
     */
    protected const REQUIRED_FILTER_FIELD_TYPES = [
        CompanyBusinessUnitCartSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER,
        CompanyBusinessUnitCartSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_BUSINESS_UNIT_UUID,
    ];

    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return bool
     */
    public function isApplicable(array $filterFieldTransfers): bool
    {
        $requiredFilterFieldTypeCount = 0;

        foreach ($filterFieldTransfers as $filterFieldTransfer) {
            if (!in_array($filterFieldTransfer->getType(), static::REQUIRED_FILTER_FIELD_TYPES, true)) {
                continue;
            }

            $requiredFilterFieldTypeCount++;
        }

        return $requiredFilterFieldTypeCount === count(static::REQUIRED_FILTER_FIELD_TYPES);
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
        return $this->getFacade()->expandQueryJoinCollection($filterFieldTransfers, $queryJoinCollectionTransfer);
    }
}
