<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Model;

interface CreditMemoReferenceGeneratorInterface
{
    /**
     * @return string
     */
    public function generate(): string;
}
