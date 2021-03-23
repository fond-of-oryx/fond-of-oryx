<?php

namespace FondOfOryx\Zed\ReturnLabelRestApi\Facade\Api;

use GuzzleHttp\ClientInterface;
use FondOfOryx\Zed\ReturnLabelRestApi\Dependency\ReturnLabelRestApiToCompanyUnitAddressApiFacadeInterface;

class MircoServiceClient implements MircoServiceClientInterface
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var ReturnLabelRestApiToCompanyUnitAddressApiFacadeInterface
     */
    protected $companyUnitAddressApiFacade;

    /**
     * @param ClientInterface $client
     */
    public function __construct(
        ClientInterface $client,
        ReturnLabelRestApiToCompanyUnitAddressApiFacadeInterface $companyUnitAddressApiFacade
    )
    {
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
