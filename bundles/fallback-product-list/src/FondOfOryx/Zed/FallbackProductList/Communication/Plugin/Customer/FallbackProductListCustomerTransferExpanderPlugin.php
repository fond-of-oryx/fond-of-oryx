<?php

namespace FondOfOryx\Zed\FallbackProductList\Communication\Plugin\Customer;

use Generated\Shared\Transfer\CustomerProductListCollectionTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Customer\Dependency\Plugin\CustomerTransferExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\FallbackProductList\FallbackProductListConfig getConfig()
 */
class FallbackProductListCustomerTransferExpanderPlugin extends AbstractPlugin implements CustomerTransferExpanderPluginInterface
{
 /**
  * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
  *
  * @return \Generated\Shared\Transfer\CustomerTransfer
  */
    public function expandTransfer(CustomerTransfer $customerTransfer): CustomerTransfer
    {
        $customerProductListCollectionTransfer = $customerTransfer->getCustomerProductListCollection();

        if ($customerProductListCollectionTransfer === null) {
            $customerProductListCollectionTransfer = (new CustomerProductListCollectionTransfer())
                ->setWhitelistIds($this->getConfig()->getFallbackWhitelistIds())
                ->setBlacklistIds($this->getConfig()->getFallbackBlacklistIds());

            return $customerTransfer->setCustomerProductListCollection($customerProductListCollectionTransfer);
        }

        if (count($customerProductListCollectionTransfer->getBlacklistIds()) === 0) {
            $customerProductListCollectionTransfer->setBlacklistIds($this->getConfig()->getFallbackBlacklistIds());
        }

        if (count($customerProductListCollectionTransfer->getWhitelistIds()) === 0) {
            $customerProductListCollectionTransfer->setWhitelistIds($this->getConfig()->getFallbackWhitelistIds());
        }

        return $customerTransfer;
    }
}
