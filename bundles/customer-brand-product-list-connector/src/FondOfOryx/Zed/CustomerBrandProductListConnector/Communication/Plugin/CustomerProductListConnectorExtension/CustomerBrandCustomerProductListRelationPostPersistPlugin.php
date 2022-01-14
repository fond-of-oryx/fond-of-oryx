<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Communication\Plugin\CustomerProductListConnectorExtension;

use FondOfOryx\Zed\CustomerProductListConnectorExtension\Dependency\Plugin\CustomerProductListRelationPostPersistPluginInterface;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CustomerBrandProductListConnector\Business\CustomerBrandProductListConnectorFacadeInterface getFacade()
 */
class CustomerBrandCustomerProductListRelationPostPersistPlugin extends AbstractPlugin implements CustomerProductListRelationPostPersistPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerProductListRelationTransfer $customerProductListRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerProductListRelationTransfer
     */
    public function postPersist(
        CustomerProductListRelationTransfer $customerProductListRelationTransfer
    ): CustomerProductListRelationTransfer {
        $this->getFacade()
            ->persistCustomerBrandRelationByCustomerProductListRelation($customerProductListRelationTransfer);

        return $customerProductListRelationTransfer;
    }
}
