<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Form;

use Generated\Shared\Transfer\CompanyProductListConnectorFormTransfer;
use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @method \FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\CompanyProductListConnectorGuiCommunicationFactory getFactory()
 */
class CompanyProductListConnectorForm extends AbstractType
{
    /**
     * @var string
     */
    public const BLOCK_PREFIX = 'companyProductListConnectorGui';

    /**
     * @var string
     */
    public const FIELD_ID_COMPANY = CompanyProductListConnectorFormTransfer::ID_COMPANY;

    /**
     * @var string
     */
    public const FIELD_ASSIGNED_PRODUCT_LIST_IDS = CompanyProductListConnectorFormTransfer::ASSIGNED_PRODUCT_LIST_IDS;

    /**
     * @var string
     */
    public const FIELD_PRODUCT_LIST_IDS_TO_ASSIGN = CompanyProductListConnectorFormTransfer::PRODUCT_LIST_IDS_TO_ASSIGN;

    /**
     * @var string
     */
    public const FIELD_PRODUCT_LIST_IDS_TO_DE_ASSIGN = CompanyProductListConnectorFormTransfer::PRODUCT_LIST_IDS_TO_DE_ASSIGN;

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addIdCompanyField($builder)
            ->addAssignedProductListIdsField($builder)
            ->addProductListIdsToAssignField($builder)
            ->addProductListIdsToDeAssignField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addIdCompanyField(FormBuilderInterface $builder)
    {
        $builder->add(
            static::FIELD_ID_COMPANY,
            HiddenType::class,
        );

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addAssignedProductListIdsField(FormBuilderInterface $builder)
    {
        $builder->add(
            static::FIELD_ASSIGNED_PRODUCT_LIST_IDS,
            HiddenType::class,
        );

        $this->addModelTransformer(static::FIELD_ASSIGNED_PRODUCT_LIST_IDS, $builder);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addProductListIdsToAssignField(FormBuilderInterface $builder)
    {
        $builder->add(
            static::FIELD_PRODUCT_LIST_IDS_TO_ASSIGN,
            HiddenType::class,
        );

        $this->addModelTransformer(static::FIELD_PRODUCT_LIST_IDS_TO_ASSIGN, $builder);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addProductListIdsToDeAssignField(FormBuilderInterface $builder)
    {
        $builder->add(
            static::FIELD_PRODUCT_LIST_IDS_TO_DE_ASSIGN,
            HiddenType::class,
        );

        $this->addModelTransformer(static::FIELD_PRODUCT_LIST_IDS_TO_DE_ASSIGN, $builder);

        return $this;
    }

    /**
     * @param string $fieldName
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return void
     */
    protected function addModelTransformer(string $fieldName, FormBuilderInterface $builder): void
    {
        $builder
            ->get($fieldName)
            ->addModelTransformer(new CallbackTransformer(
                function ($idsAsArray) {
                    if (!count($idsAsArray)) {
                        return [];
                    }

                    return implode(',', $idsAsArray);
                },
                function ($idsAsCsvString) {
                    if ($idsAsCsvString === null) {
                        return [];
                    }

                    return explode(',', $idsAsCsvString);
                },
            ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return static::BLOCK_PREFIX;
    }

    /**
     * @deprecated Use {@link getBlockPrefix()} instead.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->getBlockPrefix();
    }
}
