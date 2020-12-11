<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use Generated\Shared\Transfer\ErpOrderAddressTransfer;

interface ErpOrderAddressWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function create(ErpOrderAddressTransfer $erpOrderAddressTransfer): ErpOrderAddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function update(ErpOrderAddressTransfer $erpOrderAddressTransfer): ErpOrderAddressTransfer;

    /**
     * @param int $idErpOrderAddress
     *
     * @return void
     */
    public function delete(int $idErpOrderAddress): void;
}
