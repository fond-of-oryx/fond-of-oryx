<?php

namespace FondOfOryx\Zed\JellyfishThirtyFiveUp\Dependency\Facade;

use FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrder;

class JellyfishThirtyFiveUpToThirtyFiveUpFacadeBridge implements JellyfishThirtyFiveUpToThirtyFiveUpFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface
     */
    protected $facade;

    /**
     * @param \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface $facade
     */
    public function __construct(ThirtyFiveUpFacadeInterface $facade)
    {
        $this->facade = $facade;
    }

    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrder $thirtyFiveUpOrder
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function convertThirtyFiveUpOrderEntityToTransfer(FooThirtyFiveUpOrder $thirtyFiveUpOrder): ThirtyFiveUpOrderTransfer
    {
        return $this->facade->convertThirtyFiveUpOrderEntityToTransfer($thirtyFiveUpOrder);
    }
}
