<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Dependency\Facade;

interface ThirtyFiveUpToLocaleFacadeInterface
{
    /**
     * @return string
     */
    public function getCurrentLocaleName(): string;
}
