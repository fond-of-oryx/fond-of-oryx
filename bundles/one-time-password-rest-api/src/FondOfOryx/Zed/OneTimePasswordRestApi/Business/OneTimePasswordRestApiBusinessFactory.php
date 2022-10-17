<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Business;

use FondOfOryx\Zed\OneTimePasswordRestApi\Business\Mapper\AttributesMapper;
use FondOfOryx\Zed\OneTimePasswordRestApi\Business\Mapper\AttributesMapperInterface;
use FondOfOryx\Zed\OneTimePasswordRestApi\Business\Sender\OneTimePasswordRestApiSender;
use FondOfOryx\Zed\OneTimePasswordRestApi\Business\Sender\OneTimePasswordRestApiSenderInterface;
use FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToCustomerFacadeInterface;
use FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToOneTimePasswordFacadeInterface;
use FondOfOryx\Zed\OneTimePasswordRestApi\OneTimePasswordRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class OneTimePasswordRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\OneTimePasswordRestApi\Business\Sender\OneTimePasswordRestApiSenderInterface
     */
    public function createOneTimePasswordRestApiSender(): OneTimePasswordRestApiSenderInterface
    {
        return new OneTimePasswordRestApiSender(
            $this->getOneTimePasswordFacade(),
            $this->getCustomerFacade(),
            $this->createAttributesMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\OneTimePasswordRestApi\Business\Mapper\AttributesMapperInterface
     */
    public function createAttributesMapper(): AttributesMapperInterface
    {
        return new AttributesMapper();
    }

    /**
     * @return \FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToOneTimePasswordFacadeInterface
     */
    protected function getOneTimePasswordFacade(): OneTimePasswordRestApiToOneTimePasswordFacadeInterface
    {
        return $this->getProvidedDependency(OneTimePasswordRestApiDependencyProvider::FACADE_ONE_TIME_PASSWORD);
    }

    /**
     * @return \FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToCustomerFacadeInterface
     */
    protected function getCustomerFacade(): OneTimePasswordRestApiToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(OneTimePasswordRestApiDependencyProvider::FACADE_CUSTOMER);
    }
}
