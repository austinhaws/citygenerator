$(function() {
	globals.templates.load_templates('templates/citygen.htm', function() {
		// what needs done after templates loaded?
	});

	// give ward buildings their ratio/percentages; also make a mustache friendly array
	$.each(globals.wards, function(idx_wards, ward) {
		globals.wards_mustache[idx_wards] = [];
		var last_percent = 0;
		$.each(ward, function(idx_building, building) {
			building.ratio = idx_building - last_percent;
			last_percent = idx_building;

			// combine same named buildings
			var found = false;
			$.each (globals.wards_mustache[idx_wards], function(idx_match, match_ward) {
				if (found = (match_ward.type == building.type)) {
					match_ward.ratio += building.ratio;
				}
				return !found;
			});
			if (!found) {
				globals.wards_mustache[idx_wards].push(building);
			}
		});
		globals.wards_mustache[idx_wards].sort(function(a, b) {
			return a.type > b.type;
		});
	});


	$('#generate-button').click(function(e) {
		var wards_added = $('table.ward-added');
		var info;
		var wards = [];

		if ($('[name="buildings"]').prop('checked')) {
			$.each(wards_added, function(idx1, ward_added) {
				ward_added = $(ward_added);
				info = {
					ward: ward_added.find('.ward-title').data('name')
					, buildings: []
				};
				$.each($('.ward-building'), function(idx2, ward_building) {
					ward_building = $(ward_building);
					info.buildings.push({
						type: ward_building.find('.ward-building-name').data('type')
						, weight: ward_building.find('.ward-building-ratio').val()
					});
				});
				wards.push(info);
			});
			$('[name="wards-added"]').val(JSON.stringify(wards));
		} else {
			$('[name="wards-added"]').val('');
		}
		$('#generate-form').submit();
	});

	$('#add-ward-button').click(function(e) {
		var ward = $('[name="ward-list"]').val();

		switch (ward) {
			case 'random':
				ward = globals.wards_list[Math.floor(Math.random() * globals.wards_list.length)];
			break;
		}

		if (ward) {
			// show the ward and its buildings
			var tr = globals.templates.renderHtml('options-ward-detail', {name:ward, buildings:globals.wards_mustache[ward]});
			var trs = $('.wards-defining');
			var tr = $(tr);
			tr.insertAfter($(trs[trs.length - 1]));
			tr.find('.ward-remove-button').click(function(e) {
				$(this).closest('.wards-defining').remove();
			});

		}
	});

	// show/hide wards depending on if generating buildings
	$('[name="buildings"]').change(function(e) {
		$('.wards-defining')[$(this).prop('checked') ? 'show' : 'hide']();
	});
});
