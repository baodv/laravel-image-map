jQuery(document).ready(function($) {
    // Instantiates the variable that holds the media library frame.
	function filePreview(input) {
		console.log(input.files);
		console.log(input.files[0]);
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
		console.log(e.target.result);
		console.log('vao day');
	            $('#body_drag .images_wrap img').attr('src', e.target.result);
	            $('#body_drag .images_wrap').html('<img src="' + e.target.result + '">');
	        };
	        reader.readAsDataURL(input.files[0]);
	    }
	} 
    var meta_image_frame;
    // Runs when the image button is clicked.
    $('body').on('click', '[id*=meta-image-button]', function(e) {
        // e.preventDefault();
        filePreview(this);
    });
    $('body').on('click', '.button-upload', function(e) {
        // Prevents the default action from occuring.
    });

    function doDraggable() {
        $('.drag_element').draggable({
            containment: '#body_drag',
            drag: function(event, ui) {
                /*coordinates(event, ui, '#body_drag');*/
            },
            stop: function(event, ui) {
                var thisPoint = ui.helper.context.id;
                var dataPoint = $('#' + thisPoint).attr('data-points');
                var element = $('#body_drag');
                var left = ui.position.left,
                    top = ui.position.top;
                var wWrap = element.width(),
                    hWrap = element.height();
                var topPosition = ((top / hWrap) * 100).toFixed(2),
                    leftPosition = ((left / wWrap) * 100).toFixed(2);

                $('.all_points #info_draggable' + dataPoint + ' input[name="pointdata[top][]"]').val(topPosition);
                $('.all_points #info_draggable' + dataPoint + ' input[name="pointdata[left][]"]').val(leftPosition);

            }
        });
    }
    doDraggable();
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
					$('.wrap_svl').append(data.point_pins);  
			  		$('.all_points').append(data.point_data);
			  		doDraggable();
			  		calc_custom_position();	
			  		$(this).parent().removeClass('adding_point');
				} else {
				   alert("Try again!");
				}
			}
  		}); 
  		return false;
	}); 
    $('body').on('click', '.button_delete', function() {
        var idDiv = $(this).parents('.list_points').attr('data-points');
        $('[data-popup="info_draggable' + idDiv + '"]').fadeOut(350, function() {
            $('#info_draggable' + idDiv).remove();
            $('#draggable' + idDiv).remove();
        });
        return false;
    });
    $('body').on('click', '.svl-delete-image', function() {
        var parentDiv = $(this).parents('.svl-upload-image');
        parentDiv.removeClass('has-image');
        parentDiv.find('input[type="hidden"]').val('');
        return false;
    });

    function cacl_position($position = 'center_center', $is_hover = false, $return = 'top') {
        var $r_top = 0;
        var $r_left = 0;
        if ($is_hover) {
            var $width = $('.pins_img_hover').width(),
                $height = $('.pins_img_hover').height(),
                $custom_top = $('input[name="custom_hover_top"]').val(),
                $custom_left = $('input[name="custom_hover_left"]').val();
        } else {
            var $width = $('.pins_img').width(),
                $height = $('.pins_img').height(),
                $custom_top = $('input[name="custom_top"]').val(),
                $custom_left = $('input[name="custom_left"]').val();
        }
        switch ($position) {
            case 'center_center':
                $r_top = $height / 2;
                $r_left = $width / 2;
                break;
            case 'top_center':
                $r_top = 0;
                $r_left = $width / 2;
                break;
            case 'top_right':
                $r_top = 0;
                $r_left = $width;
                break;
            case 'top_left':
                $r_top = 0;
                $r_left = 0;
                break;
            case 'right_center':
                $r_top = $height / 2;
                $r_left = $width;
                break;
            case 'bottom_center':
                $r_top = $height;
                $r_left = $width / 2;
                break;
            case 'bottom_right':
                $r_top = $height;
                $r_left = $width;
                break;
            case 'bottom_left':
                $r_top = $height;
                $r_left = 0;
                break;
            case 'left_center':
                $r_top = $height / 2;
                $r_left = 0;
                break;
            case 'custom_center':
                $r_top = $custom_top;
                $r_left = $custom_left;
                break;
            default:
                $r_top = $height / 2;
                $r_left = $width / 2;
                break;
        }
        if ($return == 'top') {
            return $r_top;
        } else {
            return $r_left;
        }
    }

    function point_position($position = 'center_center') {
        $('input[name="custom_top"]').val(cacl_position($position, false, 'top')),
            $('input[name="custom_left"]').val(cacl_position($position, false, 'left'));
        $('input[name="custom_hover_top"]').val(cacl_position($position, true, 'top')),
            $('input[name="custom_hover_left"]').val(cacl_position($position, true, 'left'));
        $('.point_style img').each(function() {
            $(this).css({
                'top': '-' + cacl_position($position, false, 'top') + 'px',
                'left': '-' + cacl_position($position, false, 'left') + 'px'
            });
        });
    }
    calc_custom_position();

    function calc_custom_position() {
        var typeVal = $('input[name="choose_type"]:checked').val();
        point_position(typeVal);
    }
    $('input[name="choose_type"]').change(function() {
        var thisVal = $('input[name="choose_type"]:checked').val();
        point_position(thisVal);
        return false;
    });
    $('input[name="custom_top"],input[name="custom_left"]').on('change', function() {
        var thisVal = $('input[name="choose_type"]:checked').val();
        if (thisVal == 'custom_center')
            point_position(thisVal);
        return false;
    });
    $('body').on('click', '[data-popup-open]', function(e) {
        var targeted_popup_class = jQuery(this).attr('data-popup-open');
        $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
        e.preventDefault();
    });
    $('body').on('click', '[data-popup-close]', function(e) {
        var targeted_popup_class = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
        e.preventDefault();
    });
});