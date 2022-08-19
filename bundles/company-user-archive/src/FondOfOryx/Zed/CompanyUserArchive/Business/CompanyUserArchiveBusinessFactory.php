<?php

namespace FondOfOryx\Zed\CompanyUserArchive\Business;

use FondOfOryx\Zed\CompanyUserArchive\Business\Writer\CompanyUserArchiveWriter;
use FondOfOryx\Zed\CompanyUserArchive\Business\Writer\CompanyUserArchiveWriterInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyUserArchive\Persistence\CompanyUserArchiveEntityManager getEntityManager()
 */
class CompanyUserArchiveBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\CompanyUserArchive\Business\Writer\CompanyUserArchiveWriterInterface
     */
    public function createCompanyUserArchiveWriter(): CompanyUserArchiveWriterInterface
    {
        return new CompanyUserArchiveWriter(
            $this->getEntityManager(),
            $this->getLogger(),
        );
    }
}
