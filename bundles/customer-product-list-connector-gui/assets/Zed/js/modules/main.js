'use strict';

var SelectProductListTableApi = require('./select-product-list-table-api');

$(document).ready(function () {
    var availableProductListTable = new SelectProductListTableApi();

    availableProductListTable.init(
        '#available-tab table.table',
        '#to-be-assigned-tab-table',
        '#available-tab table.table .js-product-list-checkbox',
        'a[href="#to-be-assigned-tab"]',
        '#companyProductListConnectorGui_productListIdsToAssign'
    );

    var assignedCompaniesTable = new SelectProductListTableApi();

    assignedCompaniesTable.init(
        '#assigned-tab table.table',
        '#deassigned-tab-table',
        '#assigned-tab table.table .js-product-list-checkbox',
        'a[href="#deassigned-tab"]',
        '#companyProductListConnectorGui_productListIdsToDeAssign'
    );
});
