/*============================FILTROS PARA LA TABLA DEL USUARIO======================*/
$(function() {
	  	$table = $('#tableUsuario').tablesorter({
		widgets: ["filter"],
		widgetOptions : {
		  // filter_anyMatch replaced! Instead use the filter_external option
		  // Set to use a jQuery selector (or jQuery object) pointing to the
		  // external filter (column specific or any match)
		  filter_external : '#searchUsuario',
		  // include column filters
		  filter_columnFilters: false,
		  filter_placeholder: { search : 'Search...' },
		  filter_saveFilters : true,
		},
		headers:{
			0: {
				sorter: false
			}
		}
		
	});
});
/*============================FILTROS PARA LA TABLA DEL TIPOUSUARIO======================*/
$(function() {
	  	$table = $('#tableTipoUsuario').tablesorter({
		widgets: ["filter"],
		widgetOptions : {
		  // filter_anyMatch replaced! Instead use the filter_external option
		  // Set to use a jQuery selector (or jQuery object) pointing to the
		  // external filter (column specific or any match)
		  filter_external : '#searchTU',
		  // include column filters
		  filter_columnFilters: false,
		  filter_placeholder: { search : 'Search...' },
		  filter_saveFilters : true,
		},
		headers:{
			0: {
				sorter: false
			}
		}
		
	});
});

/*============================FILTROS PARA LA TABLA DE LAS CATEGORIAS======================*/
$(function() {
	  	$table = $('#tableCategoria').tablesorter({
		widgets: ["filter"],
		widgetOptions : {
		  // filter_anyMatch replaced! Instead use the filter_external option
		  // Set to use a jQuery selector (or jQuery object) pointing to the
		  // external filter (column specific or any match)
		  filter_external : '#searchCategoria',
		  // include column filters
		  filter_columnFilters: false,
		  filter_placeholder: { search : 'Search...' },
		  filter_saveFilters : true,
		}
		
	});
});


/*============================FILTROS PARA LA TABLA DEL SLIDE======================*/
$(function(){

  var pagerOptions = {

		// target the pager markup - see the HTML block below
		container: $(".pager"),

		// use this url format "http:/mydatabase.com?page={page}&size={size}&{sortList:col}"
		ajaxUrl: null,

		// modify the url after all processing has been applied
		customAjaxUrl: function(table, url) { return url; },

		// process ajax so that the data object is returned along with the total number of rows
		// example: { "data" : [{ "ID": 1, "Name": "Foo", "Last": "Bar" }], "total_rows" : 100 }
		ajaxProcessing: function(ajax){
			if (ajax && ajax.hasOwnProperty('data')) {
				// return [ "data", "total_rows" ];
				return [ ajax.total_rows, ajax.data ];
			}
		},

		// output string - default is '{page}/{totalPages}'
		// possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
		// also {page:input} & {startRow:input} will add a modifiable input in place of the value
		output: '{startRow:input} to {endRow} ({totalRows})',

		// apply disabled classname to the pager arrows when the rows at either extreme is visible - default is true
		updateArrows: true,

		// starting page of the pager (zero based index)
		page: 0,

		// Number of visible rows - default is 10
		size: 10,

		// Save pager page & size if the storage script is loaded (requires $.tablesorter.storage in jquery.tablesorter.widgets.js)
		savePages : false,
		
		//defines custom storage key
		storageKey:'tablesorter-pager',

		// if true, the table will remain the same height no matter how many records are displayed. The space is made up by an empty
		// table row set to a height to compensate; default is false
		fixedHeight: false,

		// remove rows from the table to speed up the sort of large tables.
		// setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
		removeRows: false,

		// css class names of pager arrows
		cssNext: '.next', // next page arrow
		cssPrev: '.prev', // previous page arrow
		cssFirst: '.first', // go to first page arrow
		cssLast: '.last', // go to last page arrow
		cssGoto: '.gotoPage', // select dropdown to allow choosing a page

		cssPageDisplay: '.pagedisplay', // location of where the "output" is displayed
		cssPageSize: '.pagesize', // page size selector - select dropdown that sets the "size" option

		// class added to arrows when at the extremes (i.e. prev/first arrows are "disabled" when on the first page)
		cssDisabled: 'disabled', // Note there is no period "." in front of this class name
		cssErrorRow: 'tablesorter-errorRow' // ajax error information row

	};

  // Initialize tablesorter
  // ***********************
  $("#tableSlide")
    .tablesorter({
      widgets: ['filter'],
	  widgetOptions : {
		 filter_external : '.searchSlide',
		 // include column filters
		 filter_columnFilters: false,
		 filter_placeholder: { search : 'Search...' },
		 filter_saveFilters : true,
	}
    })
	// bind to pager events
	// *********************
	.bind('pagerChange pagerComplete pagerInitialized pageMoved', function(e, c){
		var msg = '"</span> event triggered, ' + (e.type === 'pagerChange' ? 'going to' : 'now on') +
			' page <span class="typ">' + (c.page + 1) + '/' + c.totalPages + '</span>';
		$('#display')
			.append('<li><span class="str">"' + e.type + msg + '</li>')
			.find('li:first').remove();
	})
    // initialize the pager plugin
    // ****************************
    .tablesorterPager(pagerOptions);
});

/*============================FILTROS PARA LA TABLA DE LAS NOTICIAS======================*/
$(function(){

  var pagerOptions = {

		// target the pager markup - see the HTML block below
		container: $(".pager"),

		// use this url format "http:/mydatabase.com?page={page}&size={size}&{sortList:col}"
		ajaxUrl: null,

		// modify the url after all processing has been applied
		customAjaxUrl: function(table, url) { return url; },

		// process ajax so that the data object is returned along with the total number of rows
		// example: { "data" : [{ "ID": 1, "Name": "Foo", "Last": "Bar" }], "total_rows" : 100 }
		ajaxProcessing: function(ajax){
			if (ajax && ajax.hasOwnProperty('data')) {
				// return [ "data", "total_rows" ];
				return [ ajax.total_rows, ajax.data ];
			}
		},

		// output string - default is '{page}/{totalPages}'
		// possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
		// also {page:input} & {startRow:input} will add a modifiable input in place of the value
		output: '{startRow:input} to {endRow} ({totalRows})',

		// apply disabled classname to the pager arrows when the rows at either extreme is visible - default is true
		updateArrows: true,

		// starting page of the pager (zero based index)
		page: 0,

		// Number of visible rows - default is 10
		size: 10,

		// Save pager page & size if the storage script is loaded (requires $.tablesorter.storage in jquery.tablesorter.widgets.js)
		savePages : false,
		
		//defines custom storage key
		storageKey:'tablesorter-pager',

		// if true, the table will remain the same height no matter how many records are displayed. The space is made up by an empty
		// table row set to a height to compensate; default is false
		fixedHeight: false,

		// remove rows from the table to speed up the sort of large tables.
		// setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
		removeRows: false,

		// css class names of pager arrows
		cssNext: '.next', // next page arrow
		cssPrev: '.prev', // previous page arrow
		cssFirst: '.first', // go to first page arrow
		cssLast: '.last', // go to last page arrow
		cssGoto: '.gotoPage', // select dropdown to allow choosing a page

		cssPageDisplay: '.pagedisplay', // location of where the "output" is displayed
		cssPageSize: '.pagesize', // page size selector - select dropdown that sets the "size" option

		// class added to arrows when at the extremes (i.e. prev/first arrows are "disabled" when on the first page)
		cssDisabled: 'disabled', // Note there is no period "." in front of this class name
		cssErrorRow: 'tablesorter-errorRow' // ajax error information row

	};

  // Initialize tablesorter
  // ***********************
  $("#tableNot")
    .tablesorter({
	  dateFormat : "ddmmyyyy",
      widgets: ['filter'],
	  widgetOptions : {
		 filter_external : '.searchNot',
		 // include column filters
		 filter_columnFilters: false,
		 filter_placeholder: { search : 'Search...' },
		 filter_saveFilters : true,
		
	}
    })
	// bind to pager events
	// *********************
	.bind('pagerChange pagerComplete pagerInitialized pageMoved', function(e, c){
		var msg = '"</span> event triggered, ' + (e.type === 'pagerChange' ? 'going to' : 'now on') +
			' page <span class="typ">' + (c.page + 1) + '/' + c.totalPages + '</span>';
		$('#display')
			.append('<li><span class="str">"' + e.type + msg + '</li>')
			.find('li:first').remove();
	})
    // initialize the pager plugin
    // ****************************
    .tablesorterPager(pagerOptions);
});
