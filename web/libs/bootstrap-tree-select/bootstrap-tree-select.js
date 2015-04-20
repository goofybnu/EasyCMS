(function($){
	var selectTreePicker = function (element, options, e) {
		if (e) {
			e.stopPropagation();
			e.preventDefault();
		}

		this.$element = $(element);
		this.$newElement = null;
		this.$button = null;
		this.$menu = null;
		this.$lis = null;
		this.options = options;

		this.val = selectTreePicker.prototype.val;
		this.render = selectTreePicker.prototype.render;
		this.refresh = selectTreePicker.prototype.refresh;
		this.setStyle = selectTreePicker.prototype.setStyle;
		this.selectAll = selectTreePicker.prototype.selectAll;
		this.deselectAll = selectTreePicker.prototype.deselectAll;
		this.destroy = selectTreePicker.prototype.remove;
		this.remove = selectTreePicker.prototype.remove;
		this.show = selectTreePicker.prototype.show;
		this.hide = selectTreePicker.prototype.hide;

		this.init();
	};

	selectTreePicker.VERSION = '1.0.0';

	selectTreePicker.DEFAULTS = {
	}

	selectTreePicker.prototype = {
		constructor: selectTreePicker,
		init: function () {
			alert('init');
		}
	};

	function Plugin(option, event) {
		var args = arguments;
		var _option = option, option = args[0], event = args[1];
		[].shift.apply(args);
		var $this = $(this);
		if ($this.is('div')) {
			var menuItems = $this.find('ul');
			$this.html('');
			$this.append(
				$('<div class="btn-group bootstrap-tree-select" style="width: 100%;">').append(
					$('<button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown"><span class="filter-option pull-left"></span>&nbsp;<span class="caret"></span></button>')
				).append(
					$('<div class="dropdown-menu open">').append(
						$('<div id="innerMenu">').append(
							$('<nav>').append(
								$(menuItems)
							)
						)
					)
				)
			);
			$this.find('.bootstrap-tree-select').addClass('open');
			$this.find('#innerMenu').multilevelpushmenu({
				mode:'cover',
				direction:'ltr',
				menuWidth:'100%',
				backText:'teste'
			});
			//$this.find('.bootstrap-tree-select').removeClass('open');
		}
	}

	$.fn.selectTreePicker = Plugin;
	$.fn.selectTreePicker.Constructor = selectTreePicker;
	$.fn.selectTreePicker.noConflict = function () {
		$.fn.selectTreePicker = old;
		return this;
	};

	$(window).on('load.bs.select.data-api', function () {
		$('.selectTreePicker').each(function () {
			var $selectTreePicker = $(this);
			Plugin.call($selectTreePicker, $selectTreePicker.data());
		})
	});
})(jQuery);






























/*
(function($){
	$.bootstrapTreeSelect = function(selector, settings){
		// settings
		var config = {
			'width': '250px'
		};
		if ( settings ){$.extend(config, settings);}

		// variables
		var obj = $(selector);
		var img = obj.children('img');
		var count = img.length;
		var i = 0;

		// show first image
		img.eq(0).show();

		// run slideshow
		setInterval(function(){
			img.eq(i).fadeOut(config.fadeSpeed);
			i = ( i+1 == count ) ? 0 : i+1;
			img.eq(i).fadeIn(config.fadeSpeed);
		}, config.delay);

		return this;
	};
})(jQuery);
*/
