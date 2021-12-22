<?php

namespace FondOfOryx\Shared\Invoice;

use Spryker\Shared\SequenceNumber\SequenceNumberConstants;

interface InvoiceConstants
{
    /**
     * @var string
     */
    public const REFERENCE_NAME_VALUE = 'InvoiceReference';

    /**
     * @var string
     */
    public const REFERENCE_PREFIX = 'INVOICE:REFERENCE_PREFIX';

    /**
     * @var string
     */
    public const REFERENCE_ENVIRONMENT_PREFIX = SequenceNumberConstants::ENVIRONMENT_PREFIX;

    /**
     * @var string
     */
    public const REFERENCE_OFFSET = 'INVOICE:REFERENCE_OFFSET';
}
