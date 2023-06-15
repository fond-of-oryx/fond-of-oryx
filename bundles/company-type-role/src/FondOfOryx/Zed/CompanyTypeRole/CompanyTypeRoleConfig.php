<?php

namespace FondOfOryx\Zed\CompanyTypeRole;

use FondOfOryx\Shared\CompanyTypeRole\CompanyTypeRoleConstants;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\PermissionCollectionTransfer;
use Generated\Shared\Transfer\PermissionTransfer;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CompanyTypeRoleConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const ROLE_NAME_SUPER_ADMINISTRATION = 'super_administration';

    /**
     * @var string
     */
    public const ROLE_NAME_CUSTOMER_SERVICE = 'customer_service';

    /**
     * @var string
     */
    public const ROLE_NAME_DISTRIBUTION = 'distribution';

    /**
     * @var string
     */
    public const ROLE_NAME_SUPER_DISTRIBUTION = 'super_distribution';

    /**
     * @var string
     */
    public const ROLE_NAME_ADMINISTRATION = 'administration';

    /**
     * @var string
     */
    public const ROLE_NAME_MARKETING = 'marketing';

    /**
     * @var string
     */
    public const ROLE_NAME_PURCHASE = 'purchase';

    /**
     * @var string
     */
    public const ROLE_NAME_SALES_COORDINATION = 'sales_coordination';

    /**
     * @param string $companyTypeName
     *
     * @return array<\Generated\Shared\Transfer\CompanyRoleTransfer>
     */
    public function getPredefinedCompanyRolesByCompanyTypeName(string $companyTypeName): array
    {
        if (!$this->isValidCompanyTypeName($companyTypeName)) {
            return [];
        }

        $predefinedRoles = [
            $this->createCompanyRole($companyTypeName, static::ROLE_NAME_ADMINISTRATION, true),
            $this->createCompanyRole($companyTypeName, static::ROLE_NAME_DISTRIBUTION, false),
            $this->createCompanyRole($companyTypeName, static::ROLE_NAME_SUPER_DISTRIBUTION, false),
            $this->createCompanyRole($companyTypeName, static::ROLE_NAME_CUSTOMER_SERVICE, false),
            $this->createCompanyRole($companyTypeName, static::ROLE_NAME_SALES_COORDINATION, false),
        ];

        if ($companyTypeName === 'manufacturer') {
            return $predefinedRoles;
        }

        $predefinedRoles = array_merge($predefinedRoles, [
            $this->createCompanyRole($companyTypeName, static::ROLE_NAME_SUPER_ADMINISTRATION, false),
            $this->createCompanyRole($companyTypeName, static::ROLE_NAME_MARKETING, false),
        ]);

        if ($companyTypeName !== 'retailer') {
            return $predefinedRoles;
        }

        return array_merge($predefinedRoles, [
            $this->createCompanyRole($companyTypeName, static::ROLE_NAME_PURCHASE, false),
        ]);
    }

    /**
     * @param string $companyType
     *
     * @return array<string>
     */
    public function getValidCompanyRolesForExport(string $companyType = ''): array
    {
        $companyRoles = $this->get(CompanyTypeRoleConstants::VALID_COMPANY_ROLES_FOR_EXPORT);

        if ($companyType === '') {
            return $companyRoles;
        }

        return $companyRoles[$companyType] ?? [];
    }

    /**
     * @param string $companyTypeName
     *
     * @return bool
     */
    protected function isValidCompanyTypeName(string $companyTypeName): bool
    {
        $validCompanyTypeNames = $this->get(CompanyTypeRoleConstants::VALID_COMPANY_TYPE_NAMES);

        return in_array($companyTypeName, $validCompanyTypeNames, true);
    }

    /**
     * @param string $companyTypeName
     * @param string $companyTypeRoleName
     * @param bool $isDefault
     *
     * @return \Generated\Shared\Transfer\CompanyRoleTransfer
     */
    protected function createCompanyRole(
        string $companyTypeName,
        string $companyTypeRoleName,
        bool $isDefault
    ): CompanyRoleTransfer {
        $permissionKeys = $this->getPermissionKeys($companyTypeName, $companyTypeRoleName);
        $permissionCollection = $this->createPermissionCollectionFromPermissionKeys($permissionKeys);

        return (new CompanyRoleTransfer())
            ->setName($companyTypeRoleName)
            ->setIsDefault($isDefault)
            ->setPermissionCollection($permissionCollection);
    }

    /**
     * @param string $companyTypeName
     * @param string $roleName
     *
     * @return array<string>
     */
    public function getPermissionKeys(string $companyTypeName, string $roleName): array
    {
        $permissionKeys = $this->get(CompanyTypeRoleConstants::PERMISSION_KEYS, []);

        if (!array_key_exists($companyTypeName, $permissionKeys)) {
            return [];
        }

        if (!array_key_exists($roleName, $permissionKeys[$companyTypeName])) {
            return [];
        }

        return $permissionKeys[$companyTypeName][$roleName];
    }

    /**
     * @param array<string> $permissionKeys
     *
     * @return \Generated\Shared\Transfer\PermissionCollectionTransfer
     */
    protected function createPermissionCollectionFromPermissionKeys(array $permissionKeys): PermissionCollectionTransfer
    {
        $permissions = new PermissionCollectionTransfer();

        foreach ($permissionKeys as $permissionKey) {
            $permission = (new PermissionTransfer())
                ->setKey($permissionKey);
            $permissions->addPermission($permission);
        }

        return $permissions;
    }
}
