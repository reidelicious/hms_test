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
                <label> Subject: </label>
                <div class="input-control text" data-role="input-control">
                    <input type="text" name="subject" value="<?php echo $this->input->post('subject') ?>" required>
                    <button class="btn-clear" tabindex="-1"></button>
                </div>
                <label> More Information: </label>
                <textarea name="details" style="display:block; width:100%; max-width:100%;" required></textarea><br/>
                    <button type="submit" name="announcement_submit" class="primary button">Save</button>
            </div>
        </div>
    </div>
    <?php  echo $success; ?>
</body>
</html>