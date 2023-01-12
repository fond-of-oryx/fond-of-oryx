<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Communication\Plugin\MailTypeBuilder;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\MailjetClientRequestEmailTransfer;
use Generated\Shared\Transfer\MailjetClientRequestTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\NullValueException;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailTypeBuilderPluginInterface;

/**
 * @method \FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorConfig getConfig()
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
        $mailjetClientRequestTransfer = (new MailjetClientRequestTransfer())
            ->setFrom($this->getFrom())
            ->setTo($this->getRecipient($mailTransfer))
            ->setSubject('mail.order_confirmation.subject')
            ->setTemplateId($this->getTemplateId($mailTransfer));

        return $mailTransfer->setMailjetOrFail(
            $this->setVariables($mailTransfer, $mailjetClientRequestTransfer),
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
     * @return \Generated\Shared\Transfer\MailjetClientRequestEmailTransfer
     */
    protected function getFrom(): MailjetClientRequestEmailTransfer
    {
        return (new MailjetClientRequestEmailTransfer())
            ->setName($this->getConfig()->getFromName())
            ->setEmail($this->getConfig()->getFromEmail());
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return \Generated\Shared\Transfer\MailjetClientRequestEmailTransfer
     */
    protected function getRecipient(MailTransfer $mailTransfer): MailjetClientRequestEmailTransfer
    {
        $orderTransfer = $mailTransfer->getOrderOrFail();

        $name = sprintf(
            '%s %s',
            $orderTransfer->getCustomer()->getFirstName(),
            $orderTransfer->getCustomer()->getLastName(),
        );

        return (new MailjetClientRequestEmailTransfer())
            ->setName($name)
            ->setEmail($orderTransfer->getCustomer()->getEmail());
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\MailjetClientRequestTransfer $mailjetClientRequestTransfer
     *
     * @return \Generated\Shared\Transfer\MailjetClientRequestTransfer
     */
    protected function setVariables(
        MailTransfer $mailTransfer,
        MailjetClientRequestTransfer $mailjetClientRequestTransfer
    ): MailjetClientRequestTransfer {
        $orderTransfer = $mailTransfer->getOrderOrFail();

        return $mailjetClientRequestTransfer->setVariables([
            'billingAddress' => $orderTransfer->getBillingAddress()->toArray(),
            'shippingAddress' => $this->getShippingAddress($orderTransfer)->toArray(),
            'items' => $this->getItems($orderTransfer),
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
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return array
     */
    protected function getItems(OrderTransfer $orderTransfer): array
    {
        $items = [];

        foreach ($orderTransfer->getItems() as $itemTransfer) {
            $items[] = $itemTransfer->toArray();
        }

        return $items;
    }
}
