<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Plugin\PermissionExtension;

use Spryker\Shared\PermissionExtension\Dependency\Plugin\ExecutablePermissionPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetFacadeInterface getFacade()
 */
class AlterCartWithoutLimitPermissionPlugin extends AbstractPlugin implements ExecutablePermissionPluginInterface
{
    public const KEY = 'AlterCartWithoutLimitPermission';
    public const FIELD_ID_COMPANIES = 'id_companies';

    /**
     * @param array $configuration
     * @param int|string|array|null $context
     *
     * @return bool
     */
    public function can(array $configuration, $context = null): bool
    {
        if (!is_int($context)) {
            return false;
        }

        return $this->isCompanyIdInArray(
            $context,
            $this->getCompanyIdsFromConfigurationArray($configuration)
        );
    }

    /**
     * @param int $companyId
     * @param int[] $companyIds
     *
     * @return bool
     */
    protected function isCompanyIdInArray(int $companyId, array $companyIds): bool
    {
        return in_array($companyId, $companyIds, true);
    }

    /**
     * @param array $configuration
     *
     * @return int[]
     */
    protected function getCompanyIdsFromConfigurationArray(array $configuration): array
    {
        if (
            array_key_exists(static::FIELD_ID_COMPANIES, $configuration)
            && is_array($configuration[static::FIELD_ID_COMPANIES])
        ) {
            return $configuration[static::FIELD_ID_COMPANIES];
        }

        return [];
    }

    /**
     * @return string[]
     */
    public function getConfigurationSignature(): array
    {
        return [];
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return static::KEY;
    }
}
