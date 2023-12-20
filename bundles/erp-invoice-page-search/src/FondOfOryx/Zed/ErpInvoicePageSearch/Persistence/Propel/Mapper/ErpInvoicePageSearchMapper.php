<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ErpInvoicePageSearchTransfer;
use Orm\Zed\ErpInvoicePageSearch\Persistence\FooErpInvoicePageSearch;

/**
 * @codeCoverageIgnore
 */
class ErpInvoicePageSearchMapper implements ErpInvoicePageSearchMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoicePageSearchTransfer $erpInvoicePageSearchTransfer
     * @param \Orm\Zed\ErpInvoicePageSearch\Persistence\FooErpInvoicePageSearch $fooErpInvoicePageSearch
     *
     * @return \Orm\Zed\ErpInvoicePageSearch\Persistence\FooErpInvoicePageSearch
     */
    public function mapTransferToEntity(
        ErpInvoicePageSearchTransfer $erpInvoicePageSearchTransfer,
        FooErpInvoicePageSearch $fooErpInvoicePageSearch
    ): FooErpInvoicePageSearch {
        $fooErpInvoicePageSearch->fromArray($erpInvoicePageSearchTransfer->modifiedToArray(false));

        return $fooErpInvoicePageSearch;
    }
}
