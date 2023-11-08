<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;

interface CompanyUserMailConnectorToLocaleFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getCurrentLocale(): LocaleTransfer;

    /**
     * @param int $idLocale
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getLocaleById(int $idLocale): LocaleTransfer;
}
