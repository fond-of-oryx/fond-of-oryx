<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Dependency\Facade;

use Spryker\Zed\Store\Business\StoreFacadeInterface;

class ThirtyFiveUpToStoreFacadeBridge implements ThirtyFiveUpToStoreFacadeInterface
{
    /**
     * @var \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected $facade;

    /**
     * @param \Spryker\Zed\Store\Business\StoreFacadeInterface $storeFacade
     */
    public function __construct(StoreFacadeInterface $storeFacade)
    {
        $this->facade = $storeFacade;
    }

    /**
     * @return string
     */
    public function getCurrentStoreName(): string
    {
        return $this->facade->getCurrentStore()->getName();
    }
}
