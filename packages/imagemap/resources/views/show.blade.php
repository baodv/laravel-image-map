@extends('imagemap::layouts.master')
@section('addCss')
	<link rel="stylesheet" href="{{ asset('packages/imagemap/css/jquery.mapify.css') }}">
	<link rel="stylesheet" href="{{ asset('packages/imagemap/css/jquery.powertip.min.css') }}">
	<style type="text/css">
		.custom-popover{
		    background: #09f;
		}
		 
		.mapify-hover{
		    fill:rgba(0,0,0,0.15);
		    stroke: #fff;
		    stroke-width: 2;
		}
		     
		.custom-hover{
		    fill:rgba(0,0,0,0.15);
		    stroke: #fff;
		    stroke-width: 2;
		}
		 
		.custom-hover-2{
		    fill: #09f;
		    stroke: #fff;
		    stroke-width: 2;
		}
		Sample m
	</style>
@stop
@section('imagemap::content')
	@php
		$request = request()
	@endphp
	<div class="image-map-main-wrapper">
		<div class="wrap_svl_center">
			<div class="wrap_svl_center_box container">
				<div class="wrap_svl col-md-4" id="body_drag_{{ $data->id }}">
					<div id="test"></div>
					<div class="images_wrap">
						<img class="image-map" src="{{ $data->image_map }}" usemap="#Map">
						<map name="Map" id="Map">
							@foreach($data_areas as $key=>$area)
								<area id="{{ $key }}" href="{{ $area->href }}" shape="{{ $area->shape }}" coords="{{ $area->area }}" data-coords-default="{{ $area->area }}" data-title="{{ $area->title }}" data-coords="{{ $area->area }}" title="{{ $area->title }}" style="outline: none;">
							@endforeach
						</map>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('addJs')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://rawgit.com/miso25/mapoid/master/mapoid.min.js?1"></script>
	<script src="{{ asset('packages/imagemap/js/jquery.mapify.js')}}"></script>
	<script src="{{ asset('packages/imagemap/js/jquery.powertip.min.js')}}"></script>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				var obj = {
				    "strokeColor": "red",
				    "strokeWidth": 10,
				    "fillColor": "black",
				    "fillOpacity": .4,
				    "fadeTime": 700,
				    "selectOnClick": true,
				   	mousedown: function(j,e){
				    },
				   	mouseover: function(j,e){
						e.data('powertip', function() {
							var htmlThis = e.attr('data-title');
							return htmlThis;
						});
						e.powerTip({
							placement: 'n',
							smartPlacement: true,
							mouseOnToPopup: true,
						}).on({
							powerTipClose: function() {
								$('#powerTip').html('xin chào');
							}
						});;
				    },
				}
				$("map[name=Map]").mapoid(obj);
				// $("img[usemap]").mapify({
				// 	popOver: {
				// 		content: function(zone){
				// 			return "<strong>"+zone.attr("data-title")+"</strong>";
				// 		},
				// 		delay: 0.7
				// 	},
				// 	onAreaHighlight: function(){
				// 		console.log("onAreaHighlight callback");
				// 	},
				// 	onMapClear: function(){
				// 		console.log("onMapClear callback");
				// 	}
				// });
		    })
		})(jQuery)
	</script>
@stop