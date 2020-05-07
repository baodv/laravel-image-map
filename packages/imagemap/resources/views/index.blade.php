@extends('imagemap::layouts.master')
@section('imagemap::content')
	@php
		$request = request()
	@endphp
	<div class="image-map-main-wrapper">
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Name Image Map</th>
					<th>Image Map</th>
					<th>Created At</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($datas as $data)
					<tr>
						<td>
							{{ $data->id }}
						</td>
						<td>
							{{ $data->image_map_name }}
						</td>
						<td>
							<img style="max-width: 60px" src="{{ $data->maps_images }}">
						</td>
						<td>
							{{ $data->created_at }}
						</td>
						<td>
							<a href="{{ route('image.map.show',['id'=>$data->id]) }}" class="btn btn-icon btn-sm btn-primary tip">
                            	Hiển thị
	                        </a>
							<a href="{{ route('image.map.edit',['id'=>$data->id]) }}" class="btn btn-icon btn-sm btn-primary tip">
                            	Sửa
	                        </a>
	                        <a href="javascript:void(0);" data-id="{{ $data->id }}" class="btn btn-icon btn-sm btn-danger deleteDialog tip">
	                            Xóa
	                        </a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="box-footer clearfix">
			<div class="col-md-5">
			    <b>{{ $datas->total() }}</b>の{{ $datas->currentPage() }}/{{ $datas->count() }}ページ目
			</div>
			<div class="col-md-7">
			    {{
				    $datas->appends([
				      'keyword' => $request->query('keyword'),
				    ])->links()
			    }}
			</div>
		</div>
	</div>
@stop