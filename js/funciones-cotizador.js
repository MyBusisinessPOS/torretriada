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
			 console.log(data);
		}
	}).done(function () {
		for (var i in lotes) {
			var enlace = $("svg #" + lotes[i].lote);
			//var enlaceA = $("svg #Lote_"+lotes[i].lote).parent();

			//console.log(css_heredado);
			if (lotes[i].status == 1) {
				$("svg #" + lotes[i].lote).addClass("label-success-cotizador");
				$("svg #" + lotes[i].lote).css("cursor", "pointer");
				$("svg #" + lotes[i].lote).css("fill", "rgba(117,209,152,0.50)");
				//$(enlace).attr("data-toggle","popover");
				//$(enlace).attr("data-trigger","hover");
				//$(enlace).attr("data-placement","top");
				//$(enlace).attr("data-content",'<h4 class="content-title">'+lotes[i].lote+' </h4><p class="content-text"><span class="p-metros">'+lotes[i].m2Formato+' m<sup>2</sup></span><br /><span class="p-price">$'+lotes[i].precioFormato+'</span><br /><span class="p-disponibilidad">Disponible</span></p>');
			}
			if (lotes[i].status == 2) {
				$("svg #" + lotes[i].lote).css("fill", "rgba(232,174,0,0.50)");
				//$(enlace).attr("data-toggle","popover");
				//$(enlace).attr("data-trigger","hover");
				//$(enlace).attr("data-placement","top");
				//$(enlace).attr("data-content",'<h4 class="content-title">'+lotes[i].lote+' </h4><p class="content-text"><span class="p-metros">'+lotes[i].m2Formato+' m<sup>2</sup></span><br /><span class="p-disponibilidad">Apartado</span></p>');
			}
			if (lotes[i].status == 3) {
				$("svg #" + lotes[i].lote).css("fill", "rgba(175,17,24,0.50)");
				//$(enlace).attr("data-toggle","popover");
				//$(enlace).attr("data-trigger","hover");
				//$(enlace).attr("data-placement","top");
				//$(enlace).attr("data-content",'<h4 class="content-title">'+lotes[i].lote+' </h4><p class="content-text"><span class="p-metros">'+lotes[i].m2Formato+' m<sup>2</sup></span><br /><span class="p-disponibilidad">Vendido</span></p>');
			}
		};
	});

	$('body').on('touchstart click', 'polygon,path,rect', function (e) {
		e.preventDefault();
		
		let _batch = $(this);
		let _bid = _batch.attr('id');
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
							$('#modalCotizador').modal("show");
							console.log("Eduardo"._json.modelo);
						}
					}
				}
			});
		}
	});
});
