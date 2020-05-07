<div id="draggable{{ $countPoint }}" data-points="{{ $countPoint }}" class="drag_element" <?php if($topPin && $leftPin):?> style="top:<?php echo $topPin?>%; left:<?php echo $leftPin?>%;"<?php endif;?>>
	<div class="point_style">		
		<a href="#" class="pins_click_to_edit" data-popup-open="info_draggable<?php echo $countPoint?>" data-target="#info_draggable{{ $countPoint }}">
			<img src="{{ $imgPin }}">
		</a>
	</div>
</div>