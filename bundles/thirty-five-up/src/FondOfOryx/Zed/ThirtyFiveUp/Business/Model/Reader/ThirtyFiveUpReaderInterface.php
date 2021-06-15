<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Reader;

use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;

interface ThirtyFiveUpReaderInterface
{
    /**
     * @param string $orderReference
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function findThirtyFiveUpOrderByOrderReference(string $orderReference): ?ThirtyFiveUpOrderTransfer;

    /**
     * @param string $thirtyFiveUpReference
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function findThirtyFiveUpOrderByThirtyFiveUpReference(string $thirtyFiveUpReference): ?ThirtyFiveUpOrderTransfer;

    /**
     * @param int $id
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function findThirtyFiveUpOrderById(int $id): ?ThirtyFiveUpOrderTransfer;
}
