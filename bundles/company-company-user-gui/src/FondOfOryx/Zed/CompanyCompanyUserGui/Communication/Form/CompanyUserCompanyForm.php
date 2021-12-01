<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Form;

use Spryker\Zed\Gui\Communication\Form\Type\SelectType;
use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @method \FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\CompanyCompanyUserGuiCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\CompanyCompanyUserGui\CompanyCompanyUserGuiConfig getConfig()
 */
class CompanyUserCompanyForm extends AbstractType
{
    /**
     * @var string
     */
    public const FIELD_FK_COMPANY = 'fk_company';

    /**
     * @var string
     */
    protected const TEMPLATE_PATH = '@CompanyCompanyUserGui/CompanyUser/company.twig';

    /**
     * @uses \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Controller\SuggestController::indexAction()
     *
     * @var string
     */
    protected const ROUTE_SUGGEST = '/company-company-user-gui/suggest';

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addIdCompanyField($builder, $options);

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $formEvent): void {
            $this->companySearchPreSubmitHandler($formEvent);
        });
    }

    /**
     * @param \Symfony\Component\Form\FormEvent $formEvent
     *
     * @return void
     */
    public function companySearchPreSubmitHandler(FormEvent $formEvent): void
    {
        $data = $formEvent->getData();
        $form = $formEvent->getForm();

        if (!isset($data[static::FIELD_FK_COMPANY])) {
            return;
        }

        $companyChoices = $this->getFactory()
            ->createCompanyUserCompanyFormDataProvider()
            ->getOptions($data[static::FIELD_FK_COMPANY]);

        $form->add(
            static::FIELD_FK_COMPANY,
            SelectType::class,
            $this->getCompanyFieldParameters($companyChoices),
        );
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return $this
     */
    protected function addIdCompanyField(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            static::FIELD_FK_COMPANY,
            SelectType::class,
            $this->getCompanyFieldParameters($options),
        );

        return $this;
    }

    /**
     * @param array $companyChoices
     *
     * @return array
     */
    protected function getCompanyFieldParameters(array $companyChoices = []): array
    {
        return [
            'label' => 'Company',
            'choices' => $companyChoices,
            'attr' => [
                'placeholder' => 'Type first two letters of an existing Company for suggestions.',
                'template_path' => $this->getTemplatePath(),
            ],
            'url' => static::ROUTE_SUGGEST,
            'required' => true,
            'constraints' => [
                new NotBlank(),
            ],
        ];
    }

    /**
     * @return string
     */
    protected function getTemplatePath(): string
    {
        return static::TEMPLATE_PATH;
    }
}
