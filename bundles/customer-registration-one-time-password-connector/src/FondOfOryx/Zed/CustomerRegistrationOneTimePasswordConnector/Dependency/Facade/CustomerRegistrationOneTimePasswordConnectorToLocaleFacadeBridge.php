<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeBridge implements CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeInterface
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
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getLocale(string $locale): LocaleTransfer
    {
        return $this->facade->getLocale($locale);
    }
}
