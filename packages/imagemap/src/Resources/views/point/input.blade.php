<div class="devvn-hotspot-popup list_points" tabindex="-1" role="dialog" id="info_draggable<?php echo $countPoint?>" data-popup="info_draggable<?php echo $countPoint?>" data-points="<?php echo $countPoint?>">
 	<div class="devvn-hotspot-popup-inner">
		<div class="devvn-hotspot-popup-modal-content">
			<div class="devvn-hotspot-popup-modal-header">
				<h3 class="modal-title">Content</h3>
		  	</div>
	  		<div class="devvn-hotspot-popup-modal-body">
				<textarea name="content"></textarea>
				<div class="devvn_row">
					<div class="devvn_col_3">
						<label>Link to pins<br>
						<input type="text" name="pointdata[linkpins][]" value="<?php echo $pointLink?>" placeholder="Link to pins"/>
						</label><br>
						<label>Link target<br>
						<select name="pointdata[link_target][]">
						    <option value="_self">Open curent window</option>
						    <option value="_blank">Open new window</option>
						</select>
						</label>

					</div>	
					<div class="devvn_col_3">
						<label>Pin Image Custom</label>
						<div class="svl-upload-image <?=($pins_image_custom)?'has-image':''?>">						
							<div class="view-has-value">
								<input type="hidden" name="pointdata[pins_image_custom][]" class="pins_image" value="<?php echo $pins_image_custom; ?>" />								
								<img src="<?=$pins_image_custom?>" class="image_view pins_img"/>									
								<a href="#" class="svl-delete-image">x</a>
							</div>
							<div class="hidden-has-value">
								<input type="button" class="button-upload button" value="Select pins"/>
							</div>
						</div>
					</div>
					<div class="devvn_col_3">
						<label>Pins hover image custom</label>
						<div class="svl-upload-image <?=($pins_image_hover_custom)?'has-image':''?>">						
							<div class="view-has-value">
								<input type="hidden" name="pointdata[pins_image_hover_custom][]" class="pins_image_hover" value="<?php echo $pins_image_hover_custom; ?>" />								
								<img src="<?=$pins_image_hover_custom?>" class="image_view pins_img_hover"/>									
								<a href="#" class="svl-delete-image">x</a>
							</div>
							<div class="hidden-has-value">
								<input type="button" class="button-upload button" value="Select pins hover" />
							</div>
						</div>
					</div>					
				</div>
				<div class="devvn_row">
					<div class="devvn_col_3">
						<label>Placement<br></label>
						<select name="pointdata[placement][]">
						    <?php
						    $allPlacement = array(
                                'n' =>  'North',
                                'e' =>  'East',
                                's' =>  'South',
                                'w' =>  'West',
                                'nw' =>  'North West',
                                'ne' =>  'North East',
                                'sw' =>  'South West',
                                'se' =>  'South East'
						    );
						    foreach ($allPlacement as $k=>$v){
                            ?>
						    <option value="<?php echo $k;?>"><?php echo $v;?></option>
						    <?php }?>
                        </select>
					</div>
					<div class="devvn_col_3">
						<label>Pins ID<br>
						<input type="text" name="pointdata[pins_id][]" value="<?php echo $pins_id?>" placeholder="Type a ID"/>
						</label>
                    </div>
                    <div class="devvn_col_3">
						<label>Pins Class<br>
						<input type="text" name="pointdata[pins_class][]" value="<?php echo $pins_class?>" placeholder="Ex: class_1 class_2 class_3"/>
						</label>
                    </div>
				</div>
				<p>
					<input type="hidden" name="pointdata[top][]" min="0" max="100" step="any" value="<?php echo $pointTop?>" />
				</p>
				<p>
					<input type="hidden" name="pointdata[left][]" min="0" max="100" step="any" value="<?php echo $pointLeft?>" />
				</p>
	  		</div>
		  	<div class="devvn-hotspot-popup-modal-footer">
				<button type="button" class="button button-danger button-large button_delete">Delete</button>
				<button type="button" class="button button-primary button-large" data-popup-close="info_draggable<?php echo $countPoint?>">Done</button>
		  	</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->	