<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client;

use Generated\Shared\Transfer\LocaleTransfer;

interface JellyfishCrossEngageToLocaleFacadeInterface
{
    /**
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getLocale(string $localeName): LocaleTransfer;
}
