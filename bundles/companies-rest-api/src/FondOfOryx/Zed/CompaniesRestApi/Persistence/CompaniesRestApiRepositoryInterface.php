<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Persistence;

use Exception;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

interface CompaniesRestApiRepositoryInterface
{
    /**
     * @param string $uuid
     *
     * @return int
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function getIdCompanyByUuid(string $uuid): int;
}