<?php

namespace FondOfOryx\Zed\JellyfishThirtyFiveUp\Communication;

use FondOfOryx\Zed\JellyfishThirtyFiveUp\Dependency\Facade\JellyfishThirtyFiveUpToThirtyFiveUpFacadeInterface;
use FondOfOryx\Zed\JellyfishThirtyFiveUp\JellyfishThirtyFiveUpDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishThirtyFiveUp\JellyfishThirtyFiveUpConfig getConfig()
 * @method \FondOfOryx\Zed\JellyfishThirtyFiveUp\Business\JellyfishThirtyFiveUpFacadeInterface getFacade()
 */
class JellyfishThirtyFiveUpCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\JellyfishThirtyFiveUp\Dependency\Facade\JellyfishThirtyFiveUpToThirtyFiveUpFacadeInterface
     */
    public function getThirtyFiveUpFacade(): JellyfishThirtyFiveUpToThirtyFiveUpFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishThirtyFiveUpDependencyProvider::FACADE_THIRTY_FIVE_UP);
    }
}
