<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model\Notification;

use FondOfOryx\Zed\AvailabilityAlert\Communication\Plugin\Mail\AvailabilityAlertMailTypePlugin;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToMailInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\MailTransfer;

class MailNotificationHandler
{
    /**
     * @var string
     */
    protected $baseUrlSslYves;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToMailInterface
     */
    protected $mailFacade;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductInterface
     */
    protected $productFacade;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToMailInterface $mailFacade
     * @param \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductInterface $productFacade
     * @param string $baseUrlSslYves
     */
    public function __construct(
        AvailabilityAlertToMailInterface $mailFacade,
        AvailabilityAlertToProductInterface $productFacade,
        string $baseUrlSslYves
    ) {
        $this->baseUrlSslYves = $baseUrlSslYves;
        $this->mailFacade = $mailFacade;
        $this->productFacade = $productFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function notify(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void
    {
        $productAbstractTransfer = $availabilityAlertSubscriptionTransfer->getProductAbstract();
        $productUrlTransfer = $this->productFacade->getProductUrl($productAbstractTransfer);
        $priceProductTransfer = $productAbstractTransfer->getPrices();
        $currentLocaleProductUrlTransfer = null;
        $moneyValueTransfer = null;

        /** @var \Generated\Shared\Transfer\LocalizedUrlTransfer $localizedUrlTransfer */
        foreach ($productUrlTransfer->getUrls() as $localizedUrlTransfer) {
            if ($localizedUrlTransfer->getLocale()->getIdLocale() == $availabilityAlertSubscriptionTransfer->getFkLocale()) {
                $currentLocaleProductUrlTransfer = $localizedUrlTransfer;

                break;
            }
        }

        /** @var \Generated\Shared\Transfer\PriceProductTransfer $transfer */
        foreach ($priceProductTransfer as $transfer) {
            /** @var \Generated\Shared\Transfer\MoneyValueTransfer $moneyValueTransfer */
            $moneyValueTransfer = $transfer->getMoneyValue();

            break;
        }

        $mailTransfer = new MailTransfer();
        $mailTransfer->setAvailabilityAlertSubscription($availabilityAlertSubscriptionTransfer);
        $mailTransfer->setLocale($availabilityAlertSubscriptionTransfer->getLocale());
        $mailTransfer->setProductAbstract($productAbstractTransfer);
        $mailTransfer->setType(AvailabilityAlertMailTypePlugin::MAIL_TYPE);
        $mailTransfer->setLocalizedUrl($currentLocaleProductUrlTransfer);
        $mailTransfer->setMoneyValue($moneyValueTransfer);
        $mailTransfer->setBaseUrlSslYves($this->baseUrlSslYves);

        $this->mailFacade->handleMail($mailTransfer);
    }
}
