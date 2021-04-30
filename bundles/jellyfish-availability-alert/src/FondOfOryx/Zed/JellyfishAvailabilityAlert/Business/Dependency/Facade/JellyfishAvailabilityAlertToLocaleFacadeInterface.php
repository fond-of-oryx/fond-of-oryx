<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;

interface JellyfishAvailabilityAlertToLocaleFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getCurrentLocale(): LocaleTransfer;
}
