<?php
namespace BaoDo\ImageMap\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use BaoDo\ImageMap\Models\ImageMap;
use Illuminate\Support\Facades\Log;
use DB;
Class ImageMapController extends Controller
{
	const PER_PAGE = 20;
    /**
     * @var $pathView
     */
    protected $pathView = 'imagemap::';

    /**
     * Return Screen Show List Image Map.
     *
     * @return view
     */
	public function index()
	{
		$datas = ImageMap::where('delete_flag',false)->paginate(self::PER_PAGE);
		return view($this->pathView.'index',compact('datas'));
	}

    /**
     * Return Screen Show List Image Map.
     *
     * @return view
     */
	public function create()
	{
		return view($this->pathView.'create');
	}

    /**
     * Create Json Point.
     *
     * @param Request $request
     * @return Response
     */
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

    /**
     * Get Pin Default When Add Point.
     *
     * @param $datapin : []
     * @return View
     */
	public function getPinDefault($datapin = array()){
		if(!is_array($datapin)) $datapin = array();
		$countPoint = $datapin['countPoint'];
		$imgPin = $datapin['imgPoint'];
		$topPin = isset($datapin['top']) ? $datapin['top'] : '';
		$leftPin = isset($datapin['left']) ? $datapin['left'] : '';
		$pins_image_custom = isset($datapin['pins_image_custom']) ? $datapin['pins_image_custom'] : '';
		if($pins_image_custom) 
		$imgPin = $pins_image_custom;
		$view = view("imagemap::point.pin",compact(
					'countPoint',
					'imgPin',
					'topPin',
					'leftPin',
					'pins_image_custom'
				))->render();
		return $view;	
	}

    /**
     * Get Pin Input Default.
     *
     * @param $data : []
     * @return View
     */
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
		$view = view("imagemap::point.input",compact(
					'countPoint',
					'pointContent',
					'pointLeft',
					'pointTop',
					'pointLink',
					'link_target',
					'pins_image_custom',
					'pins_image_hover_custom',
					'placement',
					'pins_id',
					'pins_class'
				))->render();
		return $view;		
	}

    /**
     * Create Image Map.
     *
     * @param $data : []
     * @return View
     */
	public function store(Request $request)
	{

		$im = $request->get('im');
		$area = $request->get('area');
		$data_areas = json_encode($this->convertAreaData($area,$im));

		DB::beginTransaction();
		try {
			$imageMap = new ImageMap();
			$imageMap->name_map = $request->get('name_map');
			$imageMap->image_map = $request->get('image_map');
			$imageMap->data_areas = $data_areas;
			$imageMap->save();
			DB::commit();
		} catch (\Exception $e) {
			Log::info('Error'.$e->getMessage());
			DB::rollback();
		} finally {
			return redirect()->route('image.map.index');
		}

	}

    /**
     * Get Edit Image Map.
     *
     * @param $id : int
     * @return View
     */
	public function edit($id)
	{
		$data = ImageMap::find($id);
		if (!$data) {
			return redirect()->route('image.map.index');
		}
		return view($this->pathView.'edit',compact('data'));
	}

    /**
     * Update Image Map.
     *
     * @param $id : int
     * @return View
     */
	public function update($id)
	{
		$data = ImageMap::find($id);
		if (!$data) {
			return redirect()->route('image.map.index');
		}
		return view($this->pathView.'edit',compact('data'));
	}

    /**
     * Show Preview Image Map.
     *
     * @param $id : int
     * @return View
     */
	public function show($id)
	{
		$data = ImageMap::find($id);
		if (!$data) {
			return redirect()->route('image.map.index');
		}
		$data_areas = json_decode( $data->data_areas, $assoc_array = false );
		return view($this->pathView.'show',compact(
				'data',
				'data_areas'
			));
	}

    /**
     * Create Image Map.
     *
     * @param $data : []
     * @return View
     */    
    public function convertAreaData($area = [], $data = [] )
    {
    	$outPut = [];
    	if (is_array($area) && is_array($data)) {
    		foreach ($data as $key => $value) {
    			if (!isset($value['active'])) {
    				$value['active'] = false;
    			}
    			$value['area'] = $area[$key];
    			$outPut[] = $value;
    		} 
    	}
    	return $outPut;
    }

     /**
     * Create Image Map.
     *
     * @param $data : []
     * @return View
     */
	public function convertArrayData($inputArray = array()){
		if(is_array($inputArray)){
			$aOutput =  array();		
			$firstKey = null;
			foreach ($inputArray as $key => $value){
				$firstKey = $key;
				break;
			}
			$nCountKey = count($inputArray[$firstKey]);
			for ($i =0; $i<$nCountKey;$i++){
				$element = array();
				foreach ($inputArray as $key => $value){
					$element[$key] = $value[$i];
				}
				array_push($aOutput,$element);
			}
			return $aOutput;
		} else {
			return '';
		}
	}


}