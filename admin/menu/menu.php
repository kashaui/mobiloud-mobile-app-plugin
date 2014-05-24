<?php
include_once dirname( __FILE__ ) . '/../../categories.php';
include_once dirname( __FILE__ ) . '/../../pages.php';
include_once dirname( __FILE__ ) . '/menugeneral.php';
include_once dirname( __FILE__ ) . '/urls.php';
include_once dirname( __FILE__ ) . '/../configuration/categories.php';
include_once dirname( __FILE__ ) . '/../configuration/pages.php';


function mobiloud_menu_configuration_page()
{
	?>
	
	<div></div>


	<div class="wrap">
		<div id="mobiloud_analytics_title" style="margin-top:20px;">
			<img src="<?php echo MOBILOUD_PLUGIN_URL;?>/mobiloud_36.png" style="float:left;margin-top:5px;">
			<h1 style="float:left;margin-left:20px;color:#555">Mobiloud Menu Configuration</h3>
			<div style="clear:both;">
		</div>

		<p>&nbsp;</p>
		
		<div class="narrow">

			<!-- GENERAL -->
			<div id="ml_configuration_menu_general" class="stuffbox" style="padding:20px;">
				<?php ml_configuration_menu_general_ajax_load(); ?>
			</div>
            

			<!-- CATEGORIES -->
			<div id="ml_configuration_categories" class="stuffbox" style="padding:20px;">
				<?php ml_configuration_categories_ajax_load(); ?>
			</div>

			<!-- PAGES -->
			<div id="ml_configuration_pages" class="stuffbox" style="padding:20px;">
				<?php ml_configuration_pages_ajax_load(); ?>
			</div>
            
            <!-- URLs -->
			<div id="ml_configuration_menu_urls" class="stuffbox" style="padding:20px;">
				<?php ml_configuration_menu_urls_ajax_load(); ?>
			</div>

		</div>

	</div>
	<?php
}


?>