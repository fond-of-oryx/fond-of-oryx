<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage\Business;

use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\JellyfishCrossEngage\Business\JellyfishCrossEngageBusinessFactory getFactory()
 */
class JellyfishCrossEngageFacade extends AbstractFacade implements JellyfishCrossEngageFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     *
     * @return string|null
     */
    public function getGender(JellyfishOrderItemTransfer $jellyfishOrderItemTransfer): ?string
    {
        return $this->getFactory()
            ->createJellyfishCrossEngageReader()
            ->getGender($jellyfishOrderItemTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     *
     * @return string|null
     */
    public function getCategories(JellyfishOrderItemTransfer $jellyfishOrderItemTransfer): ?string
    {
        return $this->getFactory()
            ->createJellyfishCrossEngageReader()
            ->getCategories($jellyfishOrderItemTransfer);
    }
}
