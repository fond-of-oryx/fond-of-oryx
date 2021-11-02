<?php

namespace FondOfOryx\Zed\CreditMemo\Persistence;

use Exception;
use Generated\Shared\Transfer\CreditMemoItemStateTransfer;
use Generated\Shared\Transfer\CreditMemoStateTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoItem;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoItemState;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoState;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoPersistenceFactory getFactory()
 */
class CreditMemoEntityManager extends AbstractEntityManager implements CreditMemoEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function createCreditMemo(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer {
        $fooCreditMemo = $this->getFactory()
            ->createCreditMemoMapper()
            ->mapTransferToEntity($creditMemoTransfer, new FooCreditMemo());

        $fooCreditMemo->save();

        return $creditMemoTransfer->setIdCreditMemo(
            $fooCreditMemo->getIdCreditMemo(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function updateCreditMemo(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer {
        $creditMemoTransfer->requireIdCreditMemo();

        $fooCreditMemo = $this->getFactory()->createCreditMemoQuery()->findOneByIdCreditMemo($creditMemoTransfer->getIdCreditMemo());

        if ($fooCreditMemo === null) {
            throw new Exception(sprintf('Could not update credit memo with id %s because no credit memo with given id was found', $creditMemoTransfer->getIdCreditMemo()));
        }

        $fooCreditMemo->fromArray($creditMemoTransfer->modifiedToArray());
        $fooCreditMemo->save();
        $creditMemoTransfer->fromArray($fooCreditMemo->getModifiedColumns(), true);

        return $creditMemoTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoStateTransfer $creditMemoStateTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\CreditMemoStateTransfer
     */
    public function updateCreditMemoState(
        CreditMemoStateTransfer $creditMemoStateTransfer
    ): CreditMemoStateTransfer {
        $creditMemoStateTransfer->requireIdCreditMemoState();

        $fooCreditMemoState = $this->getFactory()->createCreditMemoStateQuery()->findOneByIdCreditMemoState($creditMemoStateTransfer->getIdCreditMemoState());

        if ($fooCreditMemoState === null) {
            throw new Exception(sprintf('Could not update credit memo state with id %s because no credit memo state with given id was found', $creditMemoStateTransfer->getIdCreditMemoState()));
        }

        foreach ($creditMemoStateTransfer->getCreditMemoItemStates() as $creditMemoItemStateTransfer) {
            if ($creditMemoItemStateTransfer->getIdCreditMemoItemState() !== null) {
                $this->createCreditMemoItemState($creditMemoItemStateTransfer);

                continue;
            }
            $this->updateCreditMemoStateItem($creditMemoItemStateTransfer);
        }

        $fooCreditMemoState->fromArray($creditMemoStateTransfer->modifiedToArray());
        $fooCreditMemoState->save();
        $creditMemoStateTransfer->fromArray($fooCreditMemoState->getModifiedColumns(), true);

        return $creditMemoStateTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoItemStateTransfer $creditMemoItemStateTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\CreditMemoItemStateTransfer
     */
    public function updateCreditMemoStateItem(
        CreditMemoItemStateTransfer $creditMemoItemStateTransfer
    ): CreditMemoItemStateTransfer {
        $creditMemoItemStateTransfer->requireIdCreditMemoItemState();

        $fooCreditMemoItemState = $this->getFactory()->createCreditMemoItemStateQuery()->findOneByIdCreditMemoItemState($creditMemoItemStateTransfer->getIdCreditMemoItemState());

        if ($fooCreditMemoItemState === null) {
            throw new Exception(sprintf('Could not update credit memo item state with id %s because no credit memo item state with given id was found', $creditMemoItemStateTransfer->getIdCreditMemoItemState()));
        }

        $fooCreditMemoItemState->fromArray($creditMemoItemStateTransfer->modifiedToArray());
        $fooCreditMemoItemState->save();
        $creditMemoItemStateTransfer->fromArray($fooCreditMemoItemState->getModifiedColumns(), true);

        return $creditMemoItemStateTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoStateTransfer $creditMemoSateTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoStateTransfer
     */
    public function createCreditMemoState(
        CreditMemoStateTransfer $creditMemoSateTransfer
    ): CreditMemoStateTransfer {
        $fooCreditMemoState = $this->getFactory()
            ->createCreditMemoStateMapper()
            ->mapTransferToEntity($creditMemoSateTransfer, new FooCreditMemoState());

        $fooCreditMemoState->save();

        return $creditMemoSateTransfer->setIdCreditMemoState(
            $fooCreditMemoState->getIdCreditMemoState(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    public function createCreditMemoItem(
        ItemTransfer $itemTransfer
    ): ItemTransfer {
        $fooCreditMemoItem = $this->getFactory()
            ->createCreditMemoItemMapper()
            ->mapTransferToEntity($itemTransfer, new FooCreditMemoItem());

        $fooCreditMemoItem->save();

        return $itemTransfer->setIdCreditMemoItem(
            $fooCreditMemoItem->getIdCreditMemoItem(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoItemStateTransfer $itemStateTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoItemStateTransfer
     */
    public function createCreditMemoItemState(
        CreditMemoItemStateTransfer $itemStateTransfer
    ): CreditMemoItemStateTransfer {
        $fooCreditMemoItemState = $this->getFactory()
            ->createCreditMemoItemStateMapper()
            ->mapTransferToEntity($itemStateTransfer, new FooCreditMemoItemState());

        $fooCreditMemoItemState->save();

        return $itemStateTransfer->setIdCreditMemoItemState(
            $fooCreditMemoItemState->getIdCreditMemoItemState(),
        );
    }
}
