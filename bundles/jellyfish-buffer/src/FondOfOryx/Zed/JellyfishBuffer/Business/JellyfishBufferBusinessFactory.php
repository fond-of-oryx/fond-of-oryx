<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business;

use FondOfOryx\Zed\JellyfishBuffer\Business\Buffer\JellyfishBufferInterface;
use FondOfOryx\Zed\JellyfishBuffer\Business\Buffer\JellyfishBufferOrder;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface getEntityManager()
 */
class JellyfishBufferBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\JellyfishBuffer\Business\Buffer\JellyfishBufferInterface
     */
    public function createJellyfishBufferOrder(): JellyfishBufferInterface
    {
        return new JellyfishBufferOrder(
            $this->getEntityManager()
        );
    }
}
