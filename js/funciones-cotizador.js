/*function dispositivo(){
  var dispositivo = navigator.userAgent.toLowerCase();

	if( dispositivo.search(/iphone|ipod|ipad|android/) == -1 ){
		$('polygon,path,rect').popover({
			placement: 'top',
			trigger: 'hover',
			//trigger: 'click',
			html: 'true',
			container: 'body'
		});
	}else{
		$('polygon,path,rect').popover({
			//placement: 'top',
			//trigger: 'hover',
			trigger: 'click'
			//html: 'true',
			//container: 'body'
		});
	}
}*/
var lotes = null
$(window).load(function () {
	// Initialize tooltip component
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});
	// Initialize popover component
	$("[data-toggle=popover]").popover({
		html: true
	});
});

const populateData = (data, option = "") => {
	if (data) {

		// const filter = data.filter(lote => lote.lote.startsWith("D"));
		// console.log(filter)

		for (var i in data) {
			var enlace = $("svg #" + data[i].lote);

			const filterLote = data[i].lote.startsWith(option)
			// console.log(filterLote)

			if (data[i].status == 1) {				
				if(option == "" || filterLote) {
					$("svg #" + data[i].lote).addClass("label-success-cotizador");
					$("svg #" + data[i].lote).css("cursor", "pointer");
					$("svg #" + data[i].lote).css("fill", "rgba(117,209,152,0.50)");
				} else {

					$("svg #" + data[i].lote).removeClass("label-success-cotizador");
					$("svg #" + data[i].lote).css("cursor", "default");
					$("svg #" + data[i].lote).css("fill", "rgb(169,169,169, 0.50)");
				}
				
				//$(enlace).attr("data-toggle","popover");
				//$(enlace).attr("data-trigger","hover");
				//$(enlace).attr("data-placement","top");
				//$(enlace).attr("data-content",'<h4 class="content-title">'+data[i].lote+' </h4><p class="content-text"><span class="p-metros">'+data[i].m2Formato+' m<sup>2</sup></span><br /><span class="p-price">$'+data[i].precioFormato+'</span><br /><span class="p-disponibilidad">Disponible</span></p>');
			}
			if (data[i].status == 2) {
				if(option == "") {
					$("svg #" + data[i].lote).css("fill", "rgba(232,174,0,0.50)");
				}
				
				//$(enlace).attr("data-toggle","popover");
				//$(enlace).attr("data-trigger","hover");
				//$(enlace).attr("data-placement","top");
				//$(enlace).attr("data-content",'<h4 class="content-title">'+data[i].lote+' </h4><p class="content-text"><span class="p-metros">'+data[i].m2Formato+' m<sup>2</sup></span><br /><span class="p-disponibilidad">Apartado</span></p>');
			}
			if (data[i].status == 3) {
				if(option == "") {
					$("svg #" + data[i].lote).css("fill", "rgba(175,17,24,0.50)");
				}
				
				//$(enlace).attr("data-toggle","popover");
				//$(enlace).attr("data-trigger","hover");
				//$(enlace).attr("data-placement","top");
				//$(enlace).attr("data-content",'<h4 class="content-title">'+data[i].lote+' </h4><p class="content-text"><span class="p-metros">'+data[i].m2Formato+' m<sup>2</sup></span><br /><span class="p-disponibilidad">Vendido</span></p>');
			}
		};
	}
}


$(function ($) {

	//dispositivo();
	$.ajax({
		url: 'controller/controllerLotes.php',
		type: 'POST',
		dataType: "html",
		contentType: "application/x-www-form-urlencoded",
		data: { 'operaciones': "lotetodos" },
		success: function (data) {
			lotes = JSON.parse(data)
			// lotes = JSON.parse(data);
			//  console.log(data);
		}
	}).done(function () {
		populateData(lotes)
	});


	$('#select-type-lote').on('change', function (e) {
		const option = $(this).val()		
		populateData(lotes, option)		
	})

	$('body').on('touchstart click', 'polygon,path,rect', function (e) {
		e.preventDefault();
		let _batch = $(this);
		let _bid = _batch.attr('id');
		const typeLote = $('#select-type-lote option:selected').val()
		let active = true;
		if (typeLote != '' || typeLote != null || typeLote != undefined) {
			active = _bid.startsWith(typeLote)
		}
		
		if (_bid) {
			loteID = _bid;		

			$.each(lotes, function (i, _json) {
				if (_json) {
					if (_json.lote == _bid) {
						if (_json.status == 1) {
							_ind = i;

							$("#precioBase").val(_json.precio);

							$('#modalCotizador #noLote').text(_json.nombre);
							$('#modalCotizador #m2').html("" + _json.m2Formato + " m<sup>2</sup>")

							$('#modalCotizador #interior').html("INTERIORES" + _json.interior + " m<sup>2</sup>")
							$('#modalCotizador #terrazas').html("TERRAZAS  NNNN" + _json.terrazas + " m<sup>2</sup>")
							$('#modalCotizador #cajones').html("CAJONES" + _json.cajones + "")


							$('#modalCotizador #precio').html("$" + _json.precioFormato + "");
							$('#modalCotizador #c-lote').val(_json.nombre);
							$('#modalCotizador #enganche').html("$" + _json.engancheFormato + "");
							$('#modalCotizador #pago-mensual').html("$" + _json.mensualidadFormato + "");
							$('#modalCotizador #saldo_entrega').html("$" + _json.saldoentregaFormato + "");

							$("#precioPost").val(_json.precioFormato);
							$('#modalCotizador #plazo-mensualidades').text(_json.meses);
							if (_json.tipo == 'lc') {
								$('#modalCotizador .saldo_entrega').hide();
								//$('#modalCotizador #plazo-mensualidades').text("24");
							} else {
								$('#modalCotizador .saldo_entrega').show();
								//('#modalCotizador #plazo-mensualidades').text("18");
							}

							//_precio.val("$ "+_json.precioFormato);
							if (_json.ruta == "") {
								$('#modalCotizador .contiene-img').html("<img src='" + PATH + "img/logo-aranza.png' class='lt' /><span class='borde'></span>");
							}
							else {
								$('#modalCotizador .contiene-img').html("<img src='" + PATH + "img/imgLotes/" + _json.ruta + "' /><span class='borde'></span>");
							}
							$("#formContact")[0].reset();
							if(active) {
								$('#modalCotizador').modal("show");
							}						
							
						}
					}
				}
			});
		}
	});
});
