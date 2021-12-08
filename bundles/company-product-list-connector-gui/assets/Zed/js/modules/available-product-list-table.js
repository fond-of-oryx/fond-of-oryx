'use strict';

var relatedProductListTable = require('./related-product-list-table/table');

var sourceTabSelector = '#available-tab';
var sourceTableSelector = sourceTabSelector + ' table.table';

var destinationTabSelector = '#to-be-assigned-tab';
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
        'companyProductListConnectorGui_productListIdsToAssign',
        onRemove,
    );

    $(sourceTabSelector + ' .js-select-all-button a').on('click', tableHandler.selectAll);
}

/**
 * @return {boolean}
 */
function onRemove() {
    var $link = $(this);
    var id = $link.data('id');

    var dataTable = $(destinationTableSelector).DataTable();
    dataTable.row($link.parents('tr')).remove().draw();

    tableHandler.getSelector().removeIdFromSelection(id);
    tableHandler.updateSelectedCustomersLabelCount();
    $('input[value="' + id + '"]', $(sourceTableSelector)).prop('checked', false);

    return false;
}

module.exports = {
    initialize: initialize,
};
