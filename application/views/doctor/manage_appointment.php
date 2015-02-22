
    <div class = "container">
    <h2 id="_default"><i class="icon-accessibility on-left"></i>Appointments</h2>
    <?php echo $notif; ?>
    <div class="input-control select span4">
        <span class="text-warning" style="font-family:verdana; font-size:14px;">SHOW: 
            <select style="margin-top:10px;" onChange="location = this.options[this.selectedIndex].value">
                <?php if(!$this->input->get('show')) { ?>
                    <option selected value="<?php echo base_url(); ?>manage_appointment">Active</option>
                    <option value="<?php echo base_url(); ?>manage_appointment?show=1">Inactive</option>
                <?php }if($this->input->get('show') == '1'){ ?>
                    <option selected value="<?php echo base_url(); ?>manage_appointment">Active</option>
                    <option <?php echo $_GET['show'] == '1' ? 'selected' : ''?> value="<?php echo base_url(); ?>manage_appointment?show=1">Inactive</option>
                <?php } ?>
             </select>
        </span>
    </div>
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
                                    <td><center><button id="approve" rowid=<?php echo $row->appoint_id; ?> class='large success'>Approve</center></td>
                                    <td><center><button id="reject" rowid=<?php echo $row->appoint_id; ?> class='large danger'>Reject</center></td>
                                </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>          
    </div>
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click', '#approve', function(){
        if(confirm("Are you sure you want to approve this appointment?")){
            var id = $(this).attr('rowid');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>doctor/changeStat_appointmentToApprove",
                data: {id:id},
                success: function(out){
                    if(out == "Success"){
                        alert('Successfully Approved Appointment');
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
            }).done(function(){
                location.reload();
            });
        }
    });
    $(document).on('click', '#reject', function(){
        if(confirm("Are you sure you want to reject this appointment?")){
            var id = $(this).attr('rowid');
            var flag = 1;
            $.Dialog({
                overlay: true,
                shadow: true,
                flat: true,
                draggable: true,
                icon: '<img src="<?php echo base_url('assets/images/Windows-8-Logo.png')?>">',
                title: 'Flat window',
                content: '',
                width: 500,
                padding: 10,
                onShow: function(_dialog){
                    var content = '<form action="<?php echo base_url('doctor/changeStat_appointmentToReject'); ?>" method="POST" id="editform">' +
                        '<textarea style="margin: 0px; height:125px; width: 593px" name="message"  required></textarea>'+
                       '<div class="input-control text"><input type="hidden" name="appointid" value="'+id+'" required>'+
                        '<div class="form-actions">' +
                        '<button class="button primary" onclick="$.Dialog.close();">Send</button> '+
                        '<button class="button" type="button" onclick="$.Dialog.close()">Cancel</button> '+
                        '</div>'+
                        '</form>';
         
                    $.Dialog.title("Send a message to the Patient");
                    $.Dialog.content(content);
                    $.Metro.initInputs();
                }
            });
        }
    });
})
</script>