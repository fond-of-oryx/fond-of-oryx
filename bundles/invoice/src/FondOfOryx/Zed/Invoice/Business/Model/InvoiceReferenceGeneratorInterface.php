<?php

namespace FondOfOryx\Zed\Invoice\Business\Model;

interface InvoiceReferenceGeneratorInterface
{
    /**
     * @return string
     */
    public function generate(): string;
}
