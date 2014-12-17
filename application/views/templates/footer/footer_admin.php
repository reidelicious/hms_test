
<div id="editprof_div"></div>
<script type="text/javascript">

$(document).on('click','#editProfile', function(){
	var $bla = $(this).parents('td').prev();
	
	var lname = "<?php echo 'torayno' ?>";
	var fname = $(this).siblings('#fname').val();
	var email = $(this).siblings('#id').val();
	var specialization = $(this).siblings('#specialization').val();
	var Cnum = $(this).siblings('#room_num').val();
	var Rnum = $(this).siblings('#cont_num').val();
	var avatar = $(this).siblings('#avatar').val();
	
	var id = $(this).siblings('#id').val();
	
	var cont= '	<div class="modal fade" id="editprof_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
				  '<div class="modal-dialog">'+
					'<div class="modal-content">'+
					 ' <div class="modal-header">'+
						'<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+
						'<h4 class="modal-title" id="myModalLabel">Doctor </h4>'+
					'  </div>'+
					'  <div class="modal-body">'+
							'<div class="thumb" style="margin: 0 auto;"><img  class="scale" src = "<?php echo base_url()?>'+avatar+'" ></div>'+

							'<dl class="horizontal" style="margin: 0 auto;">'+
								'<dt>Name:</dt>'+
									'<dd>'+ fname+'  '+lname+'</dd>'+
								'<dt>Specialization:</dt>'+
									'<dd>'+specialization+'</dd>'+
								'<dt>Contact num:</dt>'+
									'<dd>'+Cnum+'</dd>'+
								'<dt>Room num:</dt>'+
									'<dd>'+Rnum+'</dd>'+
								'<dt></dt>'+
									'<dd><button class="default makeAppointment">lalala</button></dd>'+
							  '</dl>'+
							  
							  '<form action="<?php echo base_url('admin/blabla'); ?>" method="POST"  class="appointmentForm" hidden="hidden">' +
                '<label>id</label>' +
                '<div class="input-control text"><input type="text" name="date" value="">'+
               ' <button class="btn-clear"></button></div> ' +
			     '<label>email</label>' +
                '<div class="input-control text"><input type="email"  value= "" name="time" required>'+
               ' <button class="btn-clear"></button></div> ' +
			     '<label>first name</label>' +
                '<div class="input-control text"><input type="text" value = "" name="message"  required>'+
               ' <button class="btn-clear"></button></div> ' +
                '</form>'+
					 ' </div>'+
					 ' <div class="modal-footer appointmentForm" hidden="hidden">'+
						'<button type="button" class=" closemdl btn btn-default" data-dismiss="modal">Close</button>'+
						'<button type="button" class=" closemdl btn btn-primary">Save changes</button>'+
					 ' </div>'+
					'</div>'+
				  '</div>'+
			'</div>';
	$( "#editprof_div" ).html(cont);
	$('#editprof_modal').modal('show');
	
	
});	

</script>


</body>
</html>