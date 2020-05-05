<?php
namespace BaoDo\ImageMap\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use BaoDo\ImageMap\Models\ImageMap;
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
		$link_target 				= isset($data['link_target'])?$data['link_target']:'_self';
		$pins_image_custom 			= isset($data['pins_image_custom'])?$data['pins_image_custom']:'';
		$pins_image_hover_custom	= isset($data['pins_image_hover_custom'])?$data['pins_image_hover_custom']:'';
		$placement	= isset($data['placement'])?$data['placement']:'';
		$pins_id	= isset($data['pins_id'])?$data['pins_id']:'';
		$pins_class	= isset($data['pins_class'])?$data['pins_class']:'';
		$view = view("imagemap::point.input",compact('countPoint','pointContent','pointLeft','pointTop','pointLink','link_target','pins_image_custom','pins_image_hover_custom','placement','pins_id','pins_class'))->render();
		return $view;		
	}

	public function store(Request $request)
	{
		dd($request->all());
	}
}