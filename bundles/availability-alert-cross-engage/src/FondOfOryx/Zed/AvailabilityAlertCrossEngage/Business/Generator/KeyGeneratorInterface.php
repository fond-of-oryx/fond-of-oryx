<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Generator;

interface KeyGeneratorInterface
{
    /**
     * @param string $string
     *
     * @return string
     */
    public function generate(string $string): string;
}
