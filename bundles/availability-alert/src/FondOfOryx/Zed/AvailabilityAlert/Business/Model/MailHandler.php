<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model;

use FondOfOryx\Zed\AvailabilityAlert\Communication\Plugin\Mail\AvailabilityAlertMailTypePlugin;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToMailInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription;

class MailHandler
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
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription
     *
     * @return void
     */
    public function sendAvailabilityAlertMail(FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription)
    {
        $availabilityAlertSubscriptionTransfer = $this->getAvailabilityAlertSubscriptionTransfer($fosAvailabilityAlertSubscription);
        $localeTransfer = $this->getLocaleTransfer($fosAvailabilityAlertSubscription);
        $productAbstractTransfer = $this->getProductAbstractTransfer($fosAvailabilityAlertSubscription);
        $productUrlTransfer = $this->productFacade->getProductUrl($productAbstractTransfer);
        $priceProductTransfer = $productAbstractTransfer->getPrices();
        $currentLocaleProductUrlTransfer = null;
        $moneyValueTransfer = null;

        /** @var \Generated\Shared\Transfer\LocalizedUrlTransfer $localizedUrlTransfer */
        foreach ($productUrlTransfer->getUrls() as $localizedUrlTransfer) {
            if ($localizedUrlTransfer->getLocale()->getIdLocale() == $localeTransfer->getIdLocale()) {
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
        $mailTransfer->setLocale($localeTransfer);
        $mailTransfer->setProductAbstract($productAbstractTransfer);
        $mailTransfer->setType(AvailabilityAlertMailTypePlugin::MAIL_TYPE);
        $mailTransfer->setLocalizedUrl($currentLocaleProductUrlTransfer);
        $mailTransfer->setMoneyValue($moneyValueTransfer);
        $mailTransfer->setBaseUrlSslYves($this->baseUrlSslYves);

        $this->mailFacade->handleMail($mailTransfer);
    }

    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    protected function getAvailabilityAlertSubscriptionTransfer(
        FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription
    ) {
        $availabilityAlertSubscriptionTransfer = new AvailabilityAlertSubscriptionTransfer();

        $availabilityAlertSubscriptionTransfer->fromArray($fosAvailabilityAlertSubscription->toArray(), true);

        return $availabilityAlertSubscriptionTransfer;
    }

    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    protected function getLocaleTransfer(FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription)
    {
        $spyLocale = $fosAvailabilityAlertSubscription->getSpyLocale();

        $localeTransfer = new LocaleTransfer();

        $localeTransfer->fromArray($spyLocale->toArray(), true);

        return $localeTransfer;
    }

    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected function getProductAbstractTransfer(FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription): ProductAbstractTransfer
    {
        $spyProductAbstract = $fosAvailabilityAlertSubscription->getSpyProductAbstract();

        return $this->productFacade->findProductAbstractById($spyProductAbstract->getPrimaryKey());
    }
}
