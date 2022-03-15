<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;

interface CompanyOmsMailConnectorToLocaleFacadeInterface
{
    /**
     * @param int $fkLocale
     *
     * @throws \Spryker\Zed\Locale\Business\Exception\MissingLocaleException
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getLocaleById(int $fkLocale): LocaleTransfer;

    /**
     * @return array<string>
     */
    public function getAvailableLocales();
}
