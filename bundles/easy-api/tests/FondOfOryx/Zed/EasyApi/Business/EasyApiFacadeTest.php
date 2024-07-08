<?php

namespace FondOfOryx\Zed\EasyApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\EasyApi\Business\Model\ApiWrapperInterface;
use Generated\Shared\Transfer\EasyApiFilterTransfer;
use Generated\Shared\Transfer\EasyApiRequestTransfer;
use Generated\Shared\Transfer\EasyApiResponseTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class EasyApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\EasyApi\Business\EasyApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|EasyApiBusinessFactory $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\EasyApi\Business\Model\ApiWrapperInterface
     */
    protected MockObject|ApiWrapperInterface $apiWrapperMock;

    /**
     * @var \Generated\Shared\Transfer\EasyApiFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiFilterTransfer|MockObject $easyApiFilterTransferMock;

    /**
     * @var \Generated\Shared\Transfer\EasyApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiRequestTransfer|MockObject $easyApiRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\EasyApiResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiResponseTransfer|MockObject $easyApiResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\EasyApi\Business\EasyApiFacade
     */
    protected EasyApiFacade $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(EasyApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiWrapperMock = $this->getMockBuilder(ApiWrapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->easyApiFilterTransferMock = $this->getMockBuilder(EasyApiFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->easyApiRequestTransferMock = $this->getMockBuilder(EasyApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->easyApiResponseTransferMock = $this->getMockBuilder(EasyApiResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new EasyApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindDocument(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createApiWrapper')
            ->willReturn($this->apiWrapperMock);

        $this->apiWrapperMock->expects(static::atLeastOnce())
            ->method('findDocument')
            ->with($this->easyApiFilterTransferMock)
            ->willReturn($this->easyApiResponseTransferMock);

        static::assertEquals(
            $this->easyApiResponseTransferMock,
            $this->facade->findDocument(
                $this->easyApiFilterTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetFile(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createApiWrapper')
            ->willReturn($this->apiWrapperMock);

        $this->apiWrapperMock->expects(static::atLeastOnce())
            ->method('getFile')
            ->with($this->easyApiRequestTransferMock)
            ->willReturn($this->easyApiResponseTransferMock);

        static::assertEquals(
            $this->easyApiResponseTransferMock,
            $this->facade->getFile(
                $this->easyApiRequestTransferMock,
            ),
        );
    }
}
