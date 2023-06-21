<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Persistence;

interface CompaniesRestApiRepositoryInterface
{
    /**
     * @param string $uuid
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return int
     */
    public function getIdCompanyByUuid(string $uuid): int;
}
