<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication;

use FondOfOryx\Zed\OneTimePasswordEmailConnector\Dependency\Facade\OneTimePasswordEmailConnectorToLocaleFacadeInterface;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\OneTimePasswordEmailConnectorDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class OneTimePasswordEmailConnectorCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\OneTimePasswordEmailConnector\Dependency\Facade\OneTimePasswordEmailConnectorToLocaleFacadeInterface
     */
    public function getLocaleFacade(): OneTimePasswordEmailConnectorToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(OneTimePasswordEmailConnectorDependencyProvider::FACADE_LOCALE);
    }
}
