<?php

namespace FondOfOryx\Zed\CompanyUserArchive\Persistence;

use FondOfOryx\Zed\CompanyUserArchive\Persistence\Propel\Mapper\CompanyUserArchiveMapper;
use FondOfOryx\Zed\CompanyUserArchive\Persistence\Propel\Mapper\CompanyUserArchiveMapperInterface;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\CompanyUserArchive\Persistence\CompanyUserArchiveEntityManagerInterface getEntityManager()
 */
class CompanyUserArchivePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyUserArchive\Persistence\Propel\Mapper\CompanyUserArchiveMapperInterface
     */
    public function createCompanyUserArchiveMapper(): CompanyUserArchiveMapperInterface
    {
        return new CompanyUserArchiveMapper();
    }
}
