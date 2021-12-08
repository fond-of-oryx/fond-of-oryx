'use strict';

var productListIdSelector = require('./product-list-id-selector');

var CHECKBOX_CHECKED_STATE_CHECKED = 'checked';
var CHECKBOX_CHECKED_STATE_UN_CHECKED = 'un_checked';

/**
 * @param {string} sourceTable
 * @param {string} destinationTable
 * @param {string} labelCaption
 * @param {string} labelId
 * @param {string} formFieldId
 * @param {function} onRemoveCallback
 *
 * @return {object}
 */
function TableHandler(sourceTable, destinationTable, labelCaption, labelId, formFieldId, onRemoveCallback) {
    var tableHandler = {
        labelId: labelId,
        labelCaption: labelCaption,
        formFieldId: formFieldId,
        sourceTable: sourceTable,
        destinationTable: destinationTable,
    };

    var destinationTableIdSelector = productListIdSelector.create();

    tableHandler.toggleSelection = function () {
        $('input[type="checkbox"]', sourceTable).each(function (index, checkboxNode) {
            var $checkbox = $(checkboxNode);
            $checkbox.prop('checked', !$checkbox.prop('checked'));
            $checkbox.trigger('change');
        });

        return false;
    };

    tableHandler.selectAll = function () {
        $('input[type="checkbox"]', sourceTable).each(function (index, checkboxNode) {
            var $checkbox = $(checkboxNode);
            $checkbox.prop('checked', true);
            $checkbox.trigger('change');
        });

        return false;
    };

    tableHandler.deSelectAll = function () {
        $('input[type="checkbox"]', sourceTable).each(function (index, checkboxNode) {
            var $checkbox = $(checkboxNode);
            $checkbox.prop('checked', false);
            $checkbox.trigger('change');
        });

        return false;
    };

    tableHandler.addSelectedProductList = function (idProductList, name) {
        idProductList = parseInt(idProductList, 10);

        if (destinationTableIdSelector.isIdSelected(idProductList)) {
            return;
        }

        destinationTableIdSelector.addIdToSelection(idProductList);

        var $removeLinkTextInput = $('#remove-link-text');

        destinationTable.DataTable()
            .row.add(
            [
                idProductList,
                decodeURIComponent((name + '').replace(/\+/g, '%20')),
                '<div><a data-id="' + idProductList + '" href="#" class="btn btn-xs remove-item">' + ($removeLinkTextInput ? $removeLinkTextInput.val() : 'Remove') + '</a></div>',
            ]
        ).draw();

        $('.remove-item').off('click');
        $('.remove-item').on('click', onRemoveCallback);

        tableHandler.updateSelectedProductListsLabelCount();
    };

    tableHandler.removeSelectedProductList = function (idProductList) {
        idProductList = parseInt(idProductList, 10);

        destinationTable
            .DataTable()
            .rows()
            .every(function (rowIndex, tableLoop, rowLoop) {
                if (!this.data()) {
                    return;
                }

                var rowProductListId = parseInt(this.data()[0], 10);
                if (idProductList !== rowProductListId) {
                    return;
                }

                destinationTableIdSelector.removeIdFromSelection(idProductList);

                this.remove();

                var $checkbox = $('input[value="' + idProductList + '"]', sourceTable);
                tableHandler.unCheckCheckbox($checkbox);
            });

        destinationTable.DataTable().draw();
        tableHandler.updateSelectedProductListsLabelCount();
    };

    tableHandler.getSelector = function () {
        return destinationTableIdSelector;
    };

    tableHandler.updateSelectedProductListsLabelCount = function () {
        $(tableHandler.getLabelId()).text(
            labelCaption + ' (' + Object.keys(this.getSelector().getSelected()).length + ')',
        );
        var productListIds = Object.keys(this.getSelector().getSelected());
        var s = productListIds.join(',');
        var field = $('#' + tableHandler.getFormFieldId());
        field.attr('value', s);
    };

    tableHandler.getLabelId = function () {
        return tableHandler.labelId;
    };

    tableHandler.getLabelCaption = function () {
        return tableHandler.labelCaption;
    };

    tableHandler.getFormFieldId = function () {
        return tableHandler.formFieldId;
    };

    tableHandler.getSourceTable = function () {
        return tableHandler.sourceTable;
    };

    tableHandler.getDestinationTable = function () {
        return tableHandler.destinationTable;
    };

    /**
     * @returns {string}
     */
    tableHandler.getInitialCheckboxCheckedState = function () {
        return CHECKBOX_CHECKED_STATE_UN_CHECKED;
    };

    /**
     * @param {jQuery} $checkbox
     * @return {boolean}
     */
    tableHandler.isCheckboxActive = function ($checkbox) {
        if (tableHandler.getInitialCheckboxCheckedState() === CHECKBOX_CHECKED_STATE_UN_CHECKED) {
            return $checkbox.prop('checked');
        }

        return !$checkbox.prop('checked');
    };

    /**
     * @param {jQuery} $checkbox
     */
    tableHandler.checkCheckbox = function ($checkbox) {
        var checkedState = tableHandler.getInitialCheckboxCheckedState() === CHECKBOX_CHECKED_STATE_UN_CHECKED;
        $checkbox.prop('checked', checkedState);
    };

    /**
     * @param {jQuery} $checkbox
     */
    tableHandler.unCheckCheckbox = function ($checkbox) {
        var checkedState = tableHandler.getInitialCheckboxCheckedState() !== CHECKBOX_CHECKED_STATE_UN_CHECKED;
        $checkbox.prop('checked', checkedState);
    };

    return tableHandler;
}

module.exports = {
    /**
     * @param {string} sourceTable
     * @param {string} destinationTable
     * @param {string} labelCaption
     * @param {string} labelId
     * @param {string} formFieldId
     * @param {function} onRemoveCallback
     *
     * @return {TableHandler}
     */
    create: function (sourceTable, destinationTable, labelCaption, labelId, formFieldId, onRemoveCallback) {
        return new TableHandler(sourceTable, destinationTable, labelCaption, labelId, formFieldId, onRemoveCallback);
    },
    CHECKBOX_CHECKED_STATE_CHECKED: CHECKBOX_CHECKED_STATE_CHECKED,
    CHECKBOX_CHECKED_STATE_UN_CHECKED: CHECKBOX_CHECKED_STATE_UN_CHECKED,
};
