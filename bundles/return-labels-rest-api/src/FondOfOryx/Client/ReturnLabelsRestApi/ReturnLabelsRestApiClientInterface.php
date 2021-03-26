<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi;

interface ReturnLabelsRestApiClientInterface
{
    /**
     * @param int $idCompanyUnitAddress
     *
     * @return mixed
     */
    public function getCompanyUnitAddress(int $idCompanyUnitAddress);
}
