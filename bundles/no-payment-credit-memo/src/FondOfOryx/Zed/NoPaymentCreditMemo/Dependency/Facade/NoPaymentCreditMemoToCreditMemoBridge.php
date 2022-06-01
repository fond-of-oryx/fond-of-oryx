<?php

namespace FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade;

use FondOfOryx\Zed\CreditMemo\Business\CreditMemoFacadeInterface;
use Generated\Shared\Transfer\CreditMemoResponseTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Propel\Runtime\Collection\ObjectCollection;

class NoPaymentCreditMemoToCreditMemoBridge implements NoPaymentCreditMemoToCreditMemoInterface
{
    /**
     * @var \FondOfOryx\Zed\CreditMemo\Business\CreditMemoFacadeInterface
     */
    protected $creditMemoFacade;

    /**
     * @param \FondOfOryx\Zed\CreditMemo\Business\CreditMemoFacadeInterface $creditMemoFacade
     */
    public function __construct(CreditMemoFacadeInterface $creditMemoFacade)
    {
        $this->creditMemoFacade = $creditMemoFacade;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoResponseTransfer
     */
    public function updateCreditMemo(CreditMemoTransfer $creditMemoTransfer): CreditMemoResponseTransfer
    {
        return $this->creditMemoFacade->updateCreditMemo($creditMemoTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|null
     */
    public function getSalesOrderItemsByCreditMemo(CreditMemoTransfer $creditMemoTransfer): ?ObjectCollection
    {
        return $this->creditMemoFacade->getSalesOrderItemsByCreditMemo($creditMemoTransfer);
    }
}
