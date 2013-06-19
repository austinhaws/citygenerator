function city_layout(options) {
	var data = $.extend(
		{
			container : false // the jquery canvas
			, height: 100 // the height of the canvas
			, width: 100 // width of the canvas
			, city : false // the city rendered
			, cells : [] // the raphael cells of the city
		}
		, options
	);
	globals.ward_lookup = {}; // key = ward_id, value = ward // made global so external functions can use it (HACK!!!)

	if (data.container) {
		// show the cells
		var cell;
		var output = '';
		var layout_size = data.city.layout.width * data.city.layout.height;
		var ward_id;

		// give wards a letter and set up a ward_id_index for easier lookup
		$.each(data.city.wards, function(idx, ward) {
			globals.ward_lookup[ward.id] = ward;
		});
		// add a letter for the outskirt wards
		globals.ward_lookup[-1] = {letter:'-'};
		// add non-wards letters
		for (var i = 0; i < layout_size; i++) {
			ward_id = data.city.layout.cells[i].ward_id;
			if (!globals.ward_lookup[ward_id]) {
				globals.ward_lookup[ward_id] = {
					letter:'&nbsp;'
					, id:ward_id
				}; // add the letter for the ward for later use
			}
		}
		// give all the wards a color
		var ward_lookup_count = 0;
		var location;
		var ratio;
		// count wards and give each ward an idx/location for the ratio
		$.each(globals.ward_lookup, function(ward_id, ward) {
			ward.location = ward_lookup_count++;
		});
		$.each(globals.ward_lookup, function(ward_id, ward) {
			location = ward.location;
			// get the ratio of hue
			ratio = location / ward_lookup_count; // ratio of 360
			// create the color
			ward.color = 'hsla(' + (ratio * 360.0) + ',' + (90 + Math.random() * 10) +'%,' + (50 + Math.random() * 10) + '%, 1)';
		});



		// output ascii for the wards
		var cell;
		for (var i = 0; i < layout_size; i++) {
			cell = data.city.layout.cells[i];
			// add new line after width
			if (i && i % data.city.layout.width == 0) {
				output += '<br />';
			}
			// show letters for wards
			ward_id = cell.ward_id;
			if (ward_id === false) {
				ward_id = -1;
			}
			ward_lookup = globals.ward_lookup[ward_id];
			var letter = ward_lookup.letter;
			if (!ward_lookup.show_ward_list) {
				letter = '&nbsp;';
			}
			output += '<span class="cell'
				+ (cell.touches_outside ? ' touches-outside ' : '')
				+ (cell.walls.bottom ? ' wall-bottom ' : '')
				+ (cell.walls.top ? ' wall-top ' : '')
				+ (cell.walls.left ? ' wall-left ' : '')
				+ (cell.walls.right ? ' wall-right ' : '')
				+ '" data-letter="' + ward_lookup.letter + '" data-ward-id="' + ward_id + '" style="color:' + ward_lookup.color + '" data-color="' + ward_lookup.color + '">' + letter + '</span>';
		}
		// show the layout
		data.container.html(output);

		// set up hover for the wards
		data.container.find('.cell').hover(function() {
			show_layout_ward($(this).data('ward-id'));
		}, function() {
		});
	}
}

// ward_id: the ward_id with which to interact
// hovered: (bool) true = show in black being hovered; false = show in original color not being hovered
function show_layout_ward(ward_id) {
	// hide previous if there is one
	if (globals.last_show_layout_ward_id) {
		var last_ward_lookup = globals.ward_lookup[globals.last_show_layout_ward_id];
		$('[data-letter="' + last_ward_lookup.letter + '"]').css({color:last_ward_lookup.color});
	}

	// show the new ward
	var ward_lookup = globals.ward_lookup[ward_id];
	if (ward_lookup.show_ward_list) {
		globals.last_show_layout_ward_id = ward_id;
		$('#layout-container-container').show();
		$('[data-letter="' + ward_lookup.letter + '"]').css({color:'black'});
		show_ward_detail(ward_id);
	}
}

function show_ward_detail(ward_id) {
	for (var i = 0; i < globals.city.wards.length; i++) {
		if (globals.city.wards[i].id == ward_id) {
			if (globals.city.wards[i].show_ward_list) {
				globals.templates.render($('#layout-container-detail') , 'city-ward-detail', globals.city.wards[i], 'html');

				// set float sizes for the map and detail sections
				var layout_container = $('#layout-container');
				var layout_container_width = layout_container.outerWidth();
				var layout_container_detail = $('#layout-container-detail');
				var latest_post = $('#latest-post');
				var latest_post_width = latest_post.width();
				// from css, this is the width of the buildings columns
				var column_width = $($('.ward_buildings .building')[0]).outerWidth(true);
				var available_width = latest_post_width - layout_container_width;
				var column_mod_width = available_width % column_width;
				var detail_width = available_width - column_mod_width;

				layout_container_detail.width(detail_width);
				layout_container_detail.css({'margin-left':column_mod_width / 2});
			}
			break;
		}
	}
}
