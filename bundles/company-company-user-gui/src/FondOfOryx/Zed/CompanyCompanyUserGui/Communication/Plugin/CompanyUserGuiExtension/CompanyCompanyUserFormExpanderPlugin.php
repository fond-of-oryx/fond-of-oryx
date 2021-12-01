<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Plugin\CompanyUserGuiExtension;

use FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Form\CompanyUserCompanyForm;
use Spryker\Zed\CompanyUserGuiExtension\Dependency\Plugin\CompanyUserFormExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @method \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\CompanyCompanyUserGuiCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\CompanyCompanyUserGui\CompanyCompanyUserGuiConfig getConfig()
 */
class CompanyCompanyUserFormExpanderPlugin extends AbstractPlugin implements CompanyUserFormExpanderPluginInterface
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return \Symfony\Component\Form\FormBuilderInterface
     */
    public function expand(FormBuilderInterface $builder): FormBuilderInterface
    {
        $form = $builder->getForm();

        if ($form->has(CompanyUserCompanyForm::FIELD_FK_COMPANY)) {
            $form->remove(CompanyUserCompanyForm::FIELD_FK_COMPANY);
        }

        $idCompany = $builder->getData()
            ->getFkCompany();

        $dataProvider = $this->getFactory()
            ->createCompanyUserCompanyFormDataProvider();

        $this->getFactory()
            ->createCompanyUserCompanyForm()
            ->buildForm(
                $builder,
                $dataProvider->getOptions($idCompany),
            );

        return $builder;
    }
}
