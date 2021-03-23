<?php


namespace FondOfOryx\Zed\ReturnLabelRestApi\Facade\Api;


interface MircoServiceClientInterface
{
    /**
     * @param int $idCompanyUnitAddress
     *
     * @return mixed
     */
    public function getReturnLabel(int $idCompanyUnitAddress);
}
