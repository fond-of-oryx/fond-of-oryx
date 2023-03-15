<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business;

use FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\Model\CompanyUserArchiveDeleter;
use FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\Model\CompanyUserArchiveDeleterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Persistence\CompanyDeleterCompanyUserArchiveConnectorEntityManagerInterface getEntityManager()
 */
class CompanyDeleterCompanyUserArchiveConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\Model\CompanyUserArchiveDeleterInterface
     */
    public function createCompanyUserArchiveDeleter(): CompanyUserArchiveDeleterInterface
    {
        return new CompanyUserArchiveDeleter($this->getEntityManager());
    }
}
