<div class="eltdf-tabs-content">
	<div class="tab-content">
		<div class="tab-pane fade in active" id="import">
			<div class="eltdf-tab-content">
				<h2 class="eltdf-page-title"><?php esc_html_e('Import', 'sahel'); ?></h2>
				<form method="post" class="eltdf_ajax_form eltdf-import-page-holder" data-confirm-message="<?php esc_attr_e('Are you sure, you want to import Demo Data now?', 'sahel'); ?>">
					<div class="eltdf-page-form">
						<div class="eltdf-page-form-section-holder">
							<h3 class="eltdf-page-section-title"><?php esc_html_e('Import Demo Content', 'sahel'); ?></h3>
							<div class="eltdf-page-form-section">
								<div class="eltdf-field-desc">
									<h4><?php esc_html_e('Import', 'sahel'); ?></h4>
									<p><?php esc_html_e('Choose demo content you want to import', 'sahel'); ?></p>
								</div>
								<div class="eltdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-3">
												<select name="import_example" id="import_example" class="form-control eltdf-form-element dependence">
													<option value="sahel"><?php esc_html_e('Sahel Demo', 'sahel'); ?></option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltdf-page-form-section">
								<div class="eltdf-field-desc">
									<h4><?php esc_html_e('Import Type', 'sahel'); ?></h4>
									<p><?php esc_html_e('Import Type', 'sahel'); ?></p>
								</div>
								<div class="eltdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-3">
												<select name="import_option" id="import_option" class="form-control eltdf-form-element">
													<option value=""><?php esc_html_e('Please Select', 'sahel'); ?></option>
													<option value="complete_content"><?php esc_html_e('All', 'sahel'); ?></option>
													<option value="content"><?php esc_html_e('Content', 'sahel'); ?></option>
													<option value="widgets"><?php esc_html_e('Widgets', 'sahel'); ?></option>
													<option value="options"><?php esc_html_e('Options', 'sahel'); ?></option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltdf-page-form-section">
								<div class="eltdf-field-desc">
									<h4><?php esc_html_e('Import attachments', 'sahel'); ?></h4>
									<p><?php esc_html_e('Do you want to import media files?', 'sahel'); ?></p>
								</div>
								<div class="eltdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<p class="field switch">
													<label class="cb-enable dependence"><span><?php esc_html_e('Yes', 'sahel'); ?></span></label>
													<label class="cb-disable selected dependence"><span><?php esc_html_e('No', 'sahel'); ?></span></label>
													<input type="checkbox" id="import_attachments" class="checkbox" name="import_attachments" value="1">
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltdf-page-form-section">
								<div class="eltdf-field-desc">
									<input type="submit" class="btn btn-primary btn-sm " value="<?php esc_attr_e('Import', 'sahel'); ?>" name="import" id="eltdf-import-demo-data" />
								</div>
								<div class="eltdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<div class="eltdf-import-load"><span><?php esc_html_e('The import process may take some time. Please be patient.', 'sahel') ?> </span><br />
													<div class="eltdf-progress-bar-wrapper html5-progress-bar">
														<div class="progress-bar-wrapper">
															<progress id="progressbar" value="0" max="100"></progress>
														</div>
														<div class="progress-value">0%</div>
														<div class="progress-bar-message">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltdf-page-form-section eltdf-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'sahel') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will take time needed to download all attachments from demo web site.', 'sahel'); ?></li>
										<li> <?php esc_html_e('If you plan to use shop, please install WooCommerce before you run import.', 'sahel')?></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>