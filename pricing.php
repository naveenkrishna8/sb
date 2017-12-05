<?php
    /**
    * Template Name: Pricing template
    */
?>  

<?php get_header(); ?>
<script src="https://js.recurly.com/v4/recurly.js"></script>
<div class="custom-main">

<?php while ( have_posts() ) : the_post(); ?>
				<div class="entry-content">
					<?php
						the_content();
					?>
				</div> <!-- .entry-content -->
			<?php endwhile; ?>
	<div class="container">
	<?php $data = getSubscriptionPlans(); ?>
		<div id="content-area" class="clearfix">

			<div class="flex-wrapper individuals">

				<div class="features">
					<div class="feature-header">
						<span>Features</span>
					</div>
					<div class="switch-wrap">
						<span>Monthly</span>
						<label class="switch">
						  <input type="checkbox" id="plan-switch">
						  <span class="switch-slider round"></span>
						</label>
						<span>Annual</span>
					</div>
					<!-- Show features list  -->
					<ul class="features-list">
						<?php foreach($data['monthly_plans']['features'] as $features){ ?>
						<li data-duration="month"><?php echo $features; ?></li>
						<?php } ?>
						<?php foreach($data['yearly_plans']['features'] as $features){ ?>
						<li data-duration="year" style="display:none;"><?php echo $features; ?></li>
						<?php } ?>
					</ul>
				</div>
				<!-- Show Monthly palns  -->
				<?php foreach($data['monthly_plans']['plans'] as $plans){ ?>
					<div class="custom-pricing-table monthly">
						<div class="pricing-header">
							<div class="plan-name">
								<div><?php echo $plans->DisplayTitle; ?></div>
								<small><?php echo $plans->Name; ?></small>
							</div>
							<div class="plan-price" data-actual-price="<?php echo $plans->PriceTiers[0]->UnitPrice; ?>">
								<span class="currency">$</span>
								<span class="actual-price"><?php echo $plans->PriceTiers[0]->UnitPrice; ?></span>
								<span class="cents">.00</span>
							</div>
							<p class="plan-price-text">per month</p>
						</div>
						<ul class="plan-desc-list">
							<?php foreach($data['monthly_plans']['desc'] as $key=>$desc ){ ?>
								<?php if($desc[$plans->Level]){ ?>
									<li>
									<span aria-hidden="true" class="icon_check"></span>
									<span><?php echo $key; ?></span>
								</li>
								<?php }else{ ?>
								<li class="empty-feature"></li>	
								<?php } ?>
								
							<?php } ?>
						</ul>
						<div class="button-wrap">
							<button type="button" class="signup-btn theme-btn">Get Started</button>
							<button type="button" class="back-btn">Back to Plans</button>	
						</div>
					</div>
				<?php } ?>
				<!-- End Monthly palns  -->
				<!-- Show Yearly palns  -->
				<?php foreach($data['yearly_plans']['plans'] as $y_plans){ ?>
					<div class="custom-pricing-table yearly hide">
						<div class="pricing-header">
							<div class="plan-name">
								<div><?php echo $y_plans->DisplayTitle; ?></div>
								<small><?php echo $y_plans->Name; ?></small>
							</div>
							<div class="plan-price" data-actual-price="<?php echo round($y_plans->PriceTiers[0]->UnitPrice); ?>">
								<span class="currency">$</span>
								<span class="actual-price"><?php echo round($y_plans->PriceTiers[0]->UnitPrice/12); ?></span>
								<span class="cents">.00</span>
							</div>
							<div class="plan-price yearly-plan-price">
								<span class="currency">$</span>
								<span class="actual-price"></span>
								<span class="cents">.00</span>
							</div>
							<p class="plan-price-text">per month</p>
							<p class="yearly-plan-price-text">effective price per yearly</p>
						</div>
						<ul class="plan-desc-list">
							<?php foreach($data['yearly_plans']['desc'] as $key=>$desc ){ ?>
								<?php if($desc[$y_plans->Level]){ ?>
									<li>
									<span aria-hidden="true" class="icon_check"></span>
									<span><?php echo $key; ?></span>
								</li>
								<?php }else{ ?>
								<li class="empty-feature"></li>	
								<?php } ?>
								
							<?php } ?>
						</ul>
						<div class="button-wrap">
							<button type="button" class="signup-btn theme-btn">Get Started</button>
							<button type="button" class="back-btn">Back to Plans</button>	
						</div>
					</div>
				<?php } ?>
				<!-- End Yearly palns  -->
				<!-- Payment Forms-->
				<div class="payment-section">
					<div class="payment-header">
						<span>your payment information is protected</span>
						<h2>Monthly Credit Card</h2>
					</div>
					<div class="payment-body">
						<p class="text-center">Start using Salesboost now! Fill out the form below with your payment information and start using Salesboost today:</p>
						<form id="payment-from" method="POST">
							<div class="flex-wrapper">
								<div class="payment-info">
									<div class="input-row-2">
										<div class="input-wrap">
											<input type="text" name="FirstName" placeholder="First Name" data-recurly="first_name" required>
											<span class="required">*</span>
										</div>
										<div class="input-wrap">
											<input type="text" placeholder="Last Name" name="LastName" data-recurly="last_name" required>
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="email" name="Email" placeholder="Email" required>
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" name="AccountName" placeholder="Name for account" required>
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" name="phoneNumber" placeholder="Phone number" data-recurly="phone">
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" name="address1" placeholder="Street address" data-recurly="address1" required>
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" name="address2" placeholder="Unit/Apartment/Building Number" data-recurly="address2">
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" name="city" placeholder="City" data-recurly="city" required>
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" name="state" placeholder="State" data-recurly="state" required>
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" placeholder="Postal code" data-recurly="postal_code" required>
											<span class="required">*</span>
										</div>
									</div>
								</div>
								<!-- cc-payment-info-->
								<div class="cc-payment-info">
									<div  data-recurly="number" id ="number"></div>
									<div  data-recurly="month" id="month"></div>
									<div  data-recurly="year" id="year"></div>
									<div  data-recurly="cvv" id="cvv"></div>

									<div id="monthly-charges" style="display: none;">
										<div class="monthly-charge-breakdown">
											<span class="currency">$</span>
											<span class="dollarsX3 actual-price"></span>
											<span class="centsX3"></span>
											<span class="charge-description">will be charged immediately</span>
										</div>
										<div class="monthly-charge-breakdown">
											<span class="currency">$</span>
											<span class="dollars actual-price"></span>
											<span class="cents"></span>
											<span class="charge-description">will be charged monthly after 3 months</span>
										</div>
									</div>
									<div id="yearly-charges" style="display: none;">
										<div class="monthly-charge-breakdown">
											<span class="currency">$</span>
											<span class="dollarsY actual-price"></span>
											<span class="centsY"></span>
											<span class="charge-description">will be charged automatically</span>
										</div>
									</div>
								</div>
							</div> <!--.cc-payment-info -->

							<div class="text-center">
								<input type="hidden" name="country" data-recurly="country" value="US" />
	                            <input type="hidden" name="recurly-token" data-recurly="token" />
	                            <input id="RecurlyToken" name="RecurlyToken" type="hidden" value="" />
	                            <input data-val="true" data-val-required="The SelectedPlanId field is required." id="SelectedPlanId" name="SelectedPlanId" type="hidden" value="0" />
	                            <input data-val="true" data-val-required="The TimeZoneOffset field is required." id="TimeZoneOffset" name="TimeZoneOffset" type="hidden" value="0" />
								<button type="button" class="theme-btn">Submit</button>	
							</div>
						</form>
					</div>
				</div>				
				
			</div>

			
		</div> <!-- #content-area -->
	</div> <!-- .container -->


</div> <!-- #main-content -->

<?php get_footer(); ?>