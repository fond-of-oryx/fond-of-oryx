<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business;

use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business\JellyfishSalesOrderNoPaymentGiftCardConnectorBusinessFactory getFactory()
 */
class JellyfishSalesOrderNoPaymentGiftCardConnectorFacade extends AbstractFacade implements JellyfishSalesOrderNoPaymentGiftCardConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return bool
     */
    public function isOnlyGiftCardPayment(JellyfishOrderTransfer $jellyfishOrderTransfer): bool
    {
        return $this->getFactory()->createOnlyeGiftCardPaymentValidator()->isOnlyGiftCardPayment($jellyfishOrderTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param int $idSalesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function calculateProportionalGiftCardValues(JellyfishOrderTransfer $jellyfishOrderTransfer, int $idSalesOrder): JellyfishOrderTransfer
    {
        return $this->getFactory()->createProportionalGiftCardValueCalculator()->calculate($jellyfishOrderTransfer, $idSalesOrder);
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return void
     */
    public function persistProportionalCouponValues(
        JellyfishOrderTransfer $jellyfishOrderTransfer
    ): void {
        $this->getFactory()->createProportionalGiftCardValueManager()->persistProportionalGiftCardValuesFromExport($jellyfishOrderTransfer);
    }
}
