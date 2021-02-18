<?php

namespace FondOfOryx\Zed\Oms\Business;

use FondOfOryx\Zed\Oms\Business\OrderStateMachine\Timeout;
use Spryker\Zed\Oms\Business\OmsBusinessFactory as SprykerOmsBusinessFactory;

/**
 * @method \Spryker\Zed\Oms\OmsConfig getConfig()
 * @method \Spryker\Zed\Oms\Persistence\OmsQueryContainerInterface getQueryContainer()
 */
class OmsBusinessFactory extends SprykerOmsBusinessFactory
{
    /**
     * @return \Spryker\Zed\Oms\Business\OrderStateMachine\TimeoutInterface
     */
    public function createOrderStateMachineTimeout()
    {
        return new Timeout(
            $this->getQueryContainer()
        );
    }
}
