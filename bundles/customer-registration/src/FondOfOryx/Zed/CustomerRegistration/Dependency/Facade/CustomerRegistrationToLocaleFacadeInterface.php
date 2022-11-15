<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;

interface CustomerRegistrationToLocaleFacadeInterface
{
    /**
     * @param string $localeString
     *
     * @throws \Spryker\Zed\Locale\Business\Exception\MissingLocaleException
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getLocale(string $localeString): LocaleTransfer;

    /**
     * @return string
     */
    public function getCurrentLocaleName(): string;
}
