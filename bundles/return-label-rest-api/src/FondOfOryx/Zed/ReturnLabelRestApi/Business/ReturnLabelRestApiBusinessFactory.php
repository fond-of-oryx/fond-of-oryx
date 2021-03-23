<?php

namespace FondOfOryx\Zed\ReturnLabelRestApi\Facade;

use FondOfOryx\Zed\ReturnLabelRestApi\Facade\Api\MircoServiceClient;
use FondOfOryx\Zed\ReturnLabelRestApi\Facade\Api\MircoServiceClientInterface;
use FondOfOryx\Zed\ReturnLabelRestApi\ReturnLabelRestApiDependencyProvider;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ReturnLabelRestApiBusinessFactory extends AbstractBusinessFactory
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
     * @return ReturnLabelRestApiToCompanyAddressApiFacadeInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCompanyUnitAddressApiFacade(): ReturnLabelRestApiToCompanyAddressApiFacadeInterface
    {
        return $this->getProvidedDependency(ReturnLabelRestApiDependencyProvider::COMPANY_UNIT_ADDRESS_API_FACADE);
    }
}
