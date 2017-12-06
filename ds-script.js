jQuery(document).ready(function($) {
	jQuery(document).on('click', '.et_mobile_menu .menu-item-has-children', function(){
	  jQuery(this).find('.sub-menu').toggleClass('open');
	});

	var planSection = jQuery('#content-area > .flex-wrapper');

	jQuery('#plan-switch').on('change', function(){
		if(this.checked){
			jQuery('.yearly').removeClass('hide');
			jQuery('.monthly').addClass('hide');
			jQuery('.features-list li[data-duration=month]').hide();
			jQuery('.features-list li[data-duration=year]').show();
		}else{
			jQuery('.yearly').addClass('hide');
			jQuery('.monthly').removeClass('hide');
			jQuery('.features-list li[data-duration=year]').hide();
			jQuery('.features-list li[data-duration=month]').show();
		}
	});

	if(jQuery('.individuals').length){

		jQuery('.signup-btn').on('click', function(){

			jQuery('html, body').animate({
	          scrollTop: planSection.offset().top - 50
	        }, 800);

			var tableWrapper = jQuery(this).parents()[2];
			var currentTable = jQuery(this).parents()[1];
			var actualPrice = jQuery(currentTable).find('.plan-price').data('actual-price').toString().split('.')[0];
			if(jQuery(currentTable).hasClass('monthly')){
				jQuery('#yearly-charges').hide();
				var totalPrice = actualPrice * 3;
				jQuery('#monthly-charges').show().find('.dollarsX3').html(totalPrice);
				jQuery('#monthly-charges .centsX3').html('.00');
				jQuery('#monthly-charges .dollars').html(actualPrice);
				jQuery('#monthly-charges .cents').html('.00');
			}

			if(jQuery(currentTable).hasClass('yearly')){
				jQuery('#monthly-charges').hide();
				jQuery('#yearly-charges').show();
				var totalPrice = actualPrice;
				jQuery(currentTable).find('.yearly-plan-price .actual-price').html(totalPrice);
				jQuery('#yearly-charges .dollarsY').html(totalPrice);
				jQuery('#yearly-charges .centsY').html('.00');
			}
			jQuery("#SelectedPlanId").val($(this).attr('id'));
			jQuery(tableWrapper).addClass('payment-mode');
			jQuery('.custom-pricing-table').removeClass('active');
			jQuery(currentTable).addClass('active');
		});

		jQuery('.back-btn').on('click', function(){
			var tableWrapper = jQuery(this).parents()[2];
			var currentTable = jQuery(this).parents()[1];
			jQuery("#SelectedPlanId").val(0);
			jQuery(tableWrapper).removeClass('payment-mode');
			jQuery('.custom-pricing-table').removeClass('active');
		});

	}

	if(jQuery('.managers').length){

		jQuery('[name="payment-method"]').on('change', function(){
			var paymentMethod = jQuery(this).val();
			if(paymentMethod == 'invoicing'){
			  jQuery('.invoice').removeClass('hide');
			  jQuery('.credit-card').addClass('hide');
			}else{
		      jQuery('.invoice').addClass('hide');
			  jQuery('.credit-card').removeClass('hide');
			}
		});

		jQuery('.signup-btn').on('click', function(){
			jQuery('html, body').animate({
	          scrollTop: planSection.offset().top - 250
	        }, 800);
			var tableWrapper = jQuery(this).parents()[2];
			var currentTable = jQuery(this).parents()[1];
			var teamSize = jQuery('#team-size').val();
			var actualPrice = jQuery(currentTable).find('.plan-price').data('actual-price').toString().split('.')[0];
			if(jQuery(currentTable).hasClass('monthly')){
				jQuery('#yearly-charges').hide();
				var totalPrice = actualPrice * 3;
				var totalTeamPrice = totalPrice * teamSize;
				jQuery('#monthly-charges').show().find('.dollarsX3').html(totalTeamPrice);
				jQuery('#monthly-charges .centsX3').html('.00');
				jQuery('#monthly-charges .dollars').html(actualPrice * teamSize);
				jQuery('#monthly-charges .cents').html('.00');
			}

			if(jQuery(currentTable).hasClass('yearly')){
				jQuery('#monthly-charges').hide();
				jQuery('#yearly-charges').show();
				var totalPrice = actualPrice;
				var totalTeamPrice = totalPrice * teamSize;
				jQuery(currentTable).find('.yearly-plan-price .actual-price').html(totalPrice);
				jQuery('#yearly-charges .dollarsY').html(totalTeamPrice);
				jQuery('#yearly-charges .centsY').html('.00');
			}

			jQuery("#SelectedPlanId").val($(this).attr('id'));
			jQuery(tableWrapper).addClass('payment-mode');
			jQuery('.custom-pricing-table').removeClass('active');
			jQuery(currentTable).addClass('active');
		});

		jQuery('#team-size').on('change', function(){
			var teamSize = jQuery(this).val();
			var planPrice = jQuery('.custom-pricing-table.active .plan-price').data('actual-price');
			var planPriceX3 = planPrice * 3;
			var planPriceYearly = planPrice * 12;
			jQuery('#monthly-charges .dollarsX3').html(planPriceX3 * teamSize);
			jQuery('#monthly-charges .dollars').html(planPrice * teamSize);
			jQuery('#yearly-charges .dollarsY').html(planPriceYearly * teamSize);
			jQuery('#TeamSize').val(teamSize);
		});


		jQuery('.back-btn').on('click', function(){
			var tableWrapper = jQuery(this).parents()[2];
			var currentTable = jQuery(this).parents()[1];
			jQuery("#SelectedPlanId").val(0);
			jQuery(tableWrapper).removeClass('payment-mode');
			jQuery('.custom-pricing-table').removeClass('active');
		});

	}

});