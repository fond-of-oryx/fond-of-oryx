<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacade;
use FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Api\Business\Exception\ApiDispatchingException;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class ThirtyFiveUpApiResourcePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Communication\Plugin\Api\ThirtyFiveUpApiResourcePlugin
     */
    protected $plugin;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(ThirtyFiveUpApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new class ($this->facadeMock) extends ThirtyFiveUpApiResourcePlugin {
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
    public function testGet(): void
    {
        $catch = null;
        try {
            $this->plugin->get(1);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        $this->assertNotNull($catch);
        $this->assertInstanceOf(ApiDispatchingException::class, $catch);
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->facadeMock->expects($this->once())->method('updateThirtyFiveUpOrder')->willReturn($this->apiItemTransferMock);
        $this->plugin->update(1, $this->apiDataTransferMock);
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $catch = null;
        try {
            $this->plugin->add($this->apiDataTransferMock);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        $this->assertNotNull($catch);
        $this->assertInstanceOf(ApiDispatchingException::class, $catch);
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $catch = null;
        try {
            $this->plugin->remove(1);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        $this->assertNotNull($catch);
        $this->assertInstanceOf(ApiDispatchingException::class, $catch);
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->facadeMock->expects($this->once())->method('findThirtyFiveUpOrder')->willReturn($this->apiCollectionTransferMock);
        $this->plugin->find($this->apiRequestTransferMock);
    }
}
