<?php

namespace FondOfOryx\Zed\CompanyDeleter\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyDeleter\Business\CompanyDeleterBusinessFactory getFactory()
 */
class CompanyDeleterFacade extends AbstractFacade implements CompanyDeleterFacadeInterface
{
    /**
     * @param array $ids
     *
     * @return array<string, array<int>>
     */
    public function deleteCompanies(array $ids): array
    {
        return $this->getFactory()->createCompanyDeleter()->delete($ids);
    }

    /**
     * @param int $id
     *
     * @return array<string, array<int>>
     */
    public function deleteCompany(int $id): array
    {
        return $this->getFactory()->createCompanyDeleter()->delete([$id]);
    }
}
