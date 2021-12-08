'use strict';

var availableProductListTable = require('./available-product-list-table');
var assignedProductListTable = require('./assigned-product-list-table');

$(document).ready(function () {
    availableProductListTable.initialize();
    assignedProductListTable.initialize();
});
