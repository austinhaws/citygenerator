function encrypt(string) {
	var salt = 'ujhuskedh!Â£)8J)o3uIoO4jjd3!';
	return $.rc4EncryptStr(string, salt);
}
function decrypt(string) {
	return $.rc4DecryptStr(string, 'ujhuskedh!Â£)8J)o3uIoO4jjd3!');
}

function hasWhiteSpace(s) {
	return /\s+/.test(s);
}

function strip_px(px) {
	return parseInt(px.substr(0, px.length - 2), 10);
}

function strcmp(str1, str2) {
	var str1 = str1.toLowerCase();
	var str2 = str2.toLowerCase();
	return (str1 == str2) ? 0 : ((str1 > str2) ? 1 : -1);
}

function input_enter_key(elem, callback) {
	$(elem).keypress(function(e) {
		switch(e.keyCode) {
			case 13:
				callback(elem);
			break;
		}
	});
}

function post(url, data, callback) {
	data.csrf_cyoa = $('[name="csrf_cyoa"]').val();
	$.post(url, data, function(return_data) {
		if (callback) {
			callback(return_data);
		}
	});
}

function template_loader() {
	var data = {
		self: this
		, partials : {}
	};

	this.load_templates = function(url, callback) {
		$.ajax({
			url: url //'js/templates/sprites.htm'
			, data: {}
			, success: function(templates) {
				data.templates = $(templates);
				$.each(data.templates, function(idx, template) {
					if (template.id) {
						data.partials[template.id] = $(template).html();
					}
				});
				callback();
			}
			, dataType: 'html'
			, error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus + ':' + errorThrown);
			}
		});
	};

	this.mustache_template = function(template_id) {
		return data.partials[template_id];
	};

	// elem is the jquery array of elements to apply template to
	// template_id is the loaded mustache template to render the data in to
	// template_data is the data to put in to the template
	// method is the jquery method to use on elem to put the rendered template in to the DOM (append, html)
	this.render = function(elem, template_id, template_data, method) {
		elem[method](this.renderHtml(template_id, template_data));
	};

	this.renderHtml = function(template_id, template_data) {
		return $.trim(Mustache.render(data.self.mustache_template(template_id), template_data, data.partials));
	};

}
