$(function() {
	$("#table-long").tablesorter({
		debug: false,
		headers: {
			0: {
				sorter: false
			}
		},
		dateFormat : "mmddyyyy",
	});
});
$(function() {
	var pagerOptions = {

    // target the pager markup - see the HTML block below
    container: $(".pager"),
    // output string - default is '{page}/{totalPages}'
    // possible variables: {size}, {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
    // also {page:input} & {startRow:input} will add a modifiable input in place of the value
    output: '{startRow:input} to {endRow} ({totalRows})'
    };

 	$("#table-short").tablesorter({
	 	headers: {
			  0: {
				   sorter: false
			  }
		},
		widgets: ["filter"],
		widgetOptions : {
		    // filter_anyMatch replaced! Instead use the filter_external option
		    // Set to use a jQuery selector (or jQuery object) pointing to the
		    // external filter (column specific or any match)
		    filter_external : '.search',
		    // add a default type search to the first name column
		    //filter_defaultFilter: { 1 : '~{query}' },
		   	// include column filters
		    filter_columnFilters: false,
		   	filter_placeholder: { search : 'Buscar...' },
		    filter_saveFilters : false
	    }
	}); 
    $("#table-short").tablesorterPager(pagerOptions); 
});