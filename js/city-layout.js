function city_layout(options) {
	var data = $.extend(
		{
			container : false // the jquery canvas
			, height: 100 // the height of the canvas
			, width: 100 // width of the canvas
			, city : false // the city rendered
			, cells : [] // the raphael cells of the city
			, ward_lookup : {} // key = ward_id, value = ward
		}
		, options
	);

	if (data.container) {
		// show the cells
		var cell;
		var output = '';
		var layout_size = data.city.layout.width * data.city.layout.height;
		var ward_id;

		// give wards a letter and set up a ward_id_index for easier lookup
		$.each(data.city.wards, function(idx, ward) {
			data.ward_lookup[ward.id] = ward;
		});
		// add a letter for the outskirt wards
		data.ward_lookup[-1] = {letter:'-'};
		// add non-wards letters
		for (var i = 0; i < layout_size; i++) {
			ward_id = data.city.layout.cells[i].ward_id;
			if (!data.ward_lookup[ward_id]) {
				data.ward_lookup[ward_id] = {
					letter:'•'
					, id:ward_id
				}; // add the letter for the ward for later use
			}
		}
		// give all the wards a color
		var ward_lookup_count = 0;
		var location;
		var ratio;
		// count wards and give each ward an idx/location for the ratio
		$.each(data.ward_lookup, function(ward_id, ward) {
			ward.location = ward_lookup_count++;
		});
		$.each(data.ward_lookup, function(ward_id, ward) {
			location = ward.location;
			// get the ratio of hue
			ratio = location / ward_lookup_count; // ratio of 360
			// create the color
			ward.color = 'hsla(' + (ratio * 360.0) + ',' + (90 + Math.random() * 10) +'%,' + (50 + Math.random() * 10) + '%, 1)';
		});



		// output ascii for the wards
		for (var i = 0; i < layout_size; i++) {
			// add new line after width
			if (i && i % data.city.layout.width == 0) {
				output += '<br />';
			}
			// show letters for wards
			ward_id = data.city.layout.cells[i].ward_id;
			if (ward_id === false) {
				ward_id = -1;
			}
			ward_lookup = data.ward_lookup[ward_id];
			output += '<span class="cell" data-letter="' + ward_lookup.letter + '" data-ward-id="' + ward_id + '" style="color:' + ward_lookup.color + '" data-color="' + ward_lookup.color + '">' + ward_lookup.letter + '</span>';
		}
		// show the layout
		data.container.html(output);

		// set up hover for the wards
		data.container.find('.cell').hover(function() {
			var elem = $(this);
			var ward_id = $(this).data('ward-id');
			var ward_lookup = data.ward_lookup[ward_id];
			$('[data-letter="' + ward_lookup.letter + '"]').css({color:'black'});
		}, function() {
			var elem = $(this);
			var ward_id = $(this).data('ward-id');
			var ward_lookup = data.ward_lookup[ward_id];
			var color = elem.data('color');
			$('[data-letter="' + ward_lookup.letter + '"]').css({color:color});
		});
	}
}
