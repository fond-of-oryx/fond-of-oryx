<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Business;

use FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacadeInterface;
use FondOfOryx\Zed\OneTimePasswordRestApi\Business\Sender\OneTimePasswordRestApiSender;
use FondOfOryx\Zed\OneTimePasswordRestApi\Business\Sender\OneTimePasswordRestApiSenderInterface;
use FondOfOryx\Zed\OneTimePasswordRestApi\OneTimePasswordRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class OneTimePasswordRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\OneTimePasswordRestApi\Business\Sender\OneTimePasswordRestApiSenderInterface
     */
    public function createOneTimePasswordRestApiSender(): OneTimePasswordRestApiSenderInterface
    {
        return new OneTimePasswordRestApiSender($this->getOneTimePasswordFacade());
    }

    /**
     * @return \FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacadeInterface
     */
    protected function getOneTimePasswordFacade(): OneTimePasswordFacadeInterface
    {
        return $this->getProvidedDependency(OneTimePasswordRestApiDependencyProvider::FACADE_ONE_TIME_PASSWORD);
    }
}
