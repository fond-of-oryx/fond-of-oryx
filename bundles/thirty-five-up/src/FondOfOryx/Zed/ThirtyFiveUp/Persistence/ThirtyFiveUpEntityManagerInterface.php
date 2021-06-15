<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Persistence;

use Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer;

interface ThirtyFiveUpEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function createThirtyFiveUpOrder(ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer): ThirtyFiveUpOrderTransfer;

    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @throws \FondOfOryx\Zed\ThirtyFiveUp\Exception\ThirtyFiveUpOrderNotFoundException
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function updateThirtyFiveUpOrder(ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer): ThirtyFiveUpOrderTransfer;

    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer
     */
    public function createThirtyFiveUpOrderItem(ThirtyFiveUpOrderItemTransfer $itemTransfer): ThirtyFiveUpOrderItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer $vendorTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer
     */
    public function createOrFindThirtyFiveUpVendor(ThirtyFiveUpVendorTransfer $vendorTransfer): ThirtyFiveUpVendorTransfer;
}
