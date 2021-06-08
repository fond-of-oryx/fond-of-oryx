<?php

namespace FondOfOryx\Yves\Prepayment\Form;

use Codeception\Test\Unit;
use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use FondOfOryx\Yves\Prepayment\PrepaymentFactory;
use Spryker\Yves\Kernel\FactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrepaymentSubFormTest extends Unit
{
    /**
     * @var \Symfony\Component\OptionsResolver\OptionsResolver|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $optionsResolverMock;

    /**
     * @var \Symfony\Component\Form\FormView|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $formViewMock;

    /**
     * @var \FondOfOryx\Yves\Prepayment\PrepaymentFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Symfony\Component\Form\FormInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $formMock;

    /**
     * @var \FondOfOryx\Yves\Prepayment\Form\AbstractSubForm
     */
    protected $subForm;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->optionsResolverMock = $this->getMockBuilder(OptionsResolver::class)->disableOriginalConstructor()->getMock();
        $this->formViewMock = $this->getMockBuilder(FormView::class)->disableOriginalConstructor()->getMock();
        $this->formMock = $this->getMockBuilder(FormInterface::class)->disableOriginalConstructor()->getMock();
        $this->factoryMock = $this->getMockBuilder(PrepaymentFactory::class)->disableOriginalConstructor()->getMock();

        $this->subForm = new class ($this->factoryMock) extends PrepaymentSubForm{
            /**
             * @var \FondOfOryx\Yves\Prepayment\PrepaymentFactory
             */
            protected $factoryMock;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Yves\Prepayment\PrepaymentFactory $factory
             */
            public function __construct(PrepaymentFactory $factory)
            {
                $this->factoryMock = $factory;
            }

            /**
             * @return \Spryker\Yves\Kernel\FactoryInterface
             */
            protected function getFactory(): FactoryInterface
            {
                return $this->factoryMock;
            }
        };
    }

    /**
     * @return void
     */
    public function testGetTemplatePath(): void
    {
        static::assertSame(PrepaymentConstants::PREPAYMENT_PROPERTY_PATH, $this->subForm->getPropertyPath());
    }

    /**
     * @return void
     */
    public function testName(): void
    {
        static::assertSame(PrepaymentConstants::PREPAYMENT_PROPERTY_PATH, $this->subForm->getName());
    }

    /**
     * @return void
     */
    public function testConfigureOptions(): void
    {
        $this->optionsResolverMock->expects(static::once())->method('setDefaults');
        $this->subForm->configureOptions($this->optionsResolverMock);
    }

    /**
     * @return void
     */
    public function testBuildView(): void
    {
        $compareTo = [
            '1',
            'template_path' => PrepaymentConstants::PROVIDER_NAME . '/' . PrepaymentConstants::PAYMENT_METHOD_PREPAYMENT,
            '2',
        ];
        $this->factoryMock->expects(static::once())->method('createAdditionalFormVars')->willReturn(['2']);
        $this->formViewMock->vars = ['1'];
        $this->subForm->buildView($this->formViewMock, $this->formMock, []);
        static::assertSame($compareTo, $this->formViewMock->vars);
    }
}
