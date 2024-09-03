<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Exception;

use Exception;

class NotEnoughOrderBudgetException extends Exception
{
    /**
     * @var array|null
     */
    protected $params;

    /**
     * @param array $params
     *
     * @return void
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    /**
     * @return array|null
     */
    public function getParams(): ?array
    {
        return $this->params;
    }
}
