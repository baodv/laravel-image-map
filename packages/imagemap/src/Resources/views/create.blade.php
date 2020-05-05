@extends('imagemap::layouts.master')
@section('imagemap::content')
	<div class="image-map-main-wrapper">
		<form action="" method="POST">
			{{ csrf_field() }}
			<input type="hidden" name="url_add_point" value="{{ route('image.map.add.point') }}">
			<table class="svl-table">
				<tbody>
					<tr>
						<td class="svl-label">{{ _('Pins Image') }}</td>
						<td class="svl-input">
							<div class="svl-upload-image has-image">						
								<div class="view-has-value">
									<input type="hidden" name="pins_image" class="pins_image" value="http://demo-wordpress.local/wp-content/uploads/2020/05/vietnam.png" />	
									<img src="http://demo-wordpress.local/wp-content/uploads/2020/05/vietnam.png" class="image_view pins_img"/>									
									<a href="#" class="svl-delete-image">x</a>
								</div>
								<div class="hidden-has-value">
									<input type="button" class="button-upload button" value="{{ _( 'Select pins' ) }}" />
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td class="svl-label">{{ _('Pins Hover Image') }}</td>
						<td class="svl-input">
							<div class="svl-upload-image has-image">						
								<div class="view-has-value">
									<input type="hidden" name="pins_image_hover" class="pins_image_hover" value="" />
									<img src="" class="image_view pins_img_hover"/>									
									<a href="#" class="svl-delete-image">x</a>
								</div>
								<div class="hidden-has-value">
									<input type="button" class="button-upload button" value="Select pins hover" />
								</div>
							</div>
						</td>				
					</tr>
					<tr>
						<td class="svl-label">Pins Center Position</td>
						<td class="svl-input">
							<div class="pins-position-wrap">
								<p>
									<label>
										<input type="radio" name="choose_type" value="center_center">
										Center center
									</label>
									<label>
										<input type="radio" name="choose_type" value="top_left">
										Top Left
									</label>
									<label>
										<input type="radio" name="choose_type" value="top_center">
										Top Center
									</label>
									<label>
										<input type="radio" name="choose_type" value="top_right">
										Top Right
									</label>
									<label>
										<input type="radio" name="choose_type" value="right_center">
										Right Center
									</label>
									<label>
										<input type="radio" name="choose_type" value="bottom_right">
										Bottom Right
									</label>
									<label>
										<input type="radio" name="choose_type" value="bottom_center">
										Bottom Center
									</label>
									<label>
										<input type="radio" name="choose_type" value="bottom_left">
										Bottom Lef
									</label>
									<label><input type="radio" name="choose_type" value="left_center">
										Left Center
									</label>
									<input type="hidden" name="custom_hover_top" value="" min="0" step="any">
									<input type="hidden" name="custom_hover_left" value="" min="0" step="any">
								</p>
							</div>
						</td>				
					</tr>
					<tr>
						<td class="svl-label">Pins Animation</td>
						<td class="svl-input">
							<div class="pins-position-wrap">
								<p>
									<label>
										<input type="radio" name="pins_animation" value="none">
										None
									</label>
									<label>
										<input type="radio" name="pins_animation" value="pulse">
										Pulse
									</label>
								</p>
							</div>
						</td>				
					</tr>
				</tbody>
			</table>
			<div class="svl-image-wrap has-image">	
			<div class="svl-control">
				<input type="button" id="meta-image-button" class="button" value="Upload Image" />
				<input type="hidden" name="maps_images" class="maps_images" id="maps_images" value="" />
				<input type="button" name="add_point" class="add_point button view-has-value" value="Add Point"/>
				<span class="spinner"></span>
			</div>	
			<div class="wrap_svl view-has-value" id="body_drag">
				<div class="images_wrap">
					<img src="http://demo-wordpress.local/wp-content/uploads/2020/05/ảnh-bìa-lành.jpg">
				</div>	
				đoạn này hienr thi lại các điểm đã vẽ
			</div>	
			<div class="all_points">	
				Hiển thị modal
			</div>
		</div>
	</div>
@stop