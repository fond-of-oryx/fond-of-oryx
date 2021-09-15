<?php

namespace FondOfOryx\Zed\OneTimePassword\Dependency\Facade;

use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class OneTimePasswordToLocaleFacadeBridge implements OneTimePasswordToLocaleFacadeInterface
{
    /**
     * @var \Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @param \Spryker\Zed\Locale\Business\LocaleFacadeInterface $localeFacade
     */
    public function __construct(LocaleFacadeInterface $localeFacade)
    {
        $this->localeFacade = $localeFacade;
    }

    /**
     * @return string
     */
    public function getCurrentLocaleName(): string
    {
        return $this->localeFacade->getCurrentLocaleName();
    }
}
