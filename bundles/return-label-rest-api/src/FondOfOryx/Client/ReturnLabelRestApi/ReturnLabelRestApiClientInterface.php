<?php

namespace FondOfOryx\Client\ReturnLabelRestApi;

interface ReturnLabelRestApiClientInterface
{
    /**
     * @param int $idCompanyUnitAddress
     *
     * @return mixed
     */
    public function getCompanyUnitAddress(int $idCompanyUnitAddress);
}
