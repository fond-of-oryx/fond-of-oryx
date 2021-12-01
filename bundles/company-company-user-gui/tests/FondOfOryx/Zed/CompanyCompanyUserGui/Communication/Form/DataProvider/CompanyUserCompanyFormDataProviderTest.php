<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Form\DataProvider;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepositoryInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyUserCompanyFormDataProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Form\DataProvider\CompanyUserCompanyFormDataProvider
     */
    protected $formDataProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyCompanyUserGuiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->formDataProvider = new CompanyUserCompanyFormDataProvider($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetOptionsWithNullableIdCompany(): void
    {
        $this->repositoryMock->expects(static::never())
            ->method('getByIdCompany');

        static::assertCount(0, $this->formDataProvider->getOptions(null));
    }

    /**
     * @return void
     */
    public function testGetOptionsWithNonExistingCompany(): void
    {
        $idCompany = 1;

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getByIdCompany')
            ->with($idCompany)
            ->willReturn(null);

        static::assertCount(0, $this->formDataProvider->getOptions($idCompany));
    }

    /**
     * @return void
     */
    public function testGetOptions(): void
    {
        $idCompany = 1;
        $name = 'foo';

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getByIdCompany')
            ->with($idCompany)
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($name);

        $options = $this->formDataProvider->getOptions($idCompany);

        static::assertCount(1, $options);
        static::assertArrayHasKey($name, $options);
    }
}
