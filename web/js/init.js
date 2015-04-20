$(function(){
	$('.decimalInput').inputmask({'mask':["9{0,10}.9{0,2}", "9999999999"]});
	$('[data-toggle="tooltip"]').tooltip();
	$("#popDelete").hide();
	$(".btn-delete").on("click", function() {
		var obj = $(this);
		var pk = $(this).data("pk");
		var column = $(this).data("column");
		$(".btn-delete-confirm").unbind("click");
		$(".btn-delete-confirm").bind("click", function(){
			$("#popDelete").hide();
			obj.closest("tr").fadeTo("slow" , 0.25);
			$.post("./", { ajax:true, action:"delete", item:pk, pkColumn:column }).done(function(data){
				var response = jQuery.parseJSON(data);
				console.log(response);
				if(response.error==true){
					obj.closest("tr").fadeTo("slow" , 1);
					alert("Erro ao excluir tente novamente!");
				} else {
					obj.closest("tr").fadeOut(30, function() { $(this).remove(); });
				}
			});
		});
		var $menu = $("#popDelete").show();
		var pos = $.PositionCalculator( {
			target: this,
			targetAt: "top center",
			item: $menu,
			itemAt: "bottom center",
			flip: "both"
		}).calculate();

		$menu.css({
			top: parseInt($menu.css("top")) + pos.moveBy.y + "px",
			left: parseInt($menu.css("left")) + pos.moveBy.x + "px"
		});
	});
	$(".btn-delete-cancel").click(function() {
		$("#popDelete").hide();
	});

	$('.ativoInativo').editable({
		url:"./", 
		emptytext:"Em branco", 
		params:{ 
			"ajax":true, 
			"action":"save" 
		}, 
		source: [
			{value: 0, text: 'Desativado'},
			{value: 1, text: 'Ativo'}
		]
	});

	$('a.external').on('click', function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		var title = $(this).data('title');
		$(".modal-external-title").html(title);
		$(".modal-external-body").html('<iframe id="externalIframe" width="100%" height="100%" frameborder="0" scrolling="yes" allowtransparency="true" src="'+url+'"></iframe>');
		$('#externalModal').modal('show');
		$('#externalIframe').iframeAutoHeight({heightOffset: 40});
	});

	$('#externalModal').on('hidden.bs.modal', function(){
		$("#externalIframe").remove();
	});

	$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$(this).parent().addClass('open');
		var menu = $(this).parent().find("ul");
		var menupos = menu.offset();
		if ((menupos.left + menu.width()) + 30 > $(window).width()) {
			var newpos = - menu.width();
		} else {
			var newpos = $(this).parent().width();
		}
		menu.css({ left:newpos });
	});
	$('.daterange-day').datepicker({ format: "dd/mm/yyyy", todayBtn: "linked", language: "pt-BR" });
	$('.daterange-month').datepicker({ format: "mm/yyyy", minViewMode:1, language: "pt-BR" });
});

String.prototype.replaceAll = function(str1, str2, ignore) {
	return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
}

function getIdBySigla(sigla){
	for(i=0;i<DadosClasses.length;i++){
		if(sigla==DadosClasses[i]['sigla']){
			return DadosClasses[i]['id'];
		}
	}
}

function montaSelect(objeto, dados, nivel){
	obj = $(objeto);
	obj.html('');
	obj.append('<option value="" data-sigla="__.____">Selecione</option>');
	for(i=0;i<dados.length;i++){
		if(dados[i].subid == nivel){
			obj.append('<option value="'+dados[i]['id']+'" data-sigla="'+dados[i]['sigla']+'">'+dados[i]['text']+'</option>');
		}
	}
	obj.selectpicker('refresh');
}

$(document).ready(function(){

	$(".xEditable").editable({
		mode:"inline",
		type:"text",
		url:"./",
		emptytext:"Em branco",
		params:{ "ajax":true, "action":"save" },
		success: function(response, newValue){ document.location.reload(); }
	});

	$(".xEditableDate").editable({ 
		mode:"inline",
		placement: 'right', 
		type:"text", 
		url:"./", 
		emptytext:"Em branco", 
		params:{ "ajax":true, "action":"save" }, 
		format: 'yyyy-mm-dd hh:ii:ss', 
		viewformat: 'dd/mm/yyyy hh:ii:ss', 
		datetimepicker: { weekStart: 1 } 
	});

	$(".datetimepicker").editable({
		tpl: "<input type='text' class='form-control'></input>",
		format: "yyyy-mm-dd hh:ii",
		viewformat: "dd/mm/yyyy hh:ii",
		datetimepicker: {
			weekStart: 1
		}
	});
});

(function ($) {
	"use strict";

	var Location = function (options) {
		this.sourceCountryData = options.sourceCountry;
		this.init('location', options, Location.defaults);
	};

	//inherit from Abstract input
	$.fn.editableutils.inherit(Location, $.fn.editabletypes.abstractinput);

	$.extend(Location.prototype, {

		render: function () {
			this.$input = this.$tpl.find('input');
			this.$list = this.$tpl.find('select');

			this.$list.empty();
			this.$list.selectpicker();
			this.$input.inputmask({ mask: '99.9999' });

			montaSelect('#edt_classes', DadosClasses, 0);

			$('#edt_classes').on('change', function(){
				montaSelect('#edt_classes2', DadosClasses, $(this).val());
				montaSelect('#edt_classes3', DadosClasses, '');
				montaSelect('#edt_classes4', DadosClasses, '');
				$('#edt_codigo').val($('option:selected', this).data('sigla'));
			});

			$('#edt_classes2').on('change', function(){
				montaSelect('#edt_classes3', DadosClasses, $(this).val());
				montaSelect('#edt_classes4', DadosClasses, '');
				$('#edt_codigo').val($('option:selected', this).data('sigla'));
			});

			$('#edt_classes3').on('change', function(){
				montaSelect('#edt_classes4', DadosClasses, $(this).val());
				$('#edt_codigo').val($('option:selected', this).data('sigla'));
			});

			$('#edt_classes4').on('change', function(){
				$('#edt_codigo').val($('option:selected', this).data('sigla'));
			});

			$('#edt_codigo').on('keyup', function(){
				var sigla = $(this).val();
				var itemId = getIdBySigla(sigla);
				var codigo = sigla.replace(/[_\.]/g,"");
				if(codigo.length==1){
					$('#edt_classes').selectpicker('val', itemId);
					montaSelect('#edt_classes2', DadosClasses, $('#edt_classes').val());
				} else if(codigo.length==2){
					$('#edt_classes2').selectpicker('val', itemId);
					montaSelect('#edt_classes3', DadosClasses, $('#edt_classes2').val());
				} else if(codigo.length==4){
					$('#edt_classes3').selectpicker('val', itemId);
					montaSelect('#edt_classes4', DadosClasses, $('#edt_classes3').val());
				} else if(codigo.length==6){
					$('#edt_classes4').selectpicker('val', itemId);
				} else if(codigo.length==0){
					$('#edt_classes').selectpicker('val', '');
					$('#edt_classes2').selectpicker('val', '');
					$('#edt_classes3').selectpicker('val', '');
					$('#edt_classes4').selectpicker('val', '');
				}
			});
		},
	});

	Location.defaults = $.extend({}, $.fn.editabletypes.abstractinput.defaults, {
		tpl: ''+
			'<div class="editable-location"><select id="edt_classes" class="selectpicker" data-live-search="true" data-width="500"></select></div>'+
			'<div class="editable-location"><select id="edt_classes2" class="selectpicker" data-live-search="true" data-width="500"></select></div>'+
			'<div class="editable-location"><select id="edt_classes3" class="selectpicker" data-live-search="true" data-width="500"></select></div>'+
			'<div class="editable-location"><select id="edt_classes4" class="selectpicker" data-live-search="true" data-width="500"></select></div>'+
			'<div class="editable-location"><input type="text" id="edt_codigo" class="form-control" data-mask="99.9999"></div>',
		inputclass: '',
		showbuttons: 'bottom',
		sourceCountry: []
	});

	$.fn.editabletypes.location = Location;

}(window.jQuery));

$(function(){
	$('.location').editable({
		url: './',
		title: 'Selecione a atividade',
		placement: 'right',
		success: function(response, newValue){ document.location.reload(); }
	});
});
