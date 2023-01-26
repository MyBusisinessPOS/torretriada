// JavaScript Document

//Carga de página
$(window).load(function() {
	$( "html,body" ).animate({
	opacity: 1
	}, 500);
	$("#inicio .bg").addClass("no-scale");
});

//Menú lateral
$(".desplega-menu").click(function(e) {
    if($(this).hasClass("inn")){
		$("header ul").hide();
		$(this).removeClass("inn");
	}
	else{
		$("header ul").show();
		$(this).addClass("inn");
	}
});

$(".abre-menu").click(function(e) {
    $("#modalMenu").modal("show");
});
$(".cierra-menu").click(function(e) {
    $("#modalMenu").modal("hide");
});

$("#modalProyecto .close-modal").click(function(e) {
    $("#modalProyecto").modal("hide");
});
$(".inicio-6 .item .info button").click(function(e) {
    $("#modalProyecto").modal("show");
});
$(".abre-modal-brochure").click(function(e) {
    $("#modalRegistro").modal("show");
});

$("#modalMenu ul li a.directo").click(function(e) {
    $("#modalMenu").modal("hide");
});

$(window).load(function(e) {
	$(function() {
		$('.inicio-2 .cols').matchHeight({
		byRow: true,
		property: 'height',
		target: null,
		remove: false
		});
	});
	$(function() {
		$('.inicio-4 .info').matchHeight({
		byRow: true,
		property: 'height',
		target: null,
		remove: false
		});
	});
	$(function() {
		$('.inicio-5 .item').matchHeight({
		byRow: true,
		property: 'height',
		target: null,
		remove: false
		});
	});
	$(function() {
		$('.inicio-6 .item').matchHeight({
		byRow: true,
		property: 'height',
		target: null,
		remove: false
		});
	});
	$(function() {
		$('.inicio-7 .cols').matchHeight({
		byRow: true,
		property: 'height',
		target: null,
		remove: false
		});
	});

});

//<![CDATA[
jQuery(document).ready(function(){
	  jQuery('a.scroller[href*=#]').click(function() {
	  var name = jQuery(this).attr('href');
	  var no = new Array ('#mas', '#mas');
	  var  total = no.length;
	  var desplazamiento = 1000;

	  for (i=0;i<=total;i++) {
		   if(no[i] == name){
		   return false;
		   //console.log("final");
	  		}
		}
		setTimeout(function(){
		  $( "#menu" ).removeClass("up-menu");
		}, 1100);

	 if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
	 && location.hostname == this.hostname) {
	   var target = jQuery(this.hash);
	   target = target.length && target

	   || jQuery('[href=' + this.hash.slice(1) +']');
	   if (target.length) {
	  var targetOffset = target.offset().top;
	  jQuery('html,body')
	  .animate({scrollTop: targetOffset-30}, desplazamiento);
	    return false;

	   }}
	  });

});
//]]>
