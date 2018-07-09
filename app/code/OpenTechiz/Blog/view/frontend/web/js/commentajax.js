define([
	"jquery",
	"jquery/ui"
], function($) {
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
						$('.note').html(data.message);
						$('.note').css('color', 'red');
						document.getElementById("comment-form").reset();
						return true;
					})
			}
		});
	};
	return main;
});