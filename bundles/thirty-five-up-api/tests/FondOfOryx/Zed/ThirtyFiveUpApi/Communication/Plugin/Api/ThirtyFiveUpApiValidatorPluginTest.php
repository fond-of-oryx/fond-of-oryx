<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacade;
use FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class ThirtyFiveUpApiValidatorPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Communication\Plugin\Api\ThirtyFiveUpApiValidatorPlugin
     */
    protected $plugin;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->facadeMock = $this->getMockBuilder(ThirtyFiveUpApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new class ($this->facadeMock) extends ThirtyFiveUpApiValidatorPlugin {
            /**
             * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface
             */
            public $facade;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface $thirtyFiveUpFacade
             */
            public function __construct(ThirtyFiveUpApiFacadeInterface $thirtyFiveUpFacade)
            {
                $this->facade = $thirtyFiveUpFacade;
            }

            /**
             * @return \FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface|\Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->facade;
            }
        };
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('validate')
            ->willReturn([]);

        static::assertEquals(
            [],
            $this->plugin->validate($this->apiRequestTransferMock),
        );
    }
}
