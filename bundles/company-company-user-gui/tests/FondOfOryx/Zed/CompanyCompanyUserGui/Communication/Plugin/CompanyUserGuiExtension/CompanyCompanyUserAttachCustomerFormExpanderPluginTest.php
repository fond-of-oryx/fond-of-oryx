<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Plugin\CompanyUserGuiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyCompanyUserGui\Communication\CompanyCompanyUserGuiCommunicationFactory;
use FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Form\CompanyUserCompanyForm;
use FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Form\DataProvider\CompanyUserCompanyFormDataProvider;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;

class CompanyCompanyUserAttachCustomerFormExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\CompanyCompanyUserGuiCommunicationFactory|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\Form\FormBuilderInterface|mixed
     */
    protected $formBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\Form\FormInterface|mixed
     */
    protected $generalFormMock;

    /**
     * @var \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Form\CompanyUserCompanyForm|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $formMock;

    /**
     * @var \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Form\DataProvider\CompanyUserCompanyFormDataProvider|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $formDataProviderMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Plugin\CompanyUserGuiExtension\CompanyCompanyUserAttachCustomerFormExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanyCompanyUserGuiCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->formBuilderMock = $this->getMockBuilder(FormBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->generalFormMock = $this->getMockBuilder(FormInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->formMock = $this->getMockBuilder(CompanyUserCompanyForm::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->formDataProviderMock = $this->getMockBuilder(CompanyUserCompanyFormDataProvider::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyCompanyUserAttachCustomerFormExpanderPlugin();
        $this->plugin->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $fkCompany = 1;
        $options = ['foo' => 1];

        $this->formBuilderMock->expects(static::atLeastOnce())
            ->method('getForm')
            ->willReturn($this->generalFormMock);

        $this->generalFormMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(CompanyUserCompanyForm::FIELD_FK_COMPANY)
            ->willReturn(true);

        $this->generalFormMock->expects(static::atLeastOnce())
            ->method('remove')
            ->with(CompanyUserCompanyForm::FIELD_FK_COMPANY)
            ->willReturn($this->generalFormMock);

        $this->formBuilderMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn($fkCompany);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserCompanyFormDataProvider')
            ->willReturn($this->formDataProviderMock);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserCompanyForm')
            ->willReturn($this->formMock);

        $this->formDataProviderMock->expects(static::atLeastOnce())
            ->method('getOptions')
            ->with($fkCompany)
            ->willReturn($options);

        $this->formMock->expects(static::atLeastOnce())
            ->method('buildForm')
            ->with($this->formBuilderMock, $options);

        static::assertEquals(
            $this->formBuilderMock,
            $this->plugin->expand($this->formBuilderMock),
        );
    }
}
