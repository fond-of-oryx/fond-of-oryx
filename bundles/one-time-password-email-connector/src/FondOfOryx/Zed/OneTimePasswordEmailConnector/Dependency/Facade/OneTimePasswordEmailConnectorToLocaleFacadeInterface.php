<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;

interface OneTimePasswordEmailConnectorToLocaleFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getCurrentLocale(): LocaleTransfer;
}
