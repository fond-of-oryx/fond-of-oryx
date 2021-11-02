<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage\Business\JellyfishCrossEngage;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Shared\JellyfishCrossEngage\JellyfishCrossEngageConstants;
use FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToLocaleFacadeInterface;
use FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductCategoryFacadeInterface;
use FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductFacadeInterface;
use FondOfOryx\Zed\JellyfishCrossEngage\JellyfishCrossEngageConfig;
use Generated\Shared\Transfer\CategoryCollectionTransfer;
use Generated\Shared\Transfer\CategoryLocalizedAttributesTransfer;
use Generated\Shared\Transfer\CategoryTransfer;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;

class JellyfishCrossEngageReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishCrossEngage\Business\JellyfishCrossEngage\JellyfishCrossEngageReader
     */
    protected $jellyfishCrossEngageReader;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductFacadeInterface
     */
    protected $productFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductCategoryFacadeInterface
     */
    protected $productCategoryFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishCrossEngage\JellyfishCrossEngageConfig
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\JellyfishOrderItemTransfer
     */
    protected $jellyfishOrderItemTransferMock;

    /**
     * @var string
     */
    protected $sku;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductConcreteTransfer
     */
    protected $productConcreteTransferMock;

    /**
     * @var array<string>
     */
    protected $attributes;

    /**
     * @var string
     */
    protected $gender;

    /**
     * @var string
     */
    protected $defaultLocaleName;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\LocaleTransfer
     */
    protected $localeTransferMock;

    /**
     * @var int
     */
    protected $idProductAbstract;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CategoryCollectionTransfer
     */
    protected $categoryCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CategoryTransfer
     */
    protected $categoryTransferMock;

    /**
     * @var \ArrayObject<\Generated\Shared\Transfer\CategoryTransfer>
     */
    protected $categoryTransferMocks;

    /**
     * @var string
     */
    protected $categoryName;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CategoryLocalizedAttributesTransfer
     */
    protected $categoryLocalizedAttributesTransferMock;

    /**
     * @var \ArrayObject<\Generated\Shared\Transfer\CategoryLocalizedAttributesTransfer>
     */
    protected $categoryLocalizedAttributesTransferMocks;

    /**
     * @var string
     */
    protected $categoryName2;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productFacade = $this->getMockBuilder(JellyfishCrossEngageToProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCategoryFacade = $this->getMockBuilder(JellyfishCrossEngageToProductCategoryFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(JellyfishCrossEngageConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacade = $this->getMockBuilder(JellyfishCrossEngageToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderItemTransferMock = $this->getMockBuilder(JellyfishOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->sku = 'sku';

        $this->productConcreteTransferMock = $this->getMockBuilder(ProductConcreteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gender = 'male';

        $this->attributes = [
            'gender' => $this->gender,
        ];

        $this->defaultLocaleName = JellyfishCrossEngageConstants::DEFAULT_LOCALE_NAME;

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idProductAbstract = 1;

        $this->categoryCollectionTransferMock = $this->getMockBuilder(CategoryCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryTransferMock = $this->getMockBuilder(CategoryTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryTransferMocks = new ArrayObject([
            $this->categoryTransferMock,
        ]);

        $this->categoryName = 'category-name';

        $this->categoryName2 = 'category-name-2';

        $this->categoryLocalizedAttributesTransferMock = $this->getMockBuilder(CategoryLocalizedAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryLocalizedAttributesTransferMocks = new ArrayObject([
            $this->categoryLocalizedAttributesTransferMock,
            $this->categoryLocalizedAttributesTransferMock,
        ]);

        $this->jellyfishCrossEngageReader = new JellyfishCrossEngageReader(
            $this->productFacade,
            $this->productCategoryFacade,
            $this->localeFacade,
            $this->configMock,
        );
    }

    /**
     * @return void
     */
    public function testGetGender(): void
    {
        $this->jellyfishOrderItemTransferMock->expects($this->atLeastOnce())
            ->method('getSku')
            ->willReturn($this->sku);

        $this->productFacade->expects($this->atLeastOnce())
            ->method('getProductConcrete')
            ->with($this->sku)
            ->willReturn($this->productConcreteTransferMock);

        $this->productFacade->expects($this->atLeastOnce())
            ->method('getCombinedConcreteAttributes')
            ->with($this->productConcreteTransferMock)
            ->willReturn($this->attributes);

        $this->configMock->expects($this->atLeastOnce())
            ->method('getGenderAttributeKey')
            ->willReturn('gender');

        $this->assertSame(
            $this->gender,
            $this->jellyfishCrossEngageReader->getGender(
                $this->jellyfishOrderItemTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetCategories(): void
    {
        $this->configMock->expects($this->atLeastOnce())
            ->method('getDefaultLocaleName')
            ->willReturn($this->defaultLocaleName);

        $this->localeFacade->expects($this->atLeastOnce())
            ->method('getLocale')
            ->with($this->defaultLocaleName)
            ->willReturn($this->localeTransferMock);

        $this->jellyfishOrderItemTransferMock->expects($this->atLeastOnce())
            ->method('getSku')
            ->willReturn($this->sku);

        $this->productFacade->expects($this->atLeastOnce())
            ->method('getProductConcrete')
            ->with($this->sku)
            ->willReturn($this->productConcreteTransferMock);

        $this->productConcreteTransferMock->expects($this->atLeastOnce())
            ->method('getFkProductAbstract')
            ->willReturn($this->idProductAbstract);

        $this->productCategoryFacade->expects($this->atLeastOnce())
            ->method('getCategoryTransferCollectionByIdProductAbstract')
            ->with($this->idProductAbstract, $this->localeTransferMock)
            ->willReturn($this->categoryCollectionTransferMock);

        $this->categoryCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getCategories')
            ->willReturn($this->categoryTransferMocks);

        $this->categoryTransferMock->expects($this->atLeastOnce())
            ->method('getLocalizedAttributes')
            ->willReturn($this->categoryLocalizedAttributesTransferMocks);

        $this->categoryLocalizedAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->localeTransferMock->expects($this->atLeastOnce())
            ->method('getLocaleName')
            ->willReturn($this->configMock->getDefaultLocaleName());

        $this->configMock->expects($this->atLeastOnce())
            ->method('getCategoriesSeparator')
            ->willReturn(', ');

        $this->categoryLocalizedAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturnOnConsecutiveCalls(
                $this->categoryName,
                $this->categoryName2,
            );

        $this->assertSame(
            $this->categoryName . ', ' . $this->categoryName2,
            $this->jellyfishCrossEngageReader->getCategories(
                $this->jellyfishOrderItemTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetCategoriesEmpty(): void
    {
        $this->configMock->expects($this->atLeastOnce())
            ->method('getDefaultLocaleName')
            ->willReturn($this->defaultLocaleName);

        $this->localeFacade->expects($this->atLeastOnce())
            ->method('getLocale')
            ->with($this->defaultLocaleName)
            ->willReturn($this->localeTransferMock);

        $this->jellyfishOrderItemTransferMock->expects($this->atLeastOnce())
            ->method('getSku')
            ->willReturn($this->sku);

        $this->productFacade->expects($this->atLeastOnce())
            ->method('getProductConcrete')
            ->with($this->sku)
            ->willReturn($this->productConcreteTransferMock);

        $this->productConcreteTransferMock->expects($this->atLeastOnce())
            ->method('getFkProductAbstract')
            ->willReturn($this->idProductAbstract);

        $this->productCategoryFacade->expects($this->atLeastOnce())
            ->method('getCategoryTransferCollectionByIdProductAbstract')
            ->with($this->idProductAbstract, $this->localeTransferMock)
            ->willReturn($this->categoryCollectionTransferMock);

        $this->categoryCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getCategories')
            ->willReturn(new ArrayObject([]));

        $this->assertNull(
            $this->jellyfishCrossEngageReader->getCategories(
                $this->jellyfishOrderItemTransferMock,
            ),
        );
    }
}
