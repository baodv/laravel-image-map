@extends('imagemap::layouts.master')
@section('imagemap::content')
	@php
		$request = request()
	@endphp
	<div class="image-map-generator clearfix">
		<div class="container">
			<div class="form-group">
				<a class="btn btn-info" href="{{ route('image.map.create') }}">
					<span class="glyphicon glyphicon-plus"></span> Add New
				</a>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name Image Map</th>
						<th>Image Map</th>
						<th>ShortCode</th>
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
								{{ $data->name_map }}
							</td>
							<td>
								<img style="max-width: 60px" src="{{ $data->image_map }}">
							</td>
							<td>
								[ImageMap id="{{ $data->id }}"]
							</td>
							<td>
								{{ $data->created_at }}
							</td>
							<td style="width: 150px;">
								<a href="{{ route('image.map.show',['id'=>$data->id]) }}" class="btn btn-icon btn-sm btn-primary tip">
	                            	<span class="glyphicon glyphicon-eye-open"></span>
		                        </a>
								<a href="{{ route('image.map.edit',['id'=>$data->id]) }}" class="btn btn-icon btn-sm btn-primary tip">
	                            	<span class="glyphicon glyphicon-edit"></span>
		                        </a>
		                        <a href="javascript:void(0);" data-id="{{ $data->id }}" class="btn btn-icon btn-sm btn-danger deleteDialog tip">
	                            	<span class="glyphicon glyphicon-trash"></span>
		                        </a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="box-footer text-right clearfix">
			    {{
				    $datas->appends([
				      'keyword' => $request->query('keyword'),
				    ])->links()
			    }}
			</div>
		</div>
	</div>
@stop