@extends('imagemap::layouts.master')
@section('imagemap::content')
	<div class="image-map-generator clearfix">
		<form action="{{ route('image.map.store') }}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="hidden" name="url_add_point" value="{{ route('image.map.add.point') }}">
			<input type="hidden" id="image_map" name="image_map" value="https://www.jqueryscript.net/demo/Highlight-Image-Areas-Hover-Mapoid/map.jpg">
			<div class="container">
			    <div class="row">
			        <div class="col-md-12">
			            <h2>Image SVG Map Builder</h2>
			            <p itemprop="description">Image SVG Map Builder™ comes with its own feature rich web app, so you can quickly and easily create the most comprehensive selection of interactive SVG image maps, pins and custom vector shapes, and immediately export them to your website.</p>
		                <div class="name-map">
		                	<label>Name Map</label>
		                	<input name="name_map" value="{{ old('name_map') }}" type="text" class="form-control" placeholder="Nhập tên tạo">
		                </div>
			            <div class="step">
			            	<button type="button" class="btn btn-success btn-lg display-none" id="image-mapper-upload">Select Image from My PC</button>
			            	<input type="file" name="" id="image-mapper-file">
			            	<span class="divider display-none">&nbsp; &nbsp; &nbsp; -- OR -- &nbsp; &nbsp; &nbsp;</span> 
			            	<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#image-mapper-load">Load Image from Website</button>
			            </div>
			        </div>
			    </div>
			</div>
		    <div class="container toggle-content">
		        <div class="row">
		            <div class="col-md-12">
		                <div class="container">
		                    <div class="row">
		                        <div class="col-md-12" id="image-map-wrapper">
		                            <div id="image-map-container">
		                                <div id="image-map" style="max-width: 100%"><span class="glyphicon glyphicon-picture"></span></div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <table class="table" id="image-mapper-table">
		                    <thead>
		                        <tr>
		                            <th>Active</th>
		                            <th>Shape</th>
		                            <th>Link</th>
		                            <th>Title</th>
		                            <th>Target</th>
		                            <th style="width: 25px"></th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                        <tr>
		                            <td style="width: 65px">
		                                <div class="control-label input-sm">
		                                	<input type="radio" name="im[0][active]" value="1">
		                                </div>
		                            </td>
		                            <td>
		                            	<select name="im[0][shape]" class="form-control input-sm">
		                                    <option value="rect">Rect</option>
		                                    <option value="poly">Poly</option>
		                                    <option value="circle">Circle</option>
		                                </select>
		                            </td>
		                            <td>
		                            	<input type="text" name="im[0][href]" value="" placeholder="Link" class="form-control input-sm">
		                            </td>
		                            <td>
		                            	<input type="text" name="im[0][title]" value="" placeholder="Title" class="form-control input-sm">
		                            </td>
		                            <td>
		                            	<select name="im[0][target]" class="form-control input-sm">
		                                    <option value="">---</option>
		                                    <option value="_blank">_blank</option>
		                                    <option value="_parent">_parent</option>
		                                    <option value="_self">_self</option>
		                                    <option value="_top">_top</option>
		                                </select>
		                            </td>
		                            <td>
		                            	<button class="btn btn-default btn-sm remove-row" name="im[0][remove]">
		                            		<span class="glyphicon glyphicon-remove"></span>
		                            	</button>
		                            </td>
		                        </tr>
		                    </tbody>
		                    <tfoot>
		                        <tr>
		                            <th colspan="6" style="text-align: right">
		                            	<button type="button" class="btn btn-danger btn-sm add-row">
		                            		<span class="glyphicon glyphicon-plus"></span> Add New Area
		                            	</button>
		                            </th>
		                        </tr>
		                    </tfoot>
		                </table>
		            </div>
		        </div>
		    </div>
		    <div class="col-md-12 text-center">
		    	<button id="image-mapper-button" type="submit" class="btn btn-info">
		    		<span class="glyphicon glyphicon-floppy-saved"></span> Submit Button
	    		</button>
		    </div>
		</form>
	</div>
    <div class="modal fade" id="image-mapper-load" tabindex="-1" role="dialog" aria-labelledby="image-mapper-load-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="image-mapper-dialog">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="image-mapper-load-label">Load Image from Website</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-sm has-error">
                    	<input type="text" value="" placeholder="http://..." id="image-mapper-url" class="form-control input-sm">
                    	<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    </div>
                </div>
                <div class="modal-footer">
                	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                	<button type="button" class="btn btn-primary" id="image-mapper-continue">Continue</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('addJs')
	<script src="{{ asset('packages/imagemap/js/main.js ')}}"></script>
	<script type="text/javascript">
		$(document).trigger('init');
	</script>
@stop