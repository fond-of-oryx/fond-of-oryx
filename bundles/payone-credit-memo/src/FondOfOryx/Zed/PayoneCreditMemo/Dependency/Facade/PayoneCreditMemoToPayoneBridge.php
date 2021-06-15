<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade;

use Generated\Shared\Transfer\PayonePartialOperationRequestTransfer;
use Generated\Shared\Transfer\RefundResponseTransfer;
use SprykerEco\Zed\Payone\Business\PayoneFacadeInterface;

class PayoneCreditMemoToPayoneBridge implements PayoneCreditMemoToPayoneInterface
{
    /**
     * @var \SprykerEco\Zed\Payone\Business\PayoneFacadeInterface
     */
    protected $payoneFacade;

    /**
     * @param \SprykerEco\Zed\Payone\Business\PayoneFacadeInterface $payoneFacade
     */
    public function __construct(PayoneFacadeInterface $payoneFacade)
    {
        $this->payoneFacade = $payoneFacade;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer $payonePartialOperationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RefundResponseTransfer
     */
    public function executePartialRefund(PayonePartialOperationRequestTransfer $payonePartialOperationRequestTransfer): RefundResponseTransfer
    {
        return $this->payoneFacade->executePartialRefund($payonePartialOperationRequestTransfer);
    }
}
