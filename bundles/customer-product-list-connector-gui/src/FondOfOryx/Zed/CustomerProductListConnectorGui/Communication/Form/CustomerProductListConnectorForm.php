<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Form;

use Generated\Shared\Transfer\CustomerProductListConnectorFormTransfer;
use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @method \FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\CustomerProductListConnectorGuiCommunicationFactory getFactory()
 */
class CustomerProductListConnectorForm extends AbstractType
{
    /**
     * @var string
     */
    public const BLOCK_PREFIX = 'customerProductListConnectorGui';

    /**
     * @var string
     */
    public const FIELD_ID_CUSTOMER = CustomerProductListConnectorFormTransfer::ID_CUSTOMER;

    /**
     * @var string
     */
    public const FIELD_ASSIGNED_PRODUCT_LIST_IDS = CustomerProductListConnectorFormTransfer::ASSIGNED_PRODUCT_LIST_IDS;

    /**
     * @var string
     */
    public const FIELD_PRODUCT_LIST_IDS_TO_ASSIGN = CustomerProductListConnectorFormTransfer::PRODUCT_LIST_IDS_TO_ASSIGN;

    /**
     * @var string
     */
    public const FIELD_PRODUCT_LIST_IDS_TO_DE_ASSIGN = CustomerProductListConnectorFormTransfer::PRODUCT_LIST_IDS_TO_DE_ASSIGN;

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addIdCustomerField($builder)
            ->addAssignedProductListIdsField($builder)
            ->addProductListIdsToAssignField($builder)
            ->addProductListIdsToDeAssignField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addIdCustomerField(FormBuilderInterface $builder)
    {
        $builder->add(
            static::FIELD_ID_CUSTOMER,
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
                    if (empty($idsAsCsvString)) {
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
