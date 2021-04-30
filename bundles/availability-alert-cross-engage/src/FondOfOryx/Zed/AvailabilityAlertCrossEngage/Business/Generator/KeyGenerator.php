<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Generator;

use FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageConfig;

class KeyGenerator implements KeyGeneratorInterface
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageConfig $config
     */
    public function __construct(AvailabilityAlertCrossEngageConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function generate(string $string): string
    {
        return sha1(sprintf('%s|%s', $string, $this->config->getSalt()));
    }
}
