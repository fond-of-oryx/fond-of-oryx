<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Business\Reader;

use FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToLocaleFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\NotificationCustomerTransfer;
use Throwable;

class LocaleReader implements LocaleReaderInterface
{
    /**
     * @var array<int, \Generated\Shared\Transfer\LocaleTransfer>
     */
    protected static array $cachedLocaleTransfers = [];

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToLocaleFacadeInterface
     */
    protected CompanyUserMailConnectorToLocaleFacadeInterface $localeFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToLocaleFacadeInterface $localeFacade
     */
    public function __construct(CompanyUserMailConnectorToLocaleFacadeInterface $localeFacade)
    {
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getByCustomer(CustomerTransfer $customerTransfer): LocaleTransfer
    {
        $localeTransfer = $customerTransfer->getLocale();

        if ($localeTransfer !== null) {
            return $localeTransfer;
        }

        $idLocale = $customerTransfer->getFkLocale();

        if ($idLocale === null) {
            return $this->localeFacade->getCurrentLocale();
        }

        return $this->getByIdLocale($idLocale);
    }

    /**
     * @param \Generated\Shared\Transfer\NotificationCustomerTransfer $notificationCustomerTransfer
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getByNotificationCustomer(
        NotificationCustomerTransfer $notificationCustomerTransfer
    ): LocaleTransfer {
        $idLocale = $notificationCustomerTransfer->getFkLocale();

        if ($idLocale === null) {
            return $this->localeFacade->getCurrentLocale();
        }

        return $this->getByIdLocale($idLocale);
    }

    /**
     * @param int $idLocale
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getByIdLocale(int $idLocale): LocaleTransfer
    {
        if (isset(static::$cachedLocaleTransfers[$idLocale])) {
            return static::$cachedLocaleTransfers[$idLocale];
        }

        try {
            static::$cachedLocaleTransfers[$idLocale] = $this->localeFacade->getLocaleById($idLocale);

            return static::$cachedLocaleTransfers[$idLocale];
        } catch (Throwable $exception) {
        }

        return $this->localeFacade->getCurrentLocale();
    }
}
