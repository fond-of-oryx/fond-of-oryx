<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector;

use FondOfOryx\Shared\CompanyUserMailConnector\CompanyUserMailConnectorConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class CompanyUserMailConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getRolesToInformAbout(): array
    {
        return $this->get(CompanyUserMailConnectorConstants::ROLES_TO_INFORM_ABOUT_LIST, CompanyUserMailConnectorConstants::ROLES_TO_INFORM_ABOUT_LIST_DEFAULT);
    }

    /**
     * @return array
     */
    public function getRolesToNotify(): array
    {
        return $this->get(CompanyUserMailConnectorConstants::ROLES_TO_NOTIFY, CompanyUserMailConnectorConstants::ROLES_TO_NOTIFY_DEFAULT);
    }
}
