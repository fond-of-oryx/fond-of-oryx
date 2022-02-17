<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ErpDeliveryNotePageSearchTransfer;
use Orm\Zed\ErpDeliveryNotePageSearch\Persistence\FooErpDeliveryNotePageSearch;

interface ErpDeliveryNotePageSearchMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNotePageSearchTransfer $erpDeliveryNotePageSearchTransfer
     * @param \Orm\Zed\ErpDeliveryNotePageSearch\Persistence\FooErpDeliveryNotePageSearch $fooErpDeliveryNotePageSearch
     *
     * @return \Orm\Zed\ErpDeliveryNotePageSearch\Persistence\FooErpDeliveryNotePageSearch
     */
    public function mapTransferToEntity(
        ErpDeliveryNotePageSearchTransfer $erpDeliveryNotePageSearchTransfer,
        FooErpDeliveryNotePageSearch $fooErpDeliveryNotePageSearch
    ): FooErpDeliveryNotePageSearch;
}
