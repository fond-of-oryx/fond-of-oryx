<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Persistence;

interface ReturnLabelsRestApiRepositoryInterface
{
    /**
     * @param string $uuid
     *
     * @return int|null
     */
    public function getIdCompanyUnitAddressByCompanyUnitAddressUuid(string $uuid): ?int;
}
