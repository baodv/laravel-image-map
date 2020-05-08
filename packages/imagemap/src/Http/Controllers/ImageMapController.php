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


}