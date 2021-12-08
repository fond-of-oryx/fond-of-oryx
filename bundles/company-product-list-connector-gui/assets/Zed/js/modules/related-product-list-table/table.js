'use strict';

var tableHandler = require('./table-handler');

/**
 * @param {string} sourceTableSelector
 * @param {string} destinationTableSelector
 * @param {string} checkboxSelector
 * @param {string} labelCaption
 * @param {string} labelId
 * @param {string} formFieldId
 * @param {function} onRemoveCallback
 *
 * @return {TableHandler}
 */
function create(
    sourceTableSelector,
    destinationTableSelector,
    checkboxSelector,
    labelCaption,
    labelId,
    formFieldId,
    onRemoveCallback,
) {
    $(destinationTableSelector).DataTable({ destroy: true });

    var tableHandlerInstance = tableHandler.create(
        $(sourceTableSelector),
        $(destinationTableSelector),
        labelCaption,
        labelId,
        formFieldId,
        onRemoveCallback,
    );

    $(sourceTableSelector)
        .DataTable()
        .on('draw', function (event, settings) {
            $(checkboxSelector, $(sourceTableSelector)).off('change');
            $(checkboxSelector, $(sourceTableSelector)).on('change', function () {
                var $checkbox = $(this);
                var info = $.parseJSON($checkbox.attr('data-info'));

                if (tableHandlerInstance.isCheckboxActive($checkbox)) {
                    tableHandlerInstance.addSelectedProductList(info.idProductList, info.name);
                } else {
                    tableHandlerInstance.removeSelectedProductList(info.idProductList);
                }
            });

            for (var i = 0; i < settings.json.data.length; i++) {
                var productList = settings.json.data[i];
                var idProductList = parseInt(productList[1], 10);

                var selector = tableHandlerInstance.getSelector();
                if (selector.isIdSelected(idProductList)) {
                    tableHandlerInstance.checkCheckbox($('input[value="' + idProductList + '"]', $(sourceTableSelector)));
                }
            }
        });

    return tableHandlerInstance;
}

module.exports = {
    create: create,
    CHECKBOX_CHECKED_STATE_CHECKED: tableHandler.CHECKBOX_CHECKED_STATE_CHECKED,
    CHECKBOX_CHECKED_STATE_UN_CHECKED: tableHandler.CHECKBOX_CHECKED_STATE_UN_CHECKED,
};
