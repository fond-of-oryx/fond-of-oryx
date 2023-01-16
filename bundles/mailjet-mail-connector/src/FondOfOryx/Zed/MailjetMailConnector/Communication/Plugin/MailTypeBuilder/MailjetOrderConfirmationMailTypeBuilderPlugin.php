<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Communication\Plugin\MailTypeBuilder;

use ArrayObject;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\MailjetTemplateTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\NullValueException;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailTypeBuilderPluginInterface;

/**
 * @method \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig getConfig()
 * @method \FondOfOryx\Zed\MailjetMailConnector\Communication\MailjetMailConnectorCommunicationFactory getFactory()()
 */
class MailjetOrderConfirmationMailTypeBuilderPlugin extends AbstractPlugin implements MailTypeBuilderPluginInterface
{
    /**
     * @var string
     */
    public const MAIL_TYPE = 'order confirmation mail';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return static::MAIL_TYPE;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function build(MailTransfer $mailTransfer): MailTransfer
    {
        $mailjetTemplateTransfer = (new MailjetTemplateTransfer())
            ->setSubject('mail.order_confirmation.subject')
            ->setTemplateId($this->getTemplateId($mailTransfer));

        return $mailTransfer->setMailjetTemplate(
            $this->setVariables($mailTransfer, $mailjetTemplateTransfer),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return int
     */
    protected function getTemplateId(MailTransfer $mailTransfer): int
    {
        $locale = $mailTransfer->getLocaleOrFail()->getLocaleName();

        return $this->getConfig()->getOrderConfirmationEmailTemplateIdByLocale($locale);
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\MailjetTemplateTransfer $mailjetTemplateTransfer
     *
     * @return \Generated\Shared\Transfer\MailjetTemplateTransfer
     */
    protected function setVariables(
        MailTransfer $mailTransfer,
        MailjetTemplateTransfer $mailjetTemplateTransfer
    ): MailjetTemplateTransfer {
        $orderTransfer = $mailTransfer->getOrderOrFail();

        $mailjetTemplateTransfer = $this->setItems($mailjetTemplateTransfer, $orderTransfer->getItems());
        $mailjetTemplateTransfer = $this->setPayments($mailjetTemplateTransfer, $orderTransfer->getPayments());

        return $mailjetTemplateTransfer->setVariables([
            'reference' => $orderTransfer->getOrderReference(),
            'billingAddress' => $orderTransfer->getBillingAddress()->toArray(),
            'shippingAddress' => $this->getShippingAddress($orderTransfer)->toArray(),
            'totals' => $orderTransfer->getTotals()->toArray(),
            'voucherDiscount' => $this->transferCollectionToArray($orderTransfer->getVoucherDiscounts()),
        ]);
    }

    /**
     * @param \Generated\Shared\Transfer\MailjetTemplateTransfer $mailjetTemplateTransfer
     * @param \ArrayObject $itemTransferCollection
     *
     * @return \Generated\Shared\Transfer\MailjetTemplateTransfer
     */
    protected function setItems(
        MailjetTemplateTransfer $mailjetTemplateTransfer,
        ArrayObject $itemTransferCollection
    ): MailjetTemplateTransfer {
        return $mailjetTemplateTransfer->addVariables([
            'items' => $this->getFactory()
                ->createMailjetTemplateVariablesItemMapper()
                ->transferCollectionToArray($itemTransferCollection),
        ]);
    }

    /**
     * @param \Generated\Shared\Transfer\MailjetTemplateTransfer $mailjetTemplateTransfer
     * @param \ArrayObject $paymentTransferCollection
     *
     * @return \Generated\Shared\Transfer\MailjetTemplateTransfer
     */
    protected function setPayments(
        MailjetTemplateTransfer $mailjetTemplateTransfer,
        ArrayObject $paymentTransferCollection
    ): MailjetTemplateTransfer {
        return $mailjetTemplateTransfer->addVariables([
            'payments' => $this->getFactory()
                ->createMailjetTemplateVariablesPaymentMapper()
                ->transferCollectionToArray($paymentTransferCollection),
        ]);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    protected function getShippingAddress(OrderTransfer $orderTransfer): AddressTransfer
    {
        foreach ($orderTransfer->getItems() as $itemTransfer) {
            if ($itemTransfer->getShipment()->getShippingAddress() === null) {
                continue;
            }

            return $itemTransfer->getShipment()->getShippingAddress();
        }

        throw new NullValueException('no shipping found');
    }

    /**
     * @param \ArrayObject<\Spryker\Shared\Kernel\Transfer\AbstractTransfer> $arrayObjects
     *
     * @return array
     */
    protected function transferCollectionToArray(ArrayObject $arrayObjects): array
    {
        $array = [];

        foreach ($arrayObjects as $transfer) {
            $array[] = $transfer->toArray();
        }

        return $array;
    }
}
