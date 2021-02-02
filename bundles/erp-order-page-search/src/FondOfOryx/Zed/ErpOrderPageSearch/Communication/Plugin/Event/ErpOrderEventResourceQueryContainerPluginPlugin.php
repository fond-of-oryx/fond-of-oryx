<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Event;

use Spryker\Zed\EventBehavior\Dependency\Plugin\EventResourceQueryContainerPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class ErpOrderEventResourceQueryContainerPlugin extends AbstractPlugin implements EventResourceQueryContainerPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return '';
    }

}
