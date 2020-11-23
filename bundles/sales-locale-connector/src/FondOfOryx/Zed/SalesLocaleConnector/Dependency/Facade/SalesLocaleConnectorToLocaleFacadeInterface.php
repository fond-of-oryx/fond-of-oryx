<?php

namespace FondOfOryx\Zed\SalesLocaleConnector\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;

interface SalesLocaleConnectorToLocaleFacadeInterface
{
    /**
     * @param int $idLocale
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getLocaleById(int $idLocale): LocaleTransfer;
}
