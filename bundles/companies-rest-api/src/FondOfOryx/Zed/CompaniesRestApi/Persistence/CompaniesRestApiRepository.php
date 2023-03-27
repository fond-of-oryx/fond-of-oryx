<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Persistence;

use Exception;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CompaniesRestApi\Persistence\CompaniesRestApiPersistenceFactory getFactory()
 */
class CompaniesRestApiRepository extends AbstractRepository implements CompaniesRestApiRepositoryInterface
{
    /**
     * @param string $uuid
     *
     * @throws \Exception
     *
     * @return int
     */
    public function getIdCompanyByUuid(string $uuid): int
    {
        $companyEntity = $this->getFactory()->getCompanyQuery()->filterByUuid($uuid)->findOne();
        if ($companyEntity === null) {
            throw new Exception(sprintf('Could not find company by uuid %s', $uuid));
        }

        return $companyEntity->getIdCompany();
    }
}
