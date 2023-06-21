<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Communication\Plugin\ProductListSearchRestApiExtension;

use FondOfOryx\Zed\ProductListSearchRestApiExtension\Dependency\Plugin\SearchProductListQueryExpanderPluginInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\CompanyProductListSearchRestApiFacadeInterface getFacade()
 */
class CompanySearchProductListQueryExpanderPlugin extends AbstractPlugin implements SearchProductListQueryExpanderPluginInterface
{
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
        return $this->getFacade()->expandSearchProductListQuery(
            $filterFieldTransfers,
            $queryJoinCollectionTransfer,
        );
    }
}
