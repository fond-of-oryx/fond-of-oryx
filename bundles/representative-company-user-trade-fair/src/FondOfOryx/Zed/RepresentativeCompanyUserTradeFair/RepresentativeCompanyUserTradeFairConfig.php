<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair;

use FondOfOryx\Shared\RepresentativeCompanyUserTradeFair\RepresentativeCompanyUserTradeFairConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class RepresentativeCompanyUserTradeFairConfig extends AbstractBundleConfig
{
    /**
     * @return array<int, string>
     */
    public function getRolesToRepresent(): array
    {
        return $this->get(RepresentativeCompanyUserTradeFairConstants::CONFIG_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_ROLES_TO_REPRESENT, RepresentativeCompanyUserTradeFairConstants::CONFIG_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_ROLES_TO_REPRESENT_DEFAULT);
    }
}
