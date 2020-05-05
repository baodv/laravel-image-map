jQuery(document).ready(function($){

	// Add Point
	$('.add_point').click(function(){  
		var pins_image = $('input.pins_image').val();
  		if(!pins_image){
  			alert('Add pins image then add point.');
  			return false;
  		}
  		var pins_image_view = $('.pins_image').val();
  		var countPoint = parseInt($('.wrap_svl .drag_element').last().attr('data-points'));
  		if(!countPoint) countPoint = 0;
  		countPoint = countPoint + 1;
  		var fullId = 'point_content'+countPoint;
  		var url_add_point = $('input[name="url_add_point"]').val();
  		$.ajax({
            headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
  			type: "POST",
			dataType : "json",
			url : ''+url_add_point+'',
			data : {
				countpoint 	: 	countPoint, 
				img_pins	: 	pins_image_view,
			},
			context: this,
			beforeSend: function(){
				$(this).parent().addClass('adding_point');
			},
			success: function(response) {
				if(response.success === true) {
					var data = response.data;
					console.log('vao day');
					
					console.log(data);
					$('.wrap_svl').append(data.point_pins);  
			  		$('.all_points').append(data.point_data);
			  		// doDraggable();
			  		// calc_custom_position();	
			  		$(this).parent().removeClass('adding_point');
				} else {
				   alert("Try again!");
				}
			}
  		}); 
  		return false;
	}); 
});