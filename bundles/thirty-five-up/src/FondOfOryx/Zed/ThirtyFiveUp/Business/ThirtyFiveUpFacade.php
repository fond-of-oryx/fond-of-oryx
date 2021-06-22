<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrder;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * Class ThirtyFiveUpFacade
 *
 * @package FondOfOryx\Zed\ThirtyFiveUp\Business
 *
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpRepositoryInterface getRepository()
 */
class ThirtyFiveUpFacade extends AbstractFacade implements ThirtyFiveUpFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function createThirtyFiveUpOrderFromQuote(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFactory()->createThirtyFiveUpOrderHandler()->handleFromQuote($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function addAndSaveOrderDataFromSaveOrderTransfer(
        SaveOrderTransfer $saveOrderTransfer,
        ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
    ): ThirtyFiveUpOrderTransfer {
        return $this->getFactory()->createThirtyFiveUpOrderHandler()->handleFromSavedOrder(
            $saveOrderTransfer,
            $thirtyFiveUpOrderTransfer
        );
    }

    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrder $thirtyFiveUpOrder
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function convertThirtyFiveUpOrderEntityToTransfer(ThirtyFiveUpOrder $thirtyFiveUpOrder): ThirtyFiveUpOrderTransfer
    {
        return $this->getFactory()->createThirtyFiveUpOrderMapper()->fromEntity($thirtyFiveUpOrder);
    }

    /**
     * @param string $orderReference
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function findThirtyFiveUpOrderByOrderReference(string $orderReference): ?ThirtyFiveUpOrderTransfer
    {
        return $this->getFactory()->createThirtyFiveUpReader()->findThirtyFiveUpOrderByOrderReference($orderReference);
    }

    /**
     * @param string $thirtyFiveUpReference
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function findThirtyFiveUpOrderByThirtyFiveUpReference(string $thirtyFiveUpReference): ?ThirtyFiveUpOrderTransfer
    {
        return $this->getFactory()->createThirtyFiveUpReader()->findThirtyFiveUpOrderByThirtyFiveUpReference($thirtyFiveUpReference);
    }

    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function findThirtyFiveUpOrderById(int $id): ?ThirtyFiveUpOrderTransfer
    {
        return $this->getFactory()->createThirtyFiveUpReader()->findThirtyFiveUpOrderById($id);
    }

    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function updateThirtyFiveUpOrder(ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer): ThirtyFiveUpOrderTransfer
    {
        return $this->getFactory()->createThirtyFiveUpOrderWriter()->update($thirtyFiveUpOrderTransfer);
    }
}
