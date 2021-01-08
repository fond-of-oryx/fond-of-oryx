<?php

namespace FondOfOryx\Zed\TaxCalculaionConnector\Business\Calculator;

use Generated\Shared\Transfer\CalculableObjectTransfer;

interface CalculatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CalculableObjectTransfer $calculableObjectTransfer
     *
     * @return \Generated\Shared\Transfer\CalculableObjectTransfer
     */
    public function recalculateWithCalculableObject(CalculableObjectTransfer $calculableObjectTransfer): CalculableObjectTransfer;
}
