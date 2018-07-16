define([
	"jquery",
	"jquery/ui",
	"loadcomment"
], function($, ui, loadcomment) {
	"use strict";

	function main(config, element) {
		var $element = $(element);
		// lay config tu ben form-comment o doan script
		var AjaxCommentPostUrl = config.AjaxCommentPostUrl;

		var dataForm = $('#comment-form');
		dataForm.mage('validation', {});

		// click vao button voi class submit
		$(document).on('click','#comment_ajax', function() {
			if (dataForm.valid()){
			event.preventDefault();
				var param = dataForm.serialize();
				//alert(param);
					$.ajax({
						showLoader: true,
						url: AjaxCommentPostUrl,
						data: param,
						type: "POST"
					}).done(function (data) {
						if(data.result== "error"){
							$('.note').css('color', 'red');
							$('.note').html(data.message);
							return false;
						}
						$('.note').html(data.message);
						$('.note').css('color', 'red');
						document.getElementById("comment-form").reset();
						loadcomment.loadComments(config);
						return true;
					})
			}
		});
	};
	return main;
});