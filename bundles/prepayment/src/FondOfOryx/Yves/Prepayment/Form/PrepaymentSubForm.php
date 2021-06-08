<?php

namespace FondOfOryx\Yves\Prepayment\Form;

use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrepaymentSubForm extends AbstractSubForm
{
    /**
     * @return string
     */
    protected function getTemplatePath()
    {
        return PrepaymentConstants::PROVIDER_NAME . '/' . PrepaymentConstants::PAYMENT_METHOD_PREPAYMENT;
    }

    /**
     * @return string
     */
    public function getPropertyPath()
    {
        return PrepaymentConstants::PREPAYMENT_PROPERTY_PATH;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return PrepaymentConstants::PREPAYMENT_PROPERTY_PATH;
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            SubFormInterface::OPTIONS_FIELD_NAME => [],
        ]);
    }

    /**
     * @param \Symfony\Component\Form\FormView $view The view
     * @param \Symfony\Component\Form\FormInterface $form The form
     * @param array $options The options
     *
     * @return void
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);

        $view->vars = array_merge($view->vars, $this->getAdditionalFormVars());
    }
}
