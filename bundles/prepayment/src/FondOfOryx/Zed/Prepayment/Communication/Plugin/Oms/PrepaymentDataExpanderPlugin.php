<?php

namespace FondOfOryx\Zed\Prepayment\Communication\Plugin\Oms;

use ArrayObject;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\OmsExtension\Dependency\Plugin\OmsOrderMailExpanderPluginInterface;

/**
 * @method \FondOfOryx\Zed\Prepayment\PrepaymentConfig getConfig()
 * @method \FondOfOryx\Zed\Prepayment\Communication\PrepaymentCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\Prepayment\Business\PrepaymentFacadeInterface getFacade()
 */
class PrepaymentDataExpanderPlugin extends AbstractPlugin implements OmsOrderMailExpanderPluginInterface
{
    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expand(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer
    {
        $order = $mailTransfer->getOrder();
        $payments = new ArrayObject();
        foreach ($order->getPayments() as $payment) {
            $payment
                ->setIban($this->getConfig()->getIban())
                ->setBic($this->getConfig()->getBic())
                ->setBank($this->getConfig()->getBank())
                ->setAccountHolder($this->getConfig()->getAccountHolder());

            $payments->append($payment);
        }

        $order->setPayments($payments);

        return $mailTransfer->setOrder($order);
    }
}
