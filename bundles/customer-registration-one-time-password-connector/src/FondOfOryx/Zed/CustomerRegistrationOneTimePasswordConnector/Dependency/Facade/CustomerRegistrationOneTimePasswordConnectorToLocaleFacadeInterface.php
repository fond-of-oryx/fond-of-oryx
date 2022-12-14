<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;

interface CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeInterface
{
    /**
     * @param string $locale
     *
     * @throws \Spryker\Zed\Locale\Business\Exception\MissingLocaleException
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getLocale(string $locale): LocaleTransfer;

    /**
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getCurrentLocale(): LocaleTransfer;
}
