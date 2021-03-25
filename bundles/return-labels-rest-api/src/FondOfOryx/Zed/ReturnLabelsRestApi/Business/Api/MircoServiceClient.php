<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Facade\Api;

use GuzzleHttp\ClientInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\ReturnLabelsRestApiToCompanyUnitAddressApiFacadeInterface;

class MircoServiceClient implements MircoServiceClientInterface
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var ReturnLabelsRestApiToCompanyUnitAddressApiFacadeInterface
     */
    protected $companyUnitAddressApiFacade;

    /**
     * @param ClientInterface $client
     */
    public function __construct(
        ClientInterface $client,
        ReturnLabelsRestApiToCompanyUnitAddressApiFacadeInterface $companyUnitAddressApiFacade
    ) {
        $this->client = $client;
        $this->companyUnitAddressApiFacade = $companyUnitAddressApiFacade;
    }

    /**
     * @param int $idCompanyUnitAddress
     *
     * @return mixed
     */
    public function getReturnLabel(int $idCompanyUnitAddress)
    {
        $address = $this->companyUnitAddressApiFacade->getCompanyUnitAddress($idCompanyUnitAddress);
    }
}
