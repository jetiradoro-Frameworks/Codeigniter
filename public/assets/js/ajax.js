ajax = {
	getHTML: function(uri,data,functionOK,functionFail){
		$.ajax({
			url: '/'+uri,
			type: 'POST',
			dataType: "html",
			data: data,
			success: functionOK,
			error: functionFail,
		});		
	},

	getJSON: function(uri,data,functionOK,functionFail){
		$.ajax({
			url: '/'+uri,
			dataType: "json",
			type: 'POST',
			data: data,
			success: functionOK,
			error: functionFail,
		});		
	}
};