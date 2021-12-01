<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Communication;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Form\CompanyUserCompanyForm;
use FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Form\DataProvider\CompanyUserCompanyFormDataProvider;
use FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Reader\SuggestionReader;
use FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepository;

class CompanyCompanyUserGuiCommunicationFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\CompanyCompanyUserGuiCommunicationFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyCompanyUserGuiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyCompanyUserGuiCommunicationFactory();
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserCompanyFormDataProvider(): void
    {
        static::assertInstanceOf(
            CompanyUserCompanyFormDataProvider::class,
            $this->factory->createCompanyUserCompanyFormDataProvider(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserCompanyForm(): void
    {
        static::assertInstanceOf(
            CompanyUserCompanyForm::class,
            $this->factory->createCompanyUserCompanyForm(),
        );
    }

    /**
     * @return void
     */
    public function testCreateSuggestionReader(): void
    {
        static::assertInstanceOf(
            SuggestionReader::class,
            $this->factory->createSuggestionReader(),
        );
    }
}
