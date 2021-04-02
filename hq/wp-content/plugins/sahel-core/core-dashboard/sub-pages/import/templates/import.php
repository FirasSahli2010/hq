<div class="wrap about-wrap eltdf-core-dashboard">
	<h1 class="eltdf-cd-title"><?php esc_html_e('Import', 'sahel-core'); ?></h1>
	<h4 class="eltdf-cd-subtitle"><?php esc_html_e('You can import the theme demo content here.', 'sahel-core'); ?></h4>
	<div class="eltdf-core-dashboard-inner">
		<div class="eltdf-core-dashboard-column">
			<div class="eltdf-core-dashboard-box eltdf-cd-import-box">
				<?php
				if(!empty(SahelCoreDashboard::get_instance()->get_purchased_code())) {?>
					<div class="eltdf-cd-box-title-holder">
						<h3><?php esc_html_e('Import demo content', 'sahel-core'); ?></h3>
						<p><?php esc_html_e('Start the demo import process by choosing which content you wish to import. ', 'sahel-core'); ?></p>
					</div>
					<div class="eltdf-cd-box-inner">
						<form method="post" class="eltdf-cd-import-form" data-confirm-message="<?php esc_attr_e('Are you sure, you want to import Demo Data now?', 'sahel-core'); ?>">
							<div class="eltdf-cd-box-form-section">
								<?php echo sahel_core_get_module_template_part('core-dashboard/sub-pages/import', 'notice', ''); ?>
								<label class="eltdf-cd-label"><?php esc_html_e('Select Demo to import', 'sahel-core'); ?></label>
								<select name="demo" class="eltdf-import-demo">
									<option value="sahel-v2" data-thumb="<?php echo SAHEL_CORE_URL_PATH . '/core-dashboard/assets/img/demo.png'; ?>"><?php esc_html_e('Sahel', 'sahel-core'); ?></option>
								</select>
							</div>
							<div class="eltdf-cd-box-form-section eltdf-cd-box-form-section-columns">
								<div class="eltdf-cd-box-form-section-column">
									<label class="eltdf-cd-label"><?php esc_html_e('Select Import Option', 'sahel-core'); ?></label>
									<select name="import_option" class="eltdf-cd-import-option" data-option-name="import_option" data-option-type="selectbox">
										<option value="none"><?php esc_html_e('Please Select', 'sahel-core'); ?></option>
										<option value="complete"><?php esc_html_e('All', 'sahel-core'); ?></option>
										<option value="content"><?php esc_html_e('Content', 'sahel-core'); ?></option>
										<option value="widgets"><?php esc_html_e('Widgets', 'sahel-core'); ?></option>
										<option value="options"><?php esc_html_e('Options', 'sahel-core'); ?></option>
<!--										<option value="single-page">--><?php //esc_html_e('Single Page', 'sahel-core'); ?><!--</option>-->
									</select>
								</div>
								<div class="eltdf-cd-box-form-section-column">
									<label class="eltdf-cd-label"><?php esc_html_e('Import Attachments', 'sahel-core'); ?></label>
									<div class="eltdf-cd-switch">
										<label class="eltdf-cd-cb-enable selected"><span><?php esc_html_e('Yes', 'sahel-core'); ?></span></label>
										<label class="eltdf-cd-cb-disable"><span><?php esc_html_e('No', 'sahel-core'); ?></span></label>
										<input type="checkbox" class="eltdf-cd-import-attachments checkbox" name="import_attachments" value="1" checked="checked">
									</div>
								</div>
							</div>
							<div class="eltdf-cd-box-form-section eltdf-cd-box-form-section-dependency"></div>
							<div class="eltdf-cd-box-form-section eltdf-cd-box-form-section-progress">
								<span><?php esc_html_e('The import process may take some time. Please be patient.', 'sahel-core') ?></span>
								<progress id="eltdf-progress-bar" value="0" max="100"></progress>
								<span class="eltdf-cd-progress-percent"><?php esc_attr_e('0%', 'sahel-core'); ?></span>
							</div>
							<div class="eltdf-cd-box-form-section eltdf-cd-box-form-last-section">
								<span class="eltdf-cd-import-is-completed"><?php esc_html_e('Import is completed', 'sahel-core') ?></span>
								<input type="submit" class="eltdf-cd-button" value="<?php esc_attr_e('Import', 'sahel-core'); ?>" name="import" id="eltdf-<?php echo esc_attr($submit); ?>" />
							</div>
							<?php wp_nonce_field("eltdf_cd_import_nonce","eltdf_cd_import_nonce") ?>
						</form>
					</div>
				<?php } else { ?>
					<div class="eltdf-cd-box-title-holder">
						<h3><?php esc_html_e('Import demo content', 'sahel-core'); ?></h3>
						<p><?php esc_html_e('Please activate your copy of the theme by registering the theme so you could proceed with the demo import process. ', 'sahel-core'); ?></p>
					</div>
					<div class="eltdf-cd-box-inner">
						<div class="eltdf-cd-box-section">
							<div class="eltdf-cd-field-holder">
								<a href="<?php echo admin_url('admin.php?page=sahel_core_dashboard'); ?>" class="eltdf-cd-button"><?php esc_attr_e('Activate your theme copy', 'sahel-core'); ?></a>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>