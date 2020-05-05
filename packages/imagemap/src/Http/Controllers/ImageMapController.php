<?php
namespace BaoDo\ImageMap\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Class ImageMapController extends Controller
{
	public function index()
	{
		return view('imagemap::create');
	}

	public function addPoint(Request $request)
	{
		$countPoint = $request->get('countpoint');

		$imgPin = $request->get('img_pins');
		$datapin = array(
			'countPoint'	=>	$countPoint,
			'imgPoint'		=>	$imgPin
		);
		$data_input = array(
			'countPoint'	=>	$countPoint,
		);
		return response()->json([
			'success' => true,
			'data'	 => array(
				'point_pins' => $this->getPinDefault($datapin),
				'point_data' => $this->getPinInputDefault($data_input)
			)
		]);
	}


	public function getPinDefault($datapin = array()){
		if(!is_array($datapin)) $datapin = array();
		$countPoint = $datapin['countPoint'];
		$imgPin = $datapin['imgPoint'];
		$topPin = isset($datapin['top']) ? $datapin['top'] : '';
		$leftPin = isset($datapin['left']) ? $datapin['left'] : '';
		$pins_image_custom = isset($datapin['pins_image_custom']) ? $datapin['pins_image_custom'] : '';
		if($pins_image_custom) 
		$imgPin = $pins_image_custom;
		$view = view("imagemap::point.pin",compact('countPoint','imgPin','topPin','leftPin','pins_image_custom'))->render();
		return $view;	
	}


	public function getPinInputDefault($data = array()){
		if(!is_array($data)) $data = array();
			
		$countPoint 				= isset($data['countPoint'])?$data['countPoint']:'';
		$pointContent 				= isset($data['content'])?$data['content']:'';
		$pointLeft 					= isset($data['left'])?$data['left']:'';
		$pointTop 					= isset($data['top'])?$data['top']:'';
		$pointLink 					= isset($data['linkpins'])?$data['linkpins']:'';
		$link_target 					= isset($data['link_target'])?$data['link_target']:'_self';
		$pins_image_custom 			= isset($data['pins_image_custom'])?$data['pins_image_custom']:'';
		$pins_image_hover_custom	= isset($data['pins_image_hover_custom'])?$data['pins_image_hover_custom']:'';
		$placement	= isset($data['placement'])?$data['placement']:'';
		$pins_id	= isset($data['pins_id'])?$data['pins_id']:'';
		$pins_class	= isset($data['pins_class'])?$data['pins_class']:'';
		?>	
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
								    <option value="_self" <?php $this->selected('_self',$link_target);?>>Open curent window</option>
								    <option value="_blank" <?php $this->selected('_blank',$link_target);?>>Open new window</option>
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
								    <option value="<?php echo $k;?>" <?php $this->selected($k,$placement)?>><?php echo $v;?></option>
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
		<?php		
	}


	public function selected( $target, $current )
	{
		if ($target == $current) {
			return 'selected';
		}
		return false;
	}
}