/**
 *  CMB Wizard JS
 *
 *  @description: This provides the functionality required to create the walkthrough
 */

(function ($) {
	"use strict";

	var metabox_wildcard_id = 'cmb_wizard_metabox_'; //@todo: update with your wildcard ID selector
	var animating; //flag to prevent quick multi-click glitches
	var current_fs, next_fs, previous_fs; //fieldsets/metaboxes
	var left, opacity, scale; //fieldset properties which we will animate

	$(function () {

		//loop through CMB Metaboxes
		//Since there are so many uses of the .postbox class we'll attach a wildcard ID selector
		var total = $("[id^=" + metabox_wildcard_id + "].postbox").length;

		$("[id^=" + metabox_wildcard_id + "].postbox").each(function (index) {

			//add CSS class to add postboxes for styles
			$(this).addClass('cmb-wizard-metabox');

			//hide all metabox containers except the first one
			if (index !== 0) {
				$(this).css('display', 'none');
				//Append prev/next buttons
				$(this).append('<input type="button" name="previous" value="&laquo; Previous " class="button button-primary button-large cmb-wizard-previous"/>');

				//No next button for last item
				if (index !== total - 1) {
					// this is NOT the last metabox
					$(this).append('<input type="button" name="next" value="Next &raquo;" class="button button-primary button-large cmb-wizard-next"/>');
				}

			}
			//First item
			else if (index === 0) {
				//Append only next button
				$(this).append('<input type="button" name="next" value="Next  &raquo;" class="button button-primary button-large cmb-wizard-next"/>');

			}

		});

		//Next button logic
		$('.cmb-wizard-next').on('click', function () {

			if (animating) return false;
			animating = true;
			current_fs = $(this).parent('.postbox');
			next_fs = $(this).parent('.postbox').next();


			//show the next metabox/fieldset
			next_fs.show();
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step    : function (now, mx) {
					//as the opacity of current_fs reduces to 0 - stored in "now"
					//1. scale current_fs down to 80%
					scale = 1 - (1 - now) * 0.2;
					//2. bring next_fs from the right(50%)
					left = (now * 50) + "%";
					//3. increase opacity of next_fs to 1 as it moves in
					opacity = 1 - now;
					current_fs.css({'transform': 'scale(' + scale + ')'});
					next_fs.css({'left': left, 'opacity': opacity});
				},
				duration: 800,
				complete: function () {
					current_fs.hide();
					animating = false;
				},
				//this comes from the custom easing plugin
				easing  : 'easeInOutBack'
			});


		}); //end next button click


		$('.cmb-wizard-previous').on('click', function () {
			current_fs = $(this).parent('.postbox');
			previous_fs = $(this).parent('.postbox').prev();

			//show the previous fieldset
			previous_fs.show();
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step    : function (now, mx) {
					//as the opacity of current_fs reduces to 0 - stored in "now"
					//1. scale previous_fs from 80% to 100%
					scale = 0.8 + (1 - now) * 0.2;
					//2. take current_fs to the right(50%) - from 0%
					left = ((1 - now) * 50) + "%";
					//3. increase opacity of previous_fs to 1 as it moves in
					opacity = 1 - now;
					current_fs.css({'left': left});
					previous_fs.css({'transform': 'scale(' + scale + ')', 'opacity': opacity});
				},
				duration: 800,
				complete: function () {
					current_fs.hide();
				},
				//this comes from the custom easing plugin
				easing  : 'easeInOutBack'
			});
		});


	}); //end of DOM ready

}(jQuery));