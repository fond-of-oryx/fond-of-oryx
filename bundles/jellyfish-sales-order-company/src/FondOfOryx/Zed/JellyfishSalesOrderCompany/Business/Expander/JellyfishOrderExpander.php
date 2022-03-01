<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Expander;

use FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader\LocaleReaderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishOrderExpander implements JellyfishOrderExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader\LocaleReaderInterface
     */
    protected $localeReader;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeInterface
     */
    protected $companyUserReferenceFacade;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderCompany\Business\Reader\LocaleReaderInterface $localeReader
     * @param \FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade\JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeInterface $companyUserReferenceFacade
     */
    public function __construct(
        LocaleReaderInterface $localeReader,
        JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeInterface $companyUserReferenceFacade
    ) {
        $this->localeReader = $localeReader;
        $this->companyUserReferenceFacade = $companyUserReferenceFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function expand(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        SpySalesOrder $salesOrder
    ): JellyfishOrderTransfer {
        $companyUserReference = $salesOrder->getCompanyUserReference();

        if ($companyUserReference === null) {
            return $jellyfishOrderTransfer;
        }

        $companyTransfer = $this->companyUserReferenceFacade->getCompanyByCompanyUserReference($companyUserReference);

        if ($companyTransfer === null) {
            return $jellyfishOrderTransfer;
        }

        return $jellyfishOrderTransfer->setCompanyUuid($companyTransfer->getUuid())
            ->setCompanyId($companyTransfer->getIdCompany())
            ->setCompanyLocale($this->localeReader->getNameByCompany($companyTransfer));
    }
}
