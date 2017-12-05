<?php
    /**
    * Template Name: Pricing template
    */
?>  
<?php get_header(); ?>
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
						<form>
							<div class="flex-wrapper">
								<div class="payment-info">
									<div class="input-row-2">
										<div class="input-wrap">
											<input type="text" placeholder="First Name">
											<span class="required">*</span>
										</div>
										<div class="input-wrap">
											<input type="text" placeholder="Last Name">
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="email" placeholder="Email">
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" placeholder="Name for account">
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" placeholder="Phone number">
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" placeholder="Street address">
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" placeholder="Unit/Apartment/Building Number">
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" placeholder="City">
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" placeholder="State">
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" placeholder="Postal code">
											<span class="required">*</span>
										</div>
									</div>
								</div>
								<div class="cc-payment-info">
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" placeholder="Number">
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" placeholder="MM">
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" placeholder="YYYY">
											<span class="required">*</span>
										</div>
									</div>
									<div class="input-row-1">
										<div class="input-wrap">
											<input type="text" placeholder="CVV">
											<span class="required">*</span>
										</div>
									</div>
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
							</div>
							<div class="text-center">
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