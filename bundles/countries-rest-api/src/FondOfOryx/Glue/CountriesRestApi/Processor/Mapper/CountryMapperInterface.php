<?php

namespace FondOfOryx\Glue\CountriesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestCheckoutDataTransfer;

interface CountryMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCheckoutDataTransfer $restCheckoutDataTransfer
     *
     * @return array
     */
    public function mapRestCheckoutDataTransferToRestCountriesAttributesTransfers(
        RestCheckoutDataTransfer $restCheckoutDataTransfer
    ): array;
}
