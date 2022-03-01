<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader;

use FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToLocaleFacadeInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Throwable;

class LocaleReader implements LocaleReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToLocaleFacadeInterface $localeFacade
     */
    public function __construct(JellyfishSalesOrderCompanyToLocaleFacadeInterface $localeFacade)
    {
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return string|null
     */
    public function getNameByCompany(CompanyTransfer $companyTransfer): ?string
    {
        $idLocale = $companyTransfer->getFkLocale();

        if ($idLocale === null) {
            return null;
        }

        try {
            return $this->localeFacade->getLocaleById($idLocale)
                ->getLocaleName();
        } catch (Throwable $exception) {
            return null;
        }
    }
}
