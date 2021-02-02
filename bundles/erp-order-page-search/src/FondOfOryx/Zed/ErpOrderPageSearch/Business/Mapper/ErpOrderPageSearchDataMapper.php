<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Model;

use FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Facade\ConditionalAvailabilityPageSearchToStoreFacadeInterface;
use Generated\Shared\Search\ConditionalAvailabilityPeriodIndexMap;

class ErpOrderPageSearchDataMapper implements ErpOrderPageSearchDataMapperInterface
{
    /**
     * ErpOrderPageSearchDataMapper constructor.
     */
    public function __construct() {

    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function mapErpOrderDataToSearchData(array $data): array
    {
        $searchData = [

        ];
        
        return $searchData;
    }
}
