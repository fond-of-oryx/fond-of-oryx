<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ErpOrderPageSearchTransfer;
use Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearch;

class ErpOrderPageSearchMapper implements ErpOrderPageSearchMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer
     * @param \Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearch $fooErpOrderPageSearch
     *
     * @return \Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearch
     */
    public function mapTransferToEntity(
        ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer,
        FooErpOrderPageSearch $fooErpOrderPageSearch
    ): FooErpOrderPageSearch {
        $fooErpOrderPageSearch->fromArray($erpOrderPageSearchTransfer->modifiedToArray(false));

        return $fooErpOrderPageSearch;
    }
}
