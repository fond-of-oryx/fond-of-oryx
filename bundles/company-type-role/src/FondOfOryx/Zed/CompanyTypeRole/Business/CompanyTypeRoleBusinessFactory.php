<?php

namespace FondOfOryx\Zed\CompanyTypeRole\Business;

use FondOfOryx\Zed\CompanyTypeRole\Business\Builder\CompanyRoleCriteriaFilterBuilder;
use FondOfOryx\Zed\CompanyTypeRole\Business\Builder\CompanyRoleCriteriaFilterBuilderInterface;
use FondOfOryx\Zed\CompanyTypeRole\Business\CompanyTypeRoleExportValidator\CompanyTypeRoleExportValidator;
use FondOfOryx\Zed\CompanyTypeRole\Business\CompanyTypeRoleExportValidator\CompanyTypeRoleExportValidatorInterface;
use FondOfOryx\Zed\CompanyTypeRole\Business\Filter\CompanyTypeNameFilter;
use FondOfOryx\Zed\CompanyTypeRole\Business\Filter\CompanyTypeNameFilterInterface;
use FondOfOryx\Zed\CompanyTypeRole\Business\Generator\AssignPermissionKeyGenerator;
use FondOfOryx\Zed\CompanyTypeRole\Business\Generator\AssignPermissionKeyGeneratorInterface;
use FondOfOryx\Zed\CompanyTypeRole\Business\Intersection\PermissionIntersection;
use FondOfOryx\Zed\CompanyTypeRole\Business\Intersection\PermissionIntersectionInterface;
use FondOfOryx\Zed\CompanyTypeRole\Business\Model\CompanyRoleAssigner;
use FondOfOryx\Zed\CompanyTypeRole\Business\Model\CompanyRoleAssignerInterface;
use FondOfOryx\Zed\CompanyTypeRole\Business\Model\PermissionReader;
use FondOfOryx\Zed\CompanyTypeRole\Business\Model\PermissionReaderInterface;
use FondOfOryx\Zed\CompanyTypeRole\Business\Reader\AssignableCompanyRoleReader;
use FondOfOryx\Zed\CompanyTypeRole\Business\Reader\AssignableCompanyRoleReaderInterface;
use FondOfOryx\Zed\CompanyTypeRole\Business\Reader\CompanyUserReader;
use FondOfOryx\Zed\CompanyTypeRole\Business\Reader\CompanyUserReaderInterface;
use FondOfOryx\Zed\CompanyTypeRole\Business\Synchronizer\CompanyRoleSynchronizer;
use FondOfOryx\Zed\CompanyTypeRole\Business\Synchronizer\CompanyRoleSynchronizerInterface;
use FondOfOryx\Zed\CompanyTypeRole\Business\Synchronizer\PermissionSynchronizer;
use FondOfOryx\Zed\CompanyTypeRole\Business\Synchronizer\PermissionSynchronizerInterface;
use FondOfOryx\Zed\CompanyTypeRole\CompanyTypeRoleDependencyProvider;
use FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyFacadeInterface;
use FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyRoleFacadeInterface;
use FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyTypeFacadeInterface;
use FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyUserFacadeInterface;
use FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToPermissionFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyTypeRole\CompanyTypeRoleConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyTypeRole\Persistence\CompanyTypeRoleRepositoryInterface getRepository()
 */
class CompanyTypeRoleBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Business\Model\CompanyRoleAssignerInterface
     */
    public function createCompanyRoleAssigner(): CompanyRoleAssignerInterface
    {
        return new CompanyRoleAssigner(
            $this->getConfig(),
            $this->getCompanyRoleFacade(),
            $this->getCompanyTypeFacade(),
            $this->getPermissionFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Business\Model\PermissionReaderInterface
     */
    public function createPermissionReader(): PermissionReaderInterface
    {
        return new PermissionReader($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Business\CompanyTypeRoleExportValidator\CompanyTypeRoleExportValidatorInterface
     */
    public function createCompanyTypeRoleExportValidator(): CompanyTypeRoleExportValidatorInterface
    {
        return new CompanyTypeRoleExportValidator(
            $this->getCompanyUserFacade(),
            $this->getCompanyTypeFacade(),
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Business\Synchronizer\PermissionSynchronizerInterface
     */
    public function createPermissionSynchronizer(): PermissionSynchronizerInterface
    {
        return new PermissionSynchronizer(
            $this->createCompanyTypeNameFilter(),
            $this->createPermissionIntersection(),
            $this->createCompanyRoleCriteriaFilterBuilder(),
            $this->getCompanyRoleFacade(),
            $this->getPermissionFacade(),
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Business\Synchronizer\CompanyRoleSynchronizerInterface
     */
    public function createCompanyRoleSynchronizer(): CompanyRoleSynchronizerInterface
    {
        return new CompanyRoleSynchronizer(
            $this->getCompanyFacade(),
            $this->getCompanyRoleFacade(),
            $this->getCompanyTypeFacade(),
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Business\Reader\AssignableCompanyRoleReaderInterface
     */
    public function createAssignableCompanyRoleReader(): AssignableCompanyRoleReaderInterface
    {
        return new AssignableCompanyRoleReader(
            $this->createAssignPermissionKeyGenerator(),
            $this->createCompanyUserReader(),
            $this->getCompanyRoleFacade(),
            $this->getPermissionFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Business\Generator\AssignPermissionKeyGeneratorInterface
     */
    protected function createAssignPermissionKeyGenerator(): AssignPermissionKeyGeneratorInterface
    {
        return new AssignPermissionKeyGenerator();
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Business\Reader\CompanyUserReaderInterface
     */
    protected function createCompanyUserReader(): CompanyUserReaderInterface
    {
        return new CompanyUserReader(
            $this->getCompanyUserFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Business\Filter\CompanyTypeNameFilterInterface
     */
    protected function createCompanyTypeNameFilter(): CompanyTypeNameFilterInterface
    {
        return new CompanyTypeNameFilter($this->getCompanyTypeFacade());
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Business\Intersection\PermissionIntersectionInterface
     */
    protected function createPermissionIntersection(): PermissionIntersectionInterface
    {
        return new PermissionIntersection();
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Business\Builder\CompanyRoleCriteriaFilterBuilderInterface
     */
    protected function createCompanyRoleCriteriaFilterBuilder(): CompanyRoleCriteriaFilterBuilderInterface
    {
        return new CompanyRoleCriteriaFilterBuilder();
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyUserFacadeInterface
     */
    protected function getCompanyUserFacade(): CompanyTypeRoleToCompanyUserFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeRoleDependencyProvider::FACADE_COMPANY_USER);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyFacadeInterface
     */
    protected function getCompanyFacade(): CompanyTypeRoleToCompanyFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeRoleDependencyProvider::FACADE_COMPANY);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyRoleFacadeInterface
     */
    protected function getCompanyRoleFacade(): CompanyTypeRoleToCompanyRoleFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeRoleDependencyProvider::FACADE_COMPANY_ROLE);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyTypeFacadeInterface
     */
    protected function getCompanyTypeFacade(): CompanyTypeRoleToCompanyTypeFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeRoleDependencyProvider::FACADE_COMPANY_TYPE);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToPermissionFacadeInterface
     */
    protected function getPermissionFacade(): CompanyTypeRoleToPermissionFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeRoleDependencyProvider::FACADE_PERMISSION);
    }
}
