<?php

namespace FondOfOryx\Zed\ErpOrder\Communication\Plugin\PreSave;

use Exception;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPreSavePluginInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ErpOrder\Communication\ErpOrderCommunicationFactory getFactory()
 */
class PurchaserErpOrderPreSavePlugin extends AbstractPlugin implements ErpOrderPreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function preSave(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        if (!$erpOrderTransfer->getPurchaserEmail()) {
            return $erpOrderTransfer;
        }

        try {
            $customerTransfer = (new CustomerTransfer())->setEmail($erpOrderTransfer->getPurchaserEmail());
            $customerTransfer = $this->getFactory()->getCustomerFacade()->getCustomer($customerTransfer);

            if (!$customerTransfer->getIdCustomer()) {
                return $erpOrderTransfer;
            }

            $erpOrderTransfer
                ->setPurchaserFirstName($customerTransfer->getFirstName())
                ->setPurchaserLastName($customerTransfer->getLastName());
        } catch (Exception $e) {
            /** @todo throw exception if necessary */
            return $erpOrderTransfer;
        }

        return $erpOrderTransfer;
    }
}
