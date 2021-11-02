<?php

namespace FondOfOryx\Shared\CreditMemo;

use Spryker\Shared\SequenceNumber\SequenceNumberConstants;

interface CreditMemoConstants
{
    /**
     * @var string
     */
    public const REFERENCE_NAME_VALUE = 'CreditMemoReference';

    /**
     * @var string
     */
    public const REFERENCE_PREFIX = 'CREDIT_MEMO:REFERENCE_PREFIX';
    public const REFERENCE_ENVIRONMENT_PREFIX = SequenceNumberConstants::ENVIRONMENT_PREFIX;

    /**
     * @var string
     */
    public const REFERENCE_OFFSET = 'CREDIT_MEMO:REFERENCE_OFFSET';

    /**
     * @var string
     */
    public const STATE_NEW = 'new';

    /**
     * @var string
     */
    public const STATE_IN_PROGRESS = 'in progress';

    /**
     * @var string
     */
    public const STATE_COMPLETE = 'complete';

    /**
     * @var string
     */
    public const STATE_ERROR = 'error';

    /**
     * @var string
     */
    public const PROCESS_SIZE_MAX = 'CREDIT_MEMO:PROCESS_SIZE_MAX';

    /**
     * @var array
     */
    public const STATE_MAPPING = [
        self::STATE_NEW => 0,
        self::STATE_IN_PROGRESS => 1,
        self::STATE_COMPLETE => 2,
        self::STATE_ERROR => 3,
    ];
}
