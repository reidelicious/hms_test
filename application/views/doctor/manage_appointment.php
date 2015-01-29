<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>    
    <div class = "container">
    <h2 id="_default"><i class="icon-accessibility on-left"></i>Appointments</h2>
	<div class="grid fluid">
    	<div class="row">
                <table class="table striped hovered">
                    <thead>
                        <tr>
                             <th> Date </th> 
                             <th> Time </th> 
                             <th> Patient Name </th> 
                             <th> Approve </th> 
                             <th> Reject </th> 
                        </tr>
                    </thead>
                    <tbody>
                    	<?php foreach($pending as $row): ?>
                                <tr class="tbtr" style="background-color: white">
                                    <td><center><?php echo $row->date ?></center></td>
                                    <td><center><?php echo $row->time ?></center></td>
                                    <td><center><?php echo $row->fname ?></center></td>
                                    <td><center><button id="approve" rowid=<?php echo $row->appointment_id; ?> class='large success'>Approve</center></td>
                                    <td><center><button id="reject" rowid=<?php echo $row->appointment_id; ?> class='large danger'>Reject</center></td>
                                </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>          
    </div>
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click', '#approve', function(){
        var id = $(this).attr('rowid');
        var flag = 0;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>doctor/changeStat_appointment",
            data: {id:id, flag:flag},
            success: function(out){
                if(out == "Success"){
                    var not = $.Notify({
                                style: {background: 'green', color: 'white'}, 
                                caption: 'Successfully Approved Appointment',
                                content: "",
                                timeout: 10000 // 10 seconds
                            });
                }
                else{
                    var not = $.Notify({
                                style: {background: 'red', color: 'white'}, 
                                caption: 'Error',
                                content: "There was an error in the system, Sorry for the inconvenience",
                                timeout: 10000 // 10 seconds
                            });
                }
            }
        });
    });
    $(document).on('click', '#reject', function(){
        var id = $(this).attr('rowid');
        var flag = 1;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>doctor/changeStat_appointment",
            data: {id:id, flag:flag},
            success: function(out){
                if(out == "Success"){
                    var not = $.Notify({
                                style: {background: 'green', color: 'white'}, 
                                caption: 'Successfully Rejected Appointment',
                                conten: "",
                                timeout: 10000 // 10 seconds
                            });
                }
                else{
                    var not = $.Notify({
                                style: {background: 'red', color: 'white'}, 
                                caption: 'Error',
                                content: "There was an error in the system, Sorry for the inconvenience",
                                timeout: 10000 // 10 seconds
                            });
                }
            }
        });
    });
})
</script>