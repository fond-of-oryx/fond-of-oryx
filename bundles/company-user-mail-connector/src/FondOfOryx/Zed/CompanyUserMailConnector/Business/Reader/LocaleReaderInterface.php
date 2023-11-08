<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Business\Reader;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\NotificationCustomerTransfer;

interface LocaleReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getByCustomer(CustomerTransfer $customerTransfer): LocaleTransfer;

    /**
     * @param \Generated\Shared\Transfer\NotificationCustomerTransfer $notificationCustomerTransfer
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getByNotificationCustomer(
        NotificationCustomerTransfer $notificationCustomerTransfer
    ): LocaleTransfer;

    /**
     * @param int $idLocale
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getByIdLocale(int $idLocale): LocaleTransfer;
}
