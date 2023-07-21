<?php

namespace FondOfOryx\Zed\CompanyTypeConverter\Business;

use FondOfOryx\Zed\CompanyTypeConverter\Business\Model\CompanyReader;
use FondOfOryx\Zed\CompanyTypeConverter\Business\Model\CompanyReaderInterface;
use FondOfOryx\Zed\CompanyTypeConverter\Business\Model\CompanyTypeConverter;
use FondOfOryx\Zed\CompanyTypeConverter\Business\Model\CompanyTypeConverterInterface;
use FondOfOryx\Zed\CompanyTypeConverter\Business\Model\CompanyTypeConverterPluginExecutor;
use FondOfOryx\Zed\CompanyTypeConverter\Business\Model\CompanyTypeConverterPluginExecutorInterface;
use FondOfOryx\Zed\CompanyTypeConverter\Business\Model\CompanyTypeRoleWriter;
use FondOfOryx\Zed\CompanyTypeConverter\Business\Model\CompanyTypeRoleWriterInterface;
use FondOfOryx\Zed\CompanyTypeConverter\CompanyTypeConverterDependencyProvider;
use FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyFacadeInterface;
use FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyRoleFacadeInterface;
use FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyTypeFacadeInterface;
use FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyTypeRoleFacadeInterface;
use FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyUserFacadeInterface;
use FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToPermissionFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyTypeConverter\CompanyTypeConverterConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyTypeConverter\Persistence\CompanyTypeConverterRepositoryInterface getRepository()
 */
class CompanyTypeConverterBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyTypeConverter\Business\Model\CompanyTypeConverterInterface
     */
    public function createCompanyTypeConverter(): CompanyTypeConverterInterface
    {
        return new CompanyTypeConverter(
            $this->getCompanyTypeFacade(),
            $this->getCompanyRoleFacade(),
            $this->getCompanyUserFacade(),
            $this->createCompanyTypeRoleWriter(),
            $this->getConfig(),
            $this->createPluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeConverter\Business\Model\CompanyTypeRoleWriterInterface
     */
    protected function createCompanyTypeRoleWriter(): CompanyTypeRoleWriterInterface
    {
        return new CompanyTypeRoleWriter(
            $this->getCompanyRoleFacade(),
            $this->getCompanyTypeFacade(),
            $this->getCompanyTypeRoleFacade(),
            $this->getPermissionFacade(),
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeConverter\Business\Model\CompanyReaderInterface
     */
    public function createCompanyReader(): CompanyReaderInterface
    {
        return new CompanyReader(
            $this->getCompanyFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeConverter\Business\Model\CompanyTypeConverterPluginExecutorInterface
     */
    protected function createPluginExecutor(): CompanyTypeConverterPluginExecutorInterface
    {
        return new CompanyTypeConverterPluginExecutor(
            $this->getCompanyTypeConverterPreSavePlugins(),
            $this->getCompanyTypeConverterPostSavePlugins(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyTypeConverterExtension\Dependency\Plugin\CompanyTypeConverterPostSavePluginInterface[]
     */
    protected function getCompanyTypeConverterPreSavePlugins(): array
    {
        return $this->getProvidedDependency(CompanyTypeConverterDependencyProvider::COMPANY_TYPE_CONVERTER_PRE_SAVE_PLUGINS);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyTypeConverterExtension\Dependency\Plugin\CompanyTypeConverterPostSavePluginInterface[]
     */
    protected function getCompanyTypeConverterPostSavePlugins(): array
    {
        return $this->getProvidedDependency(CompanyTypeConverterDependencyProvider::COMPANY_TYPE_CONVERTER_POST_SAVE_PLUGINS);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyFacadeInterface
     */
    protected function getCompanyFacade(): CompanyTypeConverterToCompanyFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeConverterDependencyProvider::FACADE_COMPANY);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToPermissionFacadeInterface
     */
    protected function getPermissionFacade(): CompanyTypeConverterToPermissionFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeConverterDependencyProvider::FACADE_PERMISSION);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyRoleFacadeInterface
     */
    protected function getCompanyRoleFacade(): CompanyTypeConverterToCompanyRoleFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeConverterDependencyProvider::FACADE_COMPANY_ROLE);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyUserFacadeInterface
     */
    protected function getCompanyUserFacade(): CompanyTypeConverterToCompanyUserFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeConverterDependencyProvider::FACADE_COMPANY_USER);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyTypeFacadeInterface
     */
    protected function getCompanyTypeFacade(): CompanyTypeConverterToCompanyTypeFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeConverterDependencyProvider::FACADE_COMPANY_TYPE);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyTypeRoleFacadeInterface
     */
    protected function getCompanyTypeRoleFacade(): CompanyTypeConverterToCompanyTypeRoleFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeConverterDependencyProvider::FACADE_COMPANY_TYPE_ROLE);
    }
}
