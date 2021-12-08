'use strict';

var relatedProductListTable = require('./related-product-list-table/table');

var sourceTabSelector = '#assigned-tab';
var sourceTableSelector = sourceTabSelector + ' table.table';

var destinationTabSelector = '#deassigned-tab';
var destinationTabLabelSelector = destinationTabSelector + '-label';
var destinationTableSelector = destinationTabSelector + '-table';

var checkboxSelector = '.js-product-list-checkbox';
var tableHandler;

/**
 * @return {void}
 */
function initialize() {
    tableHandler = relatedProductListTable.create(
        sourceTableSelector,
        destinationTableSelector,
        checkboxSelector,
        $(destinationTabLabelSelector).text(),
        destinationTabLabelSelector,
        'companyProductListConnectorGui_productListIdsToDeAssign',
        onRemove,
    );

    tableHandler.getInitialCheckboxCheckedState = function () {
        return relatedProductListTable.CHECKBOX_CHECKED_STATE_CHECKED;
    };

    $(sourceTabSelector + ' .js-de-select-all-button a').on('click', tableHandler.deSelectAll);
}

/**
 * @returns {boolean}
 */
function onRemove() {
    var $link = $(this);
    var id = $link.data('id');

    var dataTable = $(destinationTableSelector).DataTable();
    dataTable.row($link.parents('tr')).remove().draw();

    tableHandler.getSelector().removeIdFromSelection(id);
    tableHandler.updateSelectedProductListsLabelCount();
    $('input[value="' + id + '"]', $(sourceTableSelector)).prop('checked', true);

    return false;
}

module.exports = {
    initialize: initialize,
};
