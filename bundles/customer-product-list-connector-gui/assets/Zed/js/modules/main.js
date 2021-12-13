'use strict';

var SelectProductListTableApi = require('./select-product-list-table-api');

$(document).ready(function () {
    var availableProductListTable = new SelectProductListTableApi();

    availableProductListTable.init(
        '#available-tab table.table',
        '#to-be-assigned-tab-table',
        '#available-tab table.table .js-product-list-checkbox',
        'a[href="#to-be-assigned-tab"]',
        '#customerProductListConnectorGui_productListIdsToAssign'
    );

    var assignedCompaniesTable = new SelectProductListTableApi();

    assignedCompaniesTable.init(
        '#assigned-tab table.table',
        '#to-be-de-assigned-tab-table',
        '#assigned-tab table.table .js-product-list-checkbox',
        'a[href="#to-be-de-assigned-tab"]',
        '#customerProductListConnectorGui_productListIdsToDeAssign'
    );
});
