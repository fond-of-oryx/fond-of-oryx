<?php

namespace FondOfOryx\Zed\OneTimePassword\Dependency\Facade;

interface OneTimePasswordToLocaleFacadeInterface
{
    /**
     * @return string
     */
    public function getCurrentLocaleName(): string;
}
