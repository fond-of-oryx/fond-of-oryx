<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business;

use FondOfOryx\Zed\JellyfishBuffer\Business\Buffer\JellyfishBufferOrder;
use FondOfOryx\Zed\JellyfishBuffer\Business\Buffer\JellyfishBufferOrderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface getEntityManager()
 */
class JellyfishBufferBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\JellyfishBuffer\Business\Buffer\JellyfishBufferOrderInterface
     */
    public function createJellyfishBufferOrder(): JellyfishBufferOrderInterface
    {
        return new JellyfishBufferOrder(
            $this->getEntityManager()
        );
    }
}
