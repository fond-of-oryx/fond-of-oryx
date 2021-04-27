<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model;

interface SubscribersNotifierInterface
{
    /**
     * @return $this
     */
    public function notify(): self;
}
