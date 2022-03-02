<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Business\Expander;

use FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Dependency\Facade\JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishOrderExpander implements JellyfishOrderExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Dependency\Facade\JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeInterface
     */
    protected $companyUserReferenceFacade;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Dependency\Facade\JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeInterface $companyUserReferenceFacade
     */
    public function __construct(
        JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeInterface $companyUserReferenceFacade
    ) {
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

        $companyBusinessUnitTransfer = $this->companyUserReferenceFacade->getCompanyBusinessUnitByCompanyUserReference(
            $companyUserReference,
        );

        if ($companyBusinessUnitTransfer === null) {
            return $jellyfishOrderTransfer;
        }

        return $jellyfishOrderTransfer->setCompanyBusinessUnitUuid($companyBusinessUnitTransfer->getUuid())
            ->setCompanyBusinessUnitId($companyBusinessUnitTransfer->getIdCompanyBusinessUnit());
    }
}
