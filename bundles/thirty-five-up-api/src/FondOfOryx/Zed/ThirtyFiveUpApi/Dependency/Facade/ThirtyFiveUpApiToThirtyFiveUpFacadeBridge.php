<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade;

use FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;

class ThirtyFiveUpApiToThirtyFiveUpFacadeBridge implements ThirtyFiveUpApiToThirtyFiveUpFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface
     */
    protected $facade;

    /**
     * @param \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface $thirtyFiveUpFacade
     */
    public function __construct(ThirtyFiveUpFacadeInterface $thirtyFiveUpFacade)
    {
        $this->facade = $thirtyFiveUpFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function updateThirtyFiveUpOrder(ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer): ThirtyFiveUpOrderTransfer
    {
        return $this->facade->updateThirtyFiveUpOrder($thirtyFiveUpOrderTransfer);
    }

    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function findThirtyFiveUpOrderById(int $id): ?ThirtyFiveUpOrderTransfer
    {
        return $this->facade->findThirtyFiveUpOrderById($id);
    }
}
