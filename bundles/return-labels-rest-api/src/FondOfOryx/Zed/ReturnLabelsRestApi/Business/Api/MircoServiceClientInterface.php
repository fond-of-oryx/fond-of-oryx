<?php


namespace FondOfOryx\Zed\ReturnLabelsRestApi\Facade\Api;


interface MircoServiceClientInterface
{
    /**
     * @param int $idCompanyUnitAddress
     *
     * @return mixed
     */
    public function getReturnLabel(int $idCompanyUnitAddress);
}
