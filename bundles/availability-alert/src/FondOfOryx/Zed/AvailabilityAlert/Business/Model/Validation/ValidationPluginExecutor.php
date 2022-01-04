<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model\Validation;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class ValidationPluginExecutor implements ValidationPluginExecutorInterface
{
    /**
     * @var array<int, \FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\Validation\ValidationPluginInterface>
     */
    protected $plugins;

    /**
     * @param array<int, \FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\Validation\ValidationPluginInterface> $plugins
     */
    public function __construct(array $plugins)
    {
        $this->plugins = $plugins;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function validate(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void
    {
        foreach ($this->plugins as $plugin) {
            $plugin->validate($availabilityAlertSubscriptionTransfer);
        }
    }
}
