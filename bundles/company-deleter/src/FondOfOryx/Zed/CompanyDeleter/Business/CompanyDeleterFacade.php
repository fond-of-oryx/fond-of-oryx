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
     * @return void
     */
    public function deleteCompanies(array $ids): void
    {
        $this->getFactory()->createCompanyDeleter()->delete($ids);
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function deleteCompany(int $id): void
    {
        $this->getFactory()->createCompanyDeleter()->delete([$id]);
    }
}
