<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Translator;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestCompanySearchAttributesTransfer;
use Generated\Shared\Transfer\RestCompanySearchSortTransfer;

class RestCompanySearchAttributesTranslatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToGlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanySearchAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanySearchAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanySearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanySearchSortTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Translator\RestCompanySearchAttributesTranslator
     */
    protected $restCompanySearchAttributesTranslator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(CompanySearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanySearchAttributesTransferMock = $this->getMockBuilder(RestCompanySearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanySearchSortTransferMock = $this->getMockBuilder(RestCompanySearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanySearchAttributesTranslator = new RestCompanySearchAttributesTranslator(
            $this->glossaryStorageClientMock,
        );
    }

    /**
     * @return void
     */
    public function testTranslate(): void
    {
        $locale = 'de_DE';
        $untranslated = [
            'name_asc' => 'companies_rest_api.sort.name_asc',
            'name_desc' => 'companies_rest_api.sort.name_desc',
        ];
        $translated = [
            'name_asc' => 'Name aufsteigend',
            'name_desc' => 'Name absteigend',
        ];

        $this->restCompanySearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($this->restCompanySearchSortTransferMock);

        $this->restCompanySearchSortTransferMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($untranslated);

        $this->glossaryStorageClientMock->expects(static::atLeastOnce())
            ->method('translate')
            ->withConsecutive([$untranslated['name_asc'], $locale], [$untranslated['name_desc'], $locale])
            ->willReturnOnConsecutiveCalls($translated['name_asc'], $translated['name_desc']);

        $this->restCompanySearchSortTransferMock->expects(static::atLeastOnce())
            ->method('setSortParamLocalizedNames')
            ->with(
                static::callback(
                    static function (array $sortParamLocalizedNames) use ($translated) {
                        return $sortParamLocalizedNames == $translated;
                    },
                ),
            )->willReturn($this->restCompanySearchSortTransferMock);

        static::assertEquals(
            $this->restCompanySearchAttributesTransferMock,
            $this->restCompanySearchAttributesTranslator->translate(
                $this->restCompanySearchAttributesTransferMock,
                $locale,
            ),
        );
    }

    /**
     * @return void
     */
    public function testTranslateWithNullableSort(): void
    {
        $locale = 'de_DE';

        $this->restCompanySearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn(null);

        $this->glossaryStorageClientMock->expects(static::never())
            ->method('translate');

        static::assertEquals(
            $this->restCompanySearchAttributesTransferMock,
            $this->restCompanySearchAttributesTranslator->translate(
                $this->restCompanySearchAttributesTransferMock,
                $locale,
            ),
        );
    }
}
