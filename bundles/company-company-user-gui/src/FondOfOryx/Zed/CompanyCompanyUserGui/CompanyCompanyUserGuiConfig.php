<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui;

use FondOfOryx\Shared\CompanyCompanyUserGui\CompanyCompanyUserGuiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CompanyCompanyUserGuiConfig extends AbstractBundleConfig
{
    /**
     * @return int
     */
    public function getSuggestionLimit(): int
    {
        return $this->get(
            CompanyCompanyUserGuiConstants::SUGGESTION_LIMIT,
            CompanyCompanyUserGuiConstants::SUGGESTION_LIMIT_DEFAULT,
        );
    }
}
