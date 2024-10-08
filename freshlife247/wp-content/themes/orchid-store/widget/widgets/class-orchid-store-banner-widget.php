<?php
/**
 * Product Categories and Slider Widget Class
 *
 * @package Orchid_Store
 */

if ( ! class_exists( 'Orchid_Store_Banner_Widget' ) ) {
	/**
	 * Widget class - Orchid_Store_Banner_Widget.
	 *
	 * @since 1.0.0
	 *
	 * @package orchit_store
	 */
	class Orchid_Store_Banner_Widget extends WP_Widget {

		/**
		 * Slug or id.
		 *
		 * @var string
		 */
		public $value_as;


		/**
		 * Define id, name and description of the widget.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			parent::__construct(
				'orchid-store-banner-widget',
				esc_html__( 'OS: Banner', 'orchid-store' ),
				array(
					'classname'   => '',
					'description' => esc_html__( 'Displays main slider', 'orchid-store' ),
				)
			);

			$this->value_as = orchid_store_get_option( 'value_as' );
		}


		/**
		 * Renders widget at the frontend.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args Provides the HTML you can use to display the widget title class and widget content class.
		 * @param array $instance The settings for the instance of the widget..
		 */
		public function widget( $args, $instance ) {

			$title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$slider_pages   = isset( $instance['slider_pages'] ) ? $instance['slider_pages'] : array();
			$button_titles  = isset( $instance['button_titles'] ) ? $instance['button_titles'] : array();
			$button_links   = isset( $instance['button_links'] ) ? $instance['button_links'] : array();
			$show_contents  = isset( $instance['show_contents'] ) ? $instance['show_contents'] : true;
			$enable_mask    = isset( $instance['enable_mask'] ) ? $instance['enable_mask'] : false;
			$banner_image_1 = isset( $instance['banner_img_1'] ) ? $instance['banner_img_1'] : '';
			$banner_image_2 = isset( $instance['banner_img_2'] ) ? $instance['banner_img_2'] : '';
			$banner_link_1  = isset( $instance['banner_link_1'] ) ? $instance['banner_link_1'] : '';
			$banner_link_2  = isset( $instance['banner_link_2'] ) ? $instance['banner_link_2'] : '';

			$banner_class = '';

			if ( $enable_mask ) {

				$banner_class = 'show-mask';
			}
			?>
			<section class="general-banner banner-style-1 section-spacing <?php echo esc_attr( $banner_class ); ?>">
				<div class="section-inner">
					<div class="__os-container__">
						<div class="os-row">
							<?php
							if ( ! empty( $slider_pages ) ) {
								?>
								<div class="os-col slider-col left-col">
									<div class="carousel-preloader">
										<div class="init-preloader"></div>
									</div>
									<div class="owl-carousel owl-carousel-1">
										<?php
										foreach ( $slider_pages as $slider_index => $slider_page ) {

											$slider_item_query_args = array(
												'post_type' => 'page',
											);

											if ( 'slug' === $this->value_as ) {
												$slider_item_query_args['pagename'] = $slider_page;
											} else {
												$slider_item_query_args['page_id'] = $slider_page;
											}

											$slider_item = new WP_Query( $slider_item_query_args );

											if ( $slider_item->have_posts() ) {

												while ( $slider_item->have_posts() ) {

													$slider_item->the_post();
													?>
													<div class="item">
														<figure
															class="thumb" 
															<?php
															if ( has_post_thumbnail() ) {
																?>
																style="background-image:url( <?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?> );"
																<?php
															}
															?>
														>
															<?php
															if ( $enable_mask ) {
																?>
																<div class="mask"></div>
																<?php
															}
															if ( $show_contents ) {
																?>
																<div class="item-entry">
																	<div class="content-holder">
																		<div class="entry-contents">
																			<div class="title">
																				<h2><?php the_title(); ?></h2>
																			</div>
																			<div class="excerpt">
																				<?php the_content(); ?>
																			</div><!-- .excerpt -->
																			<?php
																			if ( ! empty( $button_titles[ $slider_index ] ) && ! empty( $button_links[ $slider_index ] ) ) {
																				?>
																				<div class="permalink">
																					<a lass="button-general" href="/?post_type=product">
																						<?php echo esc_html( $button_titles[ $slider_index ] ); ?>
																					</a>
																				</div><!-- .permalink -->
																				<?php
																			}
																			?>
																		</div><!-- .entry-contents -->
																	</div><!-- .content-holder -->
																</div><!-- .item-entry -->
																<?php
															}
															?>
														</figure><!-- .thumb -->
													</div>
													<?php
												}
												wp_reset_postdata();
											}
										}
										?>
									</div><!-- .owl-carousel -->
								</div><!-- .os-col -->
								<?php
							}

							if ( ! empty( $banner_image_1 ) || ! empty( $banner_image_2 ) ) {
								?>
								<div class="os-col right-col">
									<div class="banner-item-holder">
									<?php
									if ( ! empty( $banner_image_1 ) ) {
										?>
										<div class="banner-image-wrapper banner-image-one-wrapper">
											<?php
											if ( ! empty( $banner_link_1 ) ) {
												?>
												<a href="/?post_type=product">
												<?php
											}
											$banner_image_1_alt_text = orchid_store_get_alt_text_of_image( $banner_image_1 );
											?>
											<img src="<?php echo esc_url( $banner_image_1 ); ?>" alt="<?php echo esc_attr( $banner_image_1_alt_text ); ?>">
											<?php
											if ( ! empty( $banner_link_1 ) ) {
												?>
												</a>
												<?php
											}
											?>
										</div>
										<?php
									}

									if ( ! empty( $banner_image_2 ) ) {
										?>
										<div class="banner-image-wrapper banner-image-two-wrapper">
											<?php
											if ( ! empty( $banner_link_2 ) ) {
												?>
												<a href="/?post_type=product">
												<?php
											}
											$banner_image_2_alt_text = orchid_store_get_alt_text_of_image( $banner_image_2 );
											?>
											<img src="<?php echo esc_url( $banner_image_2 ); ?>" alt="<?php echo esc_attr( $banner_image_2_alt_text ); ?>">
											<?php
											if ( ! empty( $banner_link_2 ) ) {
												?>
												</a>
												<?php
											}
											?>
										</div>
										<?php
									}
									?>
									</div><!-- . banner-item-holder -->
								</div><!-- .os-col -->
								<?php
							}
							?>
						</div><!-- .os-row -->
					</div><!-- .__os-container__ -->
				</div><!-- .section-inner -->
			</section><!-- .general-banner -->
			<?php
		}


		/**
		 * Adds setting fields to the widget and renders them in the form.
		 *
		 * @since 1.0.0
		 *
		 * @param array $instance The settings for the instance of the widget..
		 */
		public function form( $instance ) {

			$defaults = array(
				'title'         => '',
				'slider_pages'  => array(),
				'button_titles' => array(),
				'button_links'  => array(),
				'show_contents' => true,
				'enable_mask'   => false,
				'banner_img_1'  => '',
				'banner_img_2'  => '',
				'banner_link_1' => '',
				'banner_link_2' => '',
			);

			$instance     = wp_parse_args( (array) $instance, $defaults );
			$banner_img_1 = $instance['banner_img_1'];
			$banner_img_2 = $instance['banner_img_2'];
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
					<strong><?php esc_html_e( 'Title', 'orchid-store' ); ?></strong>
				</label>
				<input
					class="widefat"
					id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
					type="text"
					value="<?php echo esc_attr( $instance['title'] ); ?>"
				/>   
			</p>

			<p>
				<span class="sldr-elmnt-title">
					<strong>
						<?php esc_html_e( 'Slider Elements', 'orchid-store' ); ?>
					</strong>
				</span>

				<?php
				$page_choices = orchid_store_all_pages();

				for ( $i = 0; $i <= 2; $i++ ) {
					?>
					<span class="os-fields-wrapper">
						<span class="os-fields-wrapper-title">
							<strong>
								<?php
								/* translators: %s: slider item number */
								printf( esc_html__( 'Slider Item %s', 'orchid-store' ), $i + 1 ); // phpcs:ignore
								?>
							</strong>
							<span class="os-collapse-icon">
								<span class="dashicons dashicons-arrow-down"></span>
							</span>
						</span>
						<span class="os-fields">
							<label for="<?php echo esc_attr( $this->get_field_id( 'slider_pages' ) . $i ); ?>">
								<strong>
									<?php esc_html_e( 'Select Page', 'orchid-store' ); ?>
								</strong>
							</label>
							<select
								class="widefat"
								name="<?php echo esc_attr( $this->get_field_name( 'slider_pages' ) ); ?>[]"
								id="<?php echo esc_attr( $this->get_field_id( 'slider_pages' ) . $i ); ?>">
								<?php
								if ( 'slug' === $this->value_as ) {
									foreach ( $page_choices as $page_slug => $page_title ) {
										?>
										<option
											value="<?php echo esc_attr( $page_slug ); ?>"
											<?php selected( $page_slug, ( ! empty( $instance['slider_pages'][ $i ] ) ? $instance['slider_pages'][ $i ] : '' ) ); ?>>
											<?php echo esc_html( $page_title ); ?>
										</option>
										<?php
									}
								} else {
									foreach ( $page_choices as $page_id => $page_title ) {
										?>
										<option
										value="<?php echo esc_attr( $page_id ); ?>"
										<?php selected( $page_id, ( ! empty( $instance['slider_pages'][ $i ] ) ? $instance['slider_pages'][ $i ] : '' ) ); ?>>
										<?php echo esc_html( $page_title ); ?>
									</option>
										<?php
									}
								}
								?>
							</select>

							<label for="<?php echo esc_attr( $this->get_field_id( 'button_titles' ) . $i ); ?>">
								<strong><?php esc_html_e( 'Button Title', 'orchid-store' ); ?></strong>
							</label>
							<input
								class="widefat"
								type="text"
								id="<?php echo esc_attr( $this->get_field_id( 'button_titles' ) . $i ); ?>"
								name="<?php echo esc_attr( $this->get_field_name( 'button_titles' ) ); ?>[]"
								value="<?php echo isset( $instance['button_titles'][ $i ] ) ? esc_attr( $instance['button_titles'][ $i ] ) : ''; ?>"
							>

							<label for="<?php echo esc_attr( $this->get_field_id( 'button_links' ) . $i ); ?>">
								<strong><?php esc_html_e( 'Button Link', 'orchid-store' ); ?></strong>
							</label>
							<input
								class="widefat"
								type="text"
								id="<?php echo esc_attr( $this->get_field_id( 'button_links' ) . $i ); ?>"
								name="<?php echo esc_attr( $this->get_field_name( 'button_links' ) ); ?>[]"
								value="<?php echo isset( $instance['button_links'][ $i ] ) ? esc_attr( $instance['button_links'][ $i ] ) : ''; ?>"
							>
						</span>
					</span>
					<?php
				}
				?>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'show_contents' ) ); ?>">
					<input
						id="<?php echo esc_attr( $this->get_field_id( 'show_contents' ) ); ?>"
						name="<?php echo esc_attr( $this->get_field_name( 'show_contents' ) ); ?>"
						type="checkbox" <?php checked( true, $instance['show_contents'] ); ?>
					>  
					<strong><?php esc_html_e( 'Show Slider Contents', 'orchid-store' ); ?></strong>
				</label>                 
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'enable_mask' ) ); ?>">
					<input
						id="<?php echo esc_attr( $this->get_field_id( 'enable_mask' ) ); ?>"
						name="<?php echo esc_attr( $this->get_field_name( 'enable_mask' ) ); ?>"
						type="checkbox" <?php checked( true, $instance['enable_mask'] ); ?>
					>
					<strong><?php esc_html_e( 'Enable Mask Layer', 'orchid-store' ); ?></strong>
				</label>                 
			</p>

			<p>
				<span><strong><?php esc_html_e( 'Banner Image One', 'orchid-store' ); ?></strong></span>

				<span class="os-image-uploader-container">

					<?php
					$upload_btn_class = 'button os-upload-btn';
					$remove_btn_class = 'button os-remove-btn';

					if ( empty( $banner_img_1 ) ) {

						$remove_btn_class .= ' os-btn-hide';
						$upload_btn_class .= ' os-btn-show';
					} else {

						$remove_btn_class .= ' os-btn-show';
						$upload_btn_class .= ' os-btn-hide';
					}
					?>
					<span
						class="os-upload-image-holder"
						style="background-image: url( <?php echo esc_url( $banner_img_1 ); ?> );">
					</span>
					<input
						type="hidden"
						class="widefat os-upload-image-url-holder"
						name="<?php echo esc_attr( $this->get_field_name( 'banner_img_1' ) ); ?>"
						id="<?php echo esc_attr( $this->get_field_id( 'banner_img_1' ) ); ?>"
						value="<?php echo esc_attr( $banner_img_1 ); ?>"
					>
					<button
						class="<?php echo esc_attr( $upload_btn_class ); ?>"
						id="os-upload-btn"><?php esc_html_e( 'Upload', 'orchid-store' ); ?>
					</button>
					<button
						class="<?php echo esc_attr( $remove_btn_class ); ?>"
						id="os-remove-btn"><?php esc_html_e( 'Remove', 'orchid-store' ); ?>
					</button>
				</span>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'banner_link_1' ) ); ?>">
					<strong><?php esc_html_e( 'Banner Link One', 'orchid-store' ); ?></strong>
				</label>
				<input
					class="widefat"
					id="<?php echo esc_attr( $this->get_field_id( 'banner_link_1' ) ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'banner_link_1' ) ); ?>"
					type="text"
					value="<?php echo esc_attr( $instance['banner_link_1'] ); ?>"
				>   
			</p>

			<p>
				<span><strong><?php esc_html_e( 'Banner Image Two', 'orchid-store' ); ?></strong></span>

				<span class="os-image-uploader-container">

					<?php
					$upload_btn_class = 'button os-upload-btn';
					$remove_btn_class = 'button os-remove-btn';

					if ( empty( $banner_img_2 ) ) {

						$remove_btn_class .= ' os-btn-hide';
						$upload_btn_class .= ' os-btn-show';
					} else {

						$remove_btn_class .= ' os-btn-show';
						$upload_btn_class .= ' os-btn-hide';
					}
					?>
					<span class="os-upload-image-holder" style="background-image: url( <?php echo esc_url( $banner_img_2 ); ?> );"></span>
					<input
						type="hidden"
						class="widefat os-upload-image-url-holder"
						name="<?php echo esc_attr( $this->get_field_name( 'banner_img_2' ) ); ?>"
						id="<?php echo esc_attr( $this->get_field_id( 'banner_img_2' ) ); ?>"
						value="<?php echo esc_attr( $banner_img_2 ); ?>"
					>
					<button
						class="<?php echo esc_attr( $upload_btn_class ); ?>"
						id="os-upload-btn"><?php esc_html_e( 'Upload', 'orchid-store' ); ?>
					</button>
					<button
						class="<?php echo esc_attr( $remove_btn_class ); ?>"
						id="os-remove-btn"><?php esc_html_e( 'Remove', 'orchid-store' ); ?>
					</button>
				</span>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'banner_link_2' ) ); ?>">
					<strong><?php esc_html_e( 'Banner Link Two', 'orchid-store' ); ?></strong>
				</label>
				<input
					class="widefat"
					id="<?php echo esc_attr( $this->get_field_id( 'banner_link_2' ) ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'banner_link_2' ) ); ?>"
					type="text"
					value="<?php echo esc_attr( $instance['banner_link_2'] ); ?>"
				>   
			</p>
			<?php
		}


		/**
		 * Sanitizes and saves the instance of the widget.
		 *
		 * @since 1.0.0
		 *
		 * @param array $new_instance The settings for the new instance of the widget.
		 * @param array $old_instance The settings for the old instance of the widget.
		 * @return array Sanitized instance of the widget.
		 */
		public function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['title'] = isset( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';

			if ( 'slug' === $this->value_as ) {

				$instance['slider_pages'] = isset( $new_instance['slider_pages'] ) ? array_map( 'sanitize_text_field', $new_instance['slider_pages'] ) : array();
			} else {

				$instance['slider_pages'] = isset( $new_instance['slider_pages'] ) ? array_map( 'absint', $new_instance['slider_pages'] ) : array();
			}

			$instance['button_titles'] = isset( $new_instance['button_titles'] ) ? array_map( 'sanitize_text_field', $new_instance['button_titles'] ) : array();

			$instance['button_links'] = isset( $new_instance['button_links'] ) ? array_map( 'esc_url_raw', $new_instance['button_links'] ) : array();

			$instance['show_contents'] = isset( $new_instance['show_contents'] ) ? true : false;

			$instance['enable_mask'] = isset( $new_instance['enable_mask'] ) ? true : false;

			$instance['banner_img_1'] = isset( $new_instance['banner_img_1'] ) ? esc_url_raw( $new_instance['banner_img_1'] ) : '';

			$instance['banner_img_2'] = isset( $new_instance['banner_img_2'] ) ? esc_url_raw( $new_instance['banner_img_2'] ) : '';

			$instance['banner_link_1'] = isset( $new_instance['banner_link_1'] ) ? esc_url_raw( $new_instance['banner_link_1'] ) : '';

			$instance['banner_link_2'] = isset( $new_instance['banner_link_2'] ) ? esc_url_raw( $new_instance['banner_link_2'] ) : '';

			return $instance;
		}
	}
}
