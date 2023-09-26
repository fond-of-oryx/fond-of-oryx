<?php

namespace FondOfOryx\Glue\CountriesRestApi\Processor\Mapper;

use FondOfOryx\Glue\CountriesRestApi\CountriesRestApiConfig;
use Generated\Shared\Transfer\RestCheckoutDataTransfer;

class CountryMapper implements CountryMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CountriesRestApi\CountriesRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Glue\CountriesRestApi\CountriesRestApiConfig $config
     */
    public function __construct(CountriesRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCheckoutDataTransfer $restCheckoutDataTransfer
     *
     * @return array
     */
    public function mapRestCheckoutDataTransferToRestCountriesAttributesTransfers(
        RestCheckoutDataTransfer $restCheckoutDataTransfer
    ): array {
        $restCountriesAttributesTransfers = [];

        return $restCountriesAttributesTransfers;
    }
}
