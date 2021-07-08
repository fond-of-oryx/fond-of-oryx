<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Persistence;

use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrder;

interface ThirtyFiveUpRepositoryInterface
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

    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrder $thirtyFiveUpOrder
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function convertOrderEntityToTransfer(FooThirtyFiveUpOrder $thirtyFiveUpOrder): ThirtyFiveUpOrderTransfer;
}
