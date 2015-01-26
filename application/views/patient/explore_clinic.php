<?php echo link_tag('assets/css/l&g.css');echo link_tag('assets/css/dimmer.min.css');?>
<script src="<?php echo base_url('assets/js/dimmer.min.js')?>"></script>
<style type="text/css">
.alphabetical li .active a{
	 font-weight: bold;
	};
</style>
<div class="container">
    <div class="grid fluid">
        <div class="row">	
            <div class="span3">  </br></br></br>
            	<nav class="sidebar light">
                    <ul>
                    	<li class="stick bg-red"><a href="#"><i class="icon-cog"></i>Doctors</a></li>
                   		<li class="stick bg-yellow"><a href="#"><i class="icon-cog"></i>Clinic</a></li>
                    </ul>
                </nav>
          		<?php echo $output;?>
            </div>
            <div class="span9">
                <div class="lg"> 
                    <header>                 
                    	<h1>Doctors</h1>   
                        <strong>
					<ul style="list-style:none;" class="inline alphabetical">
                       
					</ul>
            		</strong>    
                    </header>
                    <ul id="products" class="grid clearfix">          
        

                          
                    </ul>
                    <footer>   
                    	<br />                 
                    	<div class="pagination small">
               
                   		</div>
                    </footer>
                </div> 
            </div>                   
    </div>
</div>



<script type="text/javascript">

$(document).on('click','.viewProfile', function(){
		var $bla = $(this).parents('td').prev();	
		var lname = $(this).siblings('#lname').val();
		var fname = $(this).siblings('#fname').val();
		var email = $(this).siblings('#id').val();
		var specialization = $(this).siblings('#specialization').val();
		var Cnum = $(this).siblings('#room_num').val();
		var Rnum = $(this).siblings('#cont_num').val();
		var avatar = $(this).siblings('#avatar').val();
		
		var currentdate = new Date(); 
var date =currentdate.getFullYear() + "/" 
                + (currentdate.getMonth()+1)  + "/"
				+ currentdate.getDate()  ;
                
		var id = $(this).siblings('#id').val();	
		var cont= 		'<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header">'+
									'<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+
									'<h4 class="modal-title" id="myModalLabel">Doctor </h4>'+
								'</div>'+
								'<div class="modal-body">'+
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
											'<div class="input-control text" id="datepicker" data-role="datepicker" data-date="'+date+'"  data-format="dddd, mmmm d, yyyy" data-effect="fade">'+
                                   ' <input type="text" placeholder="please enter date" >'+
                                   ' <button class="btn-date"></button>'+
                              '  </div> '+
											'<label>email</label>' +
											'<div class="input-control text"><input type="time"  value= "" name="time" required>'+
											'</div> ' +
										
										'</form>'+
									'</div>'+
									'<div class="modal-footer appointmentForm" hidden="hidden">'+
										'<button type="button" class=" closemdl btn btn-default" data-dismiss="modal">Close</button>'+
										'<button type="button" class=" closemdl btn btn-primary">Save changes</button>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>';

		$( "#modal_cont" ).html(cont);

		$('#myModal').modal('show');	
		 $("#datepicker").datepicker();

	});	//end of viewProfile</script>