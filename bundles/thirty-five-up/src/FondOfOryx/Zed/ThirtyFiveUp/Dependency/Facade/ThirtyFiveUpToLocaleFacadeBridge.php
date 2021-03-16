<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Dependency\Facade;

use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class ThirtyFiveUpToLocaleFacadeBridge implements ThirtyFiveUpToLocaleFacadeInterface
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
     * @return string
     */
    public function getCurrentLocaleName(): string
    {
        return $this->facade->getCurrentLocaleName();
    }
}
