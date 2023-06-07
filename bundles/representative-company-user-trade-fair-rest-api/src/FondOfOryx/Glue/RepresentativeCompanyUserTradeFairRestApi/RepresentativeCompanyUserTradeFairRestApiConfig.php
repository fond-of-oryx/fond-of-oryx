<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi;

use FondOfOryx\Shared\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConstants;
use Spryker\Glue\Kernel\AbstractBundleConfig;

class RepresentativeCompanyUserTradeFairRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API = 'representative-company-user-trade-fair';

    /**
     * @var string
     */
    public const CONTROLLER_RESOURCE_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API = 'representative-company-user-trade-fair-resource';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_USER_IS_NOT_ALLOWED_TO_ADD_TRADE_FAIR_REPRESENTATION = 'Missing permission to manage trade fair representations!';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_REPRESENTATION_DURATION_EXCEEDED = 'Duration for the representation has exceeded the allowed days!';

    /**
     * @var int
     */
    public const RESPONSE_CODE_USER_IS_NOT_ALLOWED_TO_ADD_TRADE_FAIR_REPRESENTATION = 0;

    /**
     * @var string
     */
    public const RESPONSE_CODE_REPRESENTATION_DURATION_EXCEEDED = '1';

    /**
     * @return int
     */
    public function getMaxDurationForRepresentation(): int
    {
        return $this->get(
            RepresentativeCompanyUserTradeFairRestApiConstants::MAX_DURATION_FOR_REPRESENTATION
        );
    }
}
