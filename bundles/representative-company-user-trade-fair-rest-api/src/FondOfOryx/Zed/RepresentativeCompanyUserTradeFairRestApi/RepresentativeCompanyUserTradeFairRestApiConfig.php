<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi;

use FondOfOryx\Shared\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class RepresentativeCompanyUserTradeFairRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const ERROR_MESSAGE_USER_IS_NOT_ALLOWED_TO_ADD_TRADE_FAIR_REPRESENTATION = 'Missing permission to manage trade fair representations!';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_REPRESENTATION_DURATION_EXCEEDED = 'Duration for the representation has exceeded the allowed days!';

    /**
     * @return int
     */
    public function getMaxDurationForRepresentation(): int
    {
        return $this->get(
            RepresentativeCompanyUserTradeFairRestApiConstants::MAX_DURATION_FOR_REPRESENTATION,
            7,
        );
    }
}
