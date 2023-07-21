<?php

namespace FondOfOryx\Zed\CompanyTypeConverter;

use FondOfOryx\Shared\CompanyTypeConverter\CompanyTypeConverterConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CompanyTypeConverterConfig extends AbstractBundleConfig
{
    /**
     * @param string $companyType
     *
     * @return string[]
     */
    public function getCompanyTypeDefaultRoleMapping(string $companyType = ''): array
    {
        $companyTypeDefaultRolesMapping = $this->get(CompanyTypeConverterConstants::COMPANY_TYPE_DEFAULT_ROLES_MAPPING);

        if ($companyType === '') {
            return $companyTypeDefaultRolesMapping;
        }

        if (!isset($companyTypeDefaultRolesMapping[$companyType])) {
            return [];
        }

        return $companyTypeDefaultRolesMapping[$companyType];
    }
}
