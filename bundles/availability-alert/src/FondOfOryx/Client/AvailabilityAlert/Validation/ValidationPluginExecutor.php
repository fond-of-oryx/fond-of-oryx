<?php

namespace FondOfOryx\Client\AvailabilityAlert\Validation;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;

class ValidationPluginExecutor implements ValidationPluginExecutorInterface
{
    /**
     * @var array<int, \FondOfOryx\Client\AvailabilityAlertExtension\Dependency\Plugin\ValidationPluginInterface>
     */
    protected $plugins;

    /**
     * @param array<int, \FondOfOryx\Client\AvailabilityAlertExtension\Dependency\Plugin\ValidationPluginInterface> $plugins
     */
    public function __construct(array $plugins)
    {
        $this->plugins = $plugins;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
     *
     * @return void
     */
    public function validate(AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer): void
    {
        foreach ($this->plugins as $plugin) {
            $plugin->validate($availabilityAlertSubscriptionRequestTransfer);
        }
    }
}
