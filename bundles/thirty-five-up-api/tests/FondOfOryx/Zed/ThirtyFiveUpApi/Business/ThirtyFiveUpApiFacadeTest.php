<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\ThirtyFiveUpOrderApi;
use FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\Validator\ThirtyFiveUpApiValidator;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ThirtyFiveUpApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface
     */
    protected $facade;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

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
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\ThirtyFiveUpOrderApiInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpApiMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\Validator\ThirtyFiveUpApiValidatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpApiValidatorMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(ThirtyFiveUpApiBusinessFactory::class)
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

        $this->thirtyFiveUpApiMock = $this->getMockBuilder(ThirtyFiveUpOrderApi::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpApiValidatorMock = $this->getMockBuilder(ThirtyFiveUpApiValidator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new class ($this->factoryMock) extends ThirtyFiveUpApiFacade {
            /**
             * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiBusinessFactory
             */
            public $factory;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiBusinessFactory $thirtyFiveUpFactory
             */
            public function __construct(ThirtyFiveUpApiBusinessFactory $thirtyFiveUpFactory)
            {
                $this->factory = $thirtyFiveUpFactory;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractBusinessFactory|\FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiBusinessFactory
             */
            protected function getFactory(): AbstractBusinessFactory
            {
                return $this->factory;
            }
        };
    }

    /**
     * @return void
     */
    public function testUpdateThirtyFiveUpOrder(): void
    {
        $this->factoryMock->expects($this->once())->method('createThirtyFiveUpApi')->willReturn($this->thirtyFiveUpApiMock);
        $this->thirtyFiveUpApiMock->expects($this->once())->method('update')->willReturn($this->apiItemTransferMock);

        $this->facade->updateThirtyFiveUpOrder(1, $this->apiDataTransferMock);
    }

    /**
     * @return void
     */
    public function testFindThirtyFiveUpOrder(): void
    {
        $this->factoryMock->expects($this->once())->method('createThirtyFiveUpApi')->willReturn($this->thirtyFiveUpApiMock);
        $this->thirtyFiveUpApiMock->expects($this->once())->method('find')->willReturn($this->apiCollectionTransferMock);

        $this->facade->findThirtyFiveUpOrder($this->apiRequestTransferMock);
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->factoryMock->expects($this->once())->method('createThirtyFiveUpApiValidator')->willReturn($this->thirtyFiveUpApiValidatorMock);
        $this->thirtyFiveUpApiValidatorMock->expects($this->once())->method('validate')->willReturn([]);

        $this->facade->validate($this->apiDataTransferMock);
    }
}
