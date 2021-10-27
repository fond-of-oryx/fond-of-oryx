<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Translator;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchSortTransfer;

class RestCompanyBusinessUnitSearchAttributesTranslatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToGlossaryStorageClientInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyBusinessUnitSearchAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchSortTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyBusinessUnitSearchSortTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Translator\RestCompanyBusinessUnitSearchAttributesTranslator
     */
    protected $restCompanyBusinessUnitSearchAttributesTranslator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(CompanyBusinessUnitSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitSearchAttributesTransferMock = $this->getMockBuilder(RestCompanyBusinessUnitSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitSearchSortTransferMock = $this->getMockBuilder(RestCompanyBusinessUnitSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitSearchAttributesTranslator = new RestCompanyBusinessUnitSearchAttributesTranslator(
            $this->glossaryStorageClientMock
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

        $this->restCompanyBusinessUnitSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($this->restCompanyBusinessUnitSearchSortTransferMock);

        $this->restCompanyBusinessUnitSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($untranslated);

        $this->glossaryStorageClientMock->expects(static::atLeastOnce())
            ->method('translate')
            ->withConsecutive([$untranslated['name_asc'], $locale], [$untranslated['name_desc'], $locale])
            ->willReturnOnConsecutiveCalls($translated['name_asc'], $translated['name_desc']);

        $this->restCompanyBusinessUnitSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('setSortParamLocalizedNames')
            ->with(
                static::callback(
                    static function (array $sortParamLocalizedNames) use ($translated) {
                        return $sortParamLocalizedNames == $translated;
                    }
                )
            )->willReturn($this->restCompanyBusinessUnitSearchSortTransferMock);

        static::assertEquals(
            $this->restCompanyBusinessUnitSearchAttributesTransferMock,
            $this->restCompanyBusinessUnitSearchAttributesTranslator->translate(
                $this->restCompanyBusinessUnitSearchAttributesTransferMock,
                $locale
            )
        );
    }

    /**
     * @return void
     */
    public function testTranslateWithNullableSort(): void
    {
        $locale = 'de_DE';

        $this->restCompanyBusinessUnitSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn(null);

        $this->glossaryStorageClientMock->expects(static::never())
            ->method('translate');

        static::assertEquals(
            $this->restCompanyBusinessUnitSearchAttributesTransferMock,
            $this->restCompanyBusinessUnitSearchAttributesTranslator->translate(
                $this->restCompanyBusinessUnitSearchAttributesTransferMock,
                $locale
            )
        );
    }
}
