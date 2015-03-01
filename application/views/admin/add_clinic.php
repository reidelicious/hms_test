<div class="container">
    	
        
      
<h2 id="_default"><i class="icon-accessibility on-left"></i>Manage Clinic</h2>
<?php
$attributes = array( 'enctype' => 'multipart/form-data', 'id'=> 'AddClinicForm');

 echo form_open('admin/addClinic_validation',$attributes); ?>
    <fieldset>
    
    <legend>Add Clinic</legend>
    <?php echo validation_errors(); ?>

        <label>Specialization  </label>
        <div class="input-control select">
            <select name="Specialization" id="Specialization"  required>
                <option value=''<?php echo set_select('utype', '', TRUE); ?> disabled="disabled"> Select Specialization</option>
                <?php foreach($specialists as $row): ?>
                    <option value="<?php echo $row->specialist_id; ?>"> <?php echo $row->specialist; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <label>Clinic name </label>
    	
        	<?php $data = array( 'name'=> 'clinicname', 'placeholder'=>'enter clinic name','required'=>'required', 'data-transform'=>'input-control');?>
         	<?php echo form_input($data, $this->input->post('clinicname')); ?>
    	
        <label>Room  num</label>
            <?php $data = array( 'name'=> 'room_num', 'placeholder'=>'enter clinic room','required'=>'required', 'data-transform'=>'input-control');?>
         	<?php echo form_input($data, $this->input->post('room_num')); ?>
        	<?php echo form_submit('clinic_submit','Add Clinic'); ?>
    </fieldset>
    <?php echo form_close();

    	echo $success;
    ?>
</body>
<script type="text/javascript">
$(document).ready(function(){
$('#AddClinicForm').validate({
        rules: {
          clinicname: {
            minlength: 2,
            required: true,
            lettersonly: true
          },
          room_num: {
             minlength: 2,
             required: true,
             alphanumeric: true
          }
        },
            highlight: function(element) {
                $(element).closest('.input-control').removeClass('success-state').addClass('error-state');
            },
            success: function(element) {
                element
                    .closest('.input-control').removeClass('error-state').addClass('success-state');
            },
            
            messages: {
              name: "Please specify your name",
              email: {
                  required: "We need your email address to contact you",
                  email: "Your email address must be in the format of name@domain.com"
              },
             cPassword:{equalTo: "Password doesnt match"}
            }
      });

}); // end document.ready
</script>
</html>