<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Communication;

use FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Form\CompanyUserCompanyForm;
use FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Form\DataProvider\CompanyUserCompanyFormDataProvider;
use FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Mapper\SuggestionMapper;
use FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Mapper\SuggestionMapperInterface;
use FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Reader\SuggestionReader;
use FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Reader\SuggestionReaderInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CompanyCompanyUserGui\CompanyCompanyUserGuiConfig getConfig()
 */
class CompanyCompanyUserGuiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Form\DataProvider\CompanyUserCompanyFormDataProvider
     */
    public function createCompanyUserCompanyFormDataProvider(): CompanyUserCompanyFormDataProvider
    {
        return new CompanyUserCompanyFormDataProvider($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Form\CompanyUserCompanyForm
     */
    public function createCompanyUserCompanyForm(): CompanyUserCompanyForm
    {
        return new CompanyUserCompanyForm();
    }

    /**
     * @return \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Reader\SuggestionReaderInterface
     */
    public function createSuggestionReader(): SuggestionReaderInterface
    {
        return new SuggestionReader(
            $this->createSuggestionMapper(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Mapper\SuggestionMapperInterface
     */
    protected function createSuggestionMapper(): SuggestionMapperInterface
    {
        return new SuggestionMapper();
    }
}
