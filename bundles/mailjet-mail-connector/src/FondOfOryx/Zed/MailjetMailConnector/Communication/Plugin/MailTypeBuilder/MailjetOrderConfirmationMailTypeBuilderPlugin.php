<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Communication\Plugin\MailTypeBuilder;

use ArrayObject;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\MailjetTemplateTransfer;
use Generated\Shared\Transfer\MailTransfer;
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
     * @var string
     */
    public const REFERENCE = 'reference';

    /**
     * @var string
     */
    public const BILLING_ADDRESS = 'billingAddress';

    /**
     * @var string
     */
    public const SHIPPING_ADDRESS = 'shippingAddress';

    /**
     * @var string
     */
    public const TOTALS = 'totals';

    /**
     * @var string
     */
    public const ITEMS = 'items';

    /**
     * @var string
     */
    public const PAYMENTS = 'payments';

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

        return $mailjetTemplateTransfer->setVariables([
            static::REFERENCE => $orderTransfer->getOrderReference(),
            static::BILLING_ADDRESS => $this->getMappedBillingAddress($orderTransfer->getBillingAddress()),
            static::SHIPPING_ADDRESS => $this->getMappedShippingAddressFromItems($orderTransfer->getItems()),
            static::TOTALS => $orderTransfer->getTotals()->toArray(),
            //'voucherDiscount' => $this->transferCollectionToArray($orderTransfer->getVoucherDiscounts()),
            static::ITEMS => $this->getMappedItems($orderTransfer->getItems()),
            static::PAYMENTS => $this->getMappedPayments($orderTransfer->getPayments()),
        ]);
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return array<string, string>
     */
    protected function getMappedBillingAddress(AddressTransfer $addressTransfer): array
    {
        return $this->getFactory()
            ->createMailjetRequestAddressMapper()
            ->map($addressTransfer);
    }

    /**
     * @param \ArrayObject $itemTransfers
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return array<string, string>
     */
    protected function getMappedShippingAddressFromItems(ArrayObject $itemTransfers): array
    {
        foreach ($itemTransfers as $itemTransfer) {
            if ($itemTransfer->getShipment()->getShippingAddress() === null) {
                continue;
            }

            return $this->getFactory()
                ->createMailjetRequestAddressMapper()
                ->map($itemTransfer->getShipment()->getShippingAddress());
        }

        throw new NullValueException('no shipping found');
    }

    /**
     * @param \ArrayObject $itemTransferCollection
     *
     * @return array<string, mixed>
     */
    protected function getMappedItems(ArrayObject $itemTransferCollection): array
    {
        return $this->getFactory()
                ->createMailjetTemplateVariablesItemsMapper()
                ->map($itemTransferCollection);
    }

    /**
     * @param \ArrayObject $paymentTransferCollection
     *
     * @return array<string, mixed>
     */
    protected function getMappedPayments(ArrayObject $paymentTransferCollection): array
    {
        return $this->getFactory()
                ->createMailjetTemplateVariablesPaymentsMapper()
                ->map($paymentTransferCollection);
    }
}
