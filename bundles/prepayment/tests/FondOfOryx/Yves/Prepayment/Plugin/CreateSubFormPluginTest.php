<?php

namespace FondOfOryx\Yves\Prepayment\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Yves\Prepayment\Form\PrepaymentSubForm;
use FondOfOryx\Yves\Prepayment\PrepaymentFactory;
use Spryker\Yves\Kernel\FactoryInterface;
use Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface;

class CreateSubFormPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Yves\Prepayment\PrepaymentFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $prepaymentSubFormMock;

    /**
     * @var \Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $dataProviderMock;

    /**
     * @var \Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(PrepaymentFactory::class)->disableOriginalConstructor()->getMock();
        $this->prepaymentSubFormMock = $this->getMockBuilder(PrepaymentSubForm::class)->disableOriginalConstructor()->getMock();
        $this->dataProviderMock = $this->getMockBuilder(StepEngineFormDataProviderInterface::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new class ($this->factoryMock) extends PrepaymentSubFormPlugin {
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
    public function testCreateSubForm(): void
    {
        $this->factoryMock->expects(static::once())->method('createPrepaymentForm')->willReturn($this->prepaymentSubFormMock);

        $this->plugin->createSubForm();
    }

    /**
     * @return void
     */
    public function testCreateSubFormDataProvider(): void
    {
        $this->factoryMock->expects(static::once())->method('createPrepaymentFormDataProvider')->willReturn($this->dataProviderMock);

        $this->plugin->createSubFormDataProvider();
    }
}
