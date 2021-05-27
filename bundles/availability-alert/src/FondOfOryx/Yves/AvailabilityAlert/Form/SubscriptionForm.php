<?php

namespace FondOfOryx\Yves\AvailabilityAlert\Form;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Spryker\Yves\Kernel\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class SubscriptionForm extends AbstractType
{
    public const FIELD_PRODUCT_ABSTRACT = AvailabilityAlertSubscriptionRequestTransfer::ID_PRODUCT_ABSTRACT;
    public const FIELD_PRODUCT_CONCRETE = AvailabilityAlertSubscriptionRequestTransfer::ID_PRODUCT_CONCRETE;
    public const FIELD_EMAIL = AvailabilityAlertSubscriptionRequestTransfer::EMAIL;

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'availabilityAlertSubscriptionForm';
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $this->addEmailField($builder)
            ->addProductAbstractField($builder)
            ->addProductConcreteField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addEmailField(FormBuilderInterface $builder): SubscriptionForm
    {
        $builder->add(static::FIELD_EMAIL, EmailType::class, [
            'label' => 'availability_alert.submit.email',
            'required' => true,
            'constraints' => [
                new NotBlank(),
            ],
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addProductAbstractField(FormBuilderInterface $builder): SubscriptionForm
    {
        $builder->add(static::FIELD_PRODUCT_ABSTRACT, HiddenType::class, [
            'required' => true,
            'constraints' => [
                new NotBlank(),
            ],
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addProductConcreteField(FormBuilderInterface $builder): SubscriptionForm
    {
        $builder->add(static::FIELD_PRODUCT_CONCRETE, HiddenType::class, [
            'required' => true,
        ]);

        return $this;
    }
}
