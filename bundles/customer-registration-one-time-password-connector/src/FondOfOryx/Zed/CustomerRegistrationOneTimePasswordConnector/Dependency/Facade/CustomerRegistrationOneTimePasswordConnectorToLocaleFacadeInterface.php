<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

interface CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeInterface
{
    /**
     * @param string $locale
     * @return \Generated\Shared\Transfer\LocaleTransfer
     * @throws \Spryker\Zed\Locale\Business\Exception\MissingLocaleException
     */
    public function getLocale(
        string $locale
    ): LocaleTransfer;
}
