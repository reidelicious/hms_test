<div class="container">
    	
        
      
<h2 id="_default"><i class="icon-accessibility on-left"></i>Manage Clinic</h2>
<?php
$attributes = array( 'enctype' => 'multipart/form-data', 'id'=> 'AdduserForm');

 echo form_open('admin/addClinic_validation',$attributes); ?>
    <fieldset>
    
    <legend>Add Clinic</legend>
    <?php echo validation_errors(); ?>

        <label>Specialization  </label>
        <div class="input-control select">
            <select name="Specialization" id="Specialization"  required>
                <option value=''<?php echo set_select('utype', '', TRUE); ?> disabled="disabled"> Select Specialist</option>
                <?php foreach($specialists as $row): ?>
                    <option value="<?php echo $row->specialist_id; ?>"> <?php echo $row->specialist; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <label>Clinic name </label>
    	
        	<?php $data = array( 'name'=> 'clinicname', 'placeholder'=>'enter clinic name','required'=>'required', 'data-transform'=>'input-control');?>
         	<?php echo form_input($data, $this->input->post('clinicname')); ?>
    		
    	
       

        	<?php echo form_submit('clinic_submit','Add Clinic'); ?>
    </fieldset>
<?php echo form_close();?>
</body>
</html>