<?php

namespace FondOfOryx\Zed\JellyfishThirtyFiveUp\Dependency\Facade;

use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrder;

interface JellyfishThirtyFiveUpToThirtyFiveUpFacadeInterface
{
    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrder $thirtyFiveUpOrder
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function convertThirtyFiveUpOrderEntityToTransfer(FooThirtyFiveUpOrder $thirtyFiveUpOrder): ThirtyFiveUpOrderTransfer;
}
