'use strict';

var SelectProductListTableApi = function() {
    this.selectedProductListsData = [];
    this.removeBtnSelector = '.js-remove-item';
    this.removeBtnTemplate = '<a href="#" class="js-remove-item btn-xs">Remove</a>';
    this.counterSelector = '.js-counter';
    this.counterTemplate = '<span class="js-counter"></span>';
    this.initialDataLoaded = false;

    /**
     * Init all table adding functionality.
     * @param {string} productListTable - Current table with product lists.
     * @param {string} selectedProductListsTable - Table where should product lists be added.
     * @param {string} checkboxSelector - Checkbox selector.
     * @param {string} counterLabelSelector - Tabs label where will be added count of select product lists.
     * @param {string} inputWithSelectedProductLists - In this input will putted all selected product list ids.
     */
    this.init = function(productListTable, selectedProductListsTable, checkboxSelector, counterLabelSelector, inputWithSelectedProductLists) {
        this.$productListTable = $(productListTable);
        this.$selectedProductListsTable = $(selectedProductListsTable);
        this.$counterLabel = $(counterLabelSelector);
        this.$inputWithSelectedProductLists = $(inputWithSelectedProductLists);
        this.checkboxSelector = checkboxSelector;
        this.counterSelector = counterLabelSelector + ' ' + this.counterSelector;

        this.drawProductListsTable();
        this.addRemoveButtonClickHandler();
        this.addCounterToLabel();
    };

    this.selectProductListsOnLoad = function(initialSelectedProductListsData) {
        if (this.initialDataLoaded) {
            return;
        }

        var data = initialSelectedProductListsData.replace(/&quot;/g, '"').replace(/,/g, '');
        var parsedData = JSON.parse(data);

        for (var i = 0; i < parsedData.length; i++) {
            parsedData[i].push('');
            this.addRow(parsedData[i]);
        }

        this.initialDataLoaded = true;
    };

    /**
     * Draw method of DataTable. Fires every time table rerender.
     */
    this.drawProductListsTable = function() {
        var self = this,
            productListTableData = self.$productListTable.DataTable();

        productListTableData.on('draw', function(event, settings) {
            self.updateCheckboxes();
            self.mapEventsToCheckboxes(productListTableData, $(self.checkboxSelector));

            if (self.$inputWithSelectedProductLists && initialSelectedProductListsData) {
                var initialSelectedProductListsData = self.$inputWithSelectedProductLists.val();

                self.selectProductListsOnLoad(initialSelectedProductListsData);
                self.$inputWithSelectedProductLists.val('');
            }
        });
    };

    /**
     * Add change event for all checkboxes checkbox. Fires every time, when product list table redraws.
     * @param {object} productListTableData - DataTable options ( get by $(element).DataTable() ).
     * @param {checkboxes} checkboxes - Collection of all checkboxes in product list Table.
     */
    this.mapEventsToCheckboxes = function(productListTableData, checkboxes) {
        var self = this;

        checkboxes.off('change');
        checkboxes.on('change', function () {
            var rowIndex = checkboxes.index($(this)),
                rowData = productListTableData.data()[rowIndex],
                id = rowData[0];

            if ($(this).is(':checked')) {
                return self.addRow(rowData);
            }

            return self.removeRow(id);
        });
    };

    /**
     * Check for selected product lists in product list table.
     */
    this.updateCheckboxes = function() {
        var productListTable = this.$productListTable.DataTable(),
            productListTableData = productListTable.data();

        for (var i = 0; i < productListTableData.length; i++) {
            var productListItemData = productListTableData[i],
                productListItemId = productListItemData[0],
                checkBox = $(productListTable.row(i).node()).find('[type="checkbox"]');

            checkBox.prop('checked', false);

            this.findSelectedProductListsInTable(checkBox, productListItemId);
        }
    };

    /**
     * Check for selected product lists in product list table.
     * @param {object} checkBox - Jquery object with checkbox.
     * @param {number} productListItemId - Id if product list row.
     */
    this.findSelectedProductListsInTable = function(checkBox,productListItemId) {
        var itemEqualId = function(item) {
            return item[0] === productListItemId;
        };

        if (this.selectedProductListsData.some(itemEqualId)) {
            checkBox.prop('checked', true);
        }
    };

    /**
     * Update counter.
     */
    this.updateCounter = function() {
        var counterText = '';

        if (this.selectedProductListsData.length) {
            counterText = ' ('+this.selectedProductListsData.length+')';
        }

        $(this.counterSelector).html(counterText);
    };

    /**
     * Update selected product lists input value.
     * @param {number} id - Selected product list id.
     */
    this.updateSelectedProductListsInputValue = function() {
        var inputValue = this.selectedProductListsData.reduce(function(concat, current, index) {
            return index ? concat + ',' + current[0] : current[0];
        }, '');

        this.$inputWithSelectedProductLists.val(inputValue);
    };

    /**
     * Add selected product list to array with all selected items.
     * @param {array} rowData - Array of all data selected product list.
     */
    this.addRow = function(rowData) {
        var productListItem = rowData.slice();
        productListItem[rowData.length - 1] = this.removeBtnTemplate.replace('#', productListItem[0]);
        this.selectedProductListsData.push(productListItem);
        this.renderSelectedItemsTable(productListItem);
    };

    /**
     * Remove row from array with all selected items.
     * @param {number} id - ProductLists id which should be deleted.
     */
    this.removeRow = function(id) {
        var self = this;

        this.selectedProductListsData.every(function(elem,index) {
            if (elem[0] !== Number(id)) {
                return true;
            }

            self.selectedProductListsData.splice(index,1);
            return false;

        });
        self.renderSelectedItemsTable();
    };

    /**
     * Add event for remove button to remove row from array with all selected items.
     */
    this.addRemoveButtonClickHandler = function() {
        var self = this,
            selectedTable = this.$selectedProductListsTable;

        selectedTable.on('click', this.removeBtnSelector, function (e) {
            e.preventDefault();

            var id = $(e.target).attr('href');

            self.removeRow(id);
            self.updateCheckboxes();
        });
    };

    /**
     * Add counter template on init.
     */
    this.addCounterToLabel = function() {
        this.$counterLabel.append(this.counterTemplate);
    };

    /**
     * Redraw table with selected items.
     */
    this.renderSelectedItemsTable = function() {
        this.$selectedProductListsTable
            .DataTable()
            .clear()
            .rows
            .add(this.selectedProductListsData).draw();

        this.updateCounter();
        this.updateSelectedProductListsInputValue();
        this.updateCheckboxes();
    };
}

module.exports = SelectProductListTableApi;
