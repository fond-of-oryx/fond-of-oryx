<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Facade;

use FondOfOryx\Zed\ReturnLabelsRestApi\Facade\Api\MircoServiceClient;
use FondOfOryx\Zed\ReturnLabelsRestApi\Facade\Api\MircoServiceClientInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\ReturnLabelsRestApiDependencyProvider;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ReturnLabelsRestApiBusinessFactory extends AbstractBusinessFactory
{
    public function createMicroServiceClient(): MircoServiceClientInterface
    {
        return new MircoServiceClient(
            $this->createClient(),
            $this->getCompanyUnitAddressApiFacade()
        );
    }

    /**
     * @return ClientInterface
     */
    public function createClient(): ClientInterface
    {
        return new Client();
    }

    /**
     * @return ReturnLabelsRestApiToCompanyAddressApiFacadeInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCompanyUnitAddressApiFacade(): ReturnLabelsRestApiToCompanyAddressApiFacadeInterface
    {
        return $this->getProvidedDependency(ReturnLabelsRestApiDependencyProvider::COMPANY_UNIT_ADDRESS_API_FACADE);
    }
}
