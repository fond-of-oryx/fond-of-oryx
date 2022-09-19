<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader;

use FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCurrencyFacadeInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Throwable;

class CurrencyReader implements CurrencyReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCurrencyFacadeInterface
     */
    protected $currencyFacade;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCurrencyFacadeInterface $currencyFacade
     */
    public function __construct(JellyfishSalesOrderCompanyToCurrencyFacadeInterface $currencyFacade)
    {
        $this->currencyFacade = $currencyFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return string|null
     */
    public function getCodeByCompany(CompanyTransfer $companyTransfer): ?string
    {
        $idCurrency = $companyTransfer->getFkCurrency();

        if ($idCurrency === null) {
            return null;
        }

        try {
            return $this->currencyFacade->getByIdCurrency($idCurrency)
                ->getCode();
        } catch (Throwable $exception) {
        }

        return null;
    }
}
