<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Business;

use FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade\OneTimePasswordEmailConnectorToMailBridge;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\OneTimePasswordEmailConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class OneTimePasswordEmailConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\OneTimePasswordEmailConnectorInterface
     */
    public function createOneTimePasswordEmailConnector(): OneTimePasswordEmailConnectorInterface
    {
        return new OneTimePasswordEmailConnector(
            $this->getMailFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade\OneTimePasswordEmailConnectorToMailBridge
     */
    protected function getMailFacade(): OneTimePasswordEmailConnectorToMailBridge
    {
        return $this->getProvidedDependency(OneTimePasswordEmailConnectorDependencyProvider::FACADE_MAIL);
    }
}
