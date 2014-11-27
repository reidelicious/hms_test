 <style type="text/css">

/* Glyph, by Harry Roberts */
		
hr.style-eight {
    padding: 0;
    border: none;
    border-top: medium double #333;
    color: #333;
    text-align: center;
}
hr.style-eight:after {
    content: "OR";
    display: inline-block;
    position: relative; 
    top: -0.7em;  
    font-size: 1.5em;
    padding: 0 0.25em;
    background: white;
}
.btn-block {
display: block;
width: 100%;
}
	</style>

<div class="container">
    <div class="grid fluid">
        <div class="row">
            <div class="span5 offset4">
            <h2 id="_default"><i class="icon-accessibility on-left"></i>Make Annoucement</h2>
                <?php 
                
                echo form_open('main/makeAnnouncement_validation');
                
                echo validation_errors();
            
            
                ?>
                 <label>subject </label>
                    <div class="input-control text" data-role="input-control">
                        <?php $data = array( 'name'=> 'subject');?>
                        <?php echo form_input($data, $this->input->post('subject')); ?>
                        <button class="btn-clear" tabindex="-1"></button>
                    </div>
                <?php
                echo "<p> More Information: </br>";
                $data = array( 'name'=> 'details', 'required'=>'required', 'class' => 'btn-block');
                echo form_textarea($data);
                echo "</p>";
                
                echo "<p>";
                echo form_submit('announcement_submit','Save');
                echo "</p>";
                
                echo form_close();
                ?>
            </div>
        </div>
    </div>
</body>
</html>