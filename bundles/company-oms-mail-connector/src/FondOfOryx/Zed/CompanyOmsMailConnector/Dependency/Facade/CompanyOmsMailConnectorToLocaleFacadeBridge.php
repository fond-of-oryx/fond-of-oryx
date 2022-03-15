<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class CompanyOmsMailConnectorToLocaleFacadeBridge implements CompanyOmsMailConnectorToLocaleFacadeInterface
{
    /**
     * @var \Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected $facade;

    /**
     * @param \Spryker\Zed\Locale\Business\LocaleFacadeInterface $localeFacade
     */
    public function __construct(LocaleFacadeInterface $localeFacade)
    {
        $this->facade = $localeFacade;
    }

    /**
     * @param int $fkLocale
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getLocaleById(int $fkLocale): LocaleTransfer
    {
        return $this->facade->getLocaleById($fkLocale);
    }

    /**
     * @return array<string>
     */
    public function getAvailableLocales(): array
    {
        return $this->facade->getAvailableLocales();
    }
}
