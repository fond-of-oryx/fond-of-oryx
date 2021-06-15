<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Dependency\Facade;

interface ThirtyFiveUpToStoreFacadeInterface
{
    /**
     * @return string
     */
    public function getCurrentStoreName(): string;
}
