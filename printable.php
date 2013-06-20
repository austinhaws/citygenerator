<script src="js/jquery-1.9.1.min.js"></script>
<script>
	$(function() {
		opener.window.globals.templates.render($('#printable') , 'city-printable', opener.window.globals.city, 'html');

		// show layout
		// show the cells
		var cell;
		var output = '';
		var layout_size = opener.window.globals.city.layout.width * opener.window.globals.city.layout.height;
		var ward_id;

		// give wards a letter and set up a ward_id_index for easier lookup
		$.each(opener.window.globals.city.wards, function(idx, ward) {
			opener.window.globals.ward_lookup[ward.id] = ward;
		});
		// add a letter for the outskirt wards
		opener.window.globals.ward_lookup[-1] = {letter:'-'};
		// add non-wards letters
		for (var i = 0; i < layout_size; i++) {
			ward_id = opener.window.globals.city.layout.cells[i].ward_id;
			if (!opener.window.globals.ward_lookup[ward_id]) {
				opener.window.globals.ward_lookup[ward_id] = {
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
		$.each(opener.window.globals.ward_lookup, function(ward_id, ward) {
			ward.location = ward_lookup_count++;
		});
		$.each(opener.window.globals.ward_lookup, function(ward_id, ward) {
			location = ward.location;
			// get the ratio of hue
			ratio = location / ward_lookup_count; // ratio of 360
			// create the color
			ward.color = 'hsla(' + (ratio * 360.0) + ',' + (90 + Math.random() * 10) +'%,' + (50 + Math.random() * 10) + '%, 1)';
		});



		// output ascii for the wards
		var cell;
		for (var i = 0; i < layout_size; i++) {
			cell = opener.window.globals.city.layout.cells[i];
			// add new line after width
			if (i && i % opener.window.globals.city.layout.width == 0) {
				output += '<br />';
			}
			// show letters for wards
			ward_id = cell.ward_id;
			if (ward_id === false) {
				ward_id = -1;
			}
			ward_lookup = opener.window.globals.ward_lookup[ward_id];
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
console.log([$('#layout'), output]);
		$('#layout').html(output);

	});
</script>
<link rel="stylesheet" type="text/css" href="printable.css" />
<div id="printable"></div>
<script>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34431316-1']);
  _gaq.push(['_setDomainName', 'crystalballsoft.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
