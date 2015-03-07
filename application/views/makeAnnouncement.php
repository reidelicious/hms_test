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
                    $data = array('onsubmit' => 'return confirmAnnouncement()');
                    echo form_open('main/makeAnnouncement_validation', $data);
                    echo validation_errors();
                ?>
                <label> Subject: </label>
                <div class="input-control text" data-role="input-control">
                    <input type="text" id="sub" name="subject" value="<?php echo $this->input->post('subject') ?>" required>
                    <button class="btn-clear" tabindex="-1"></button>
                </div>
                <label> More Information: </label>
                <textarea name="details" id="dets" style="display:block; width:100%; max-width:100%;" required></textarea><br/>
                <button type="button" name="announcement_submit" class="primary button">Save</button>
            </div>
        </div>
    </div>
    <?php  echo $success; ?>
</body>
<script type="text/javascript">
function confirmAnnouncement(){
    $.Dialog({
        overlay: true,
        shadow: true,
        flat: true,
        draggable: true,
        icon: '<img src="images/excel2013icon.png">',
        title: 'Confirmation',
        width: 300,
        content: '',
        padding: 10,
        onShow: function(_dialog){
            var content =     '<center><p class="readable-text">Announcement<p/>' +
                              '<dl class="horizontal">' + 
                              '<dt>Subject: </dt>' + 
                              '<dd>' + $("#sub").val() +'</dd>' +
                               
                              '<dt>Details: </dt>' + 
                              '<dd>' + $('#dets').text() + "</dd>" + 
                              '<dt>Time: </dt>' +
                              '<div class="grid fluid">'+
                              '<div class="row">'+
                              '<div class="span8 offset2"> <button class="danger btn-close" onclick="$.Dialog.close()"><i class="icon-cancel-2 on-left"></i>   NO</button> '+
                              '<button class="primary confirmOverwrite" id="overwrite" onclick="$.Dialog.close();return true;"><i class="icon-thumbs-up on-left"></i>  YES</button>'+
                              '</div>'+
                              '</div></center>'+
                            '</div> ';
            
 
            $.Dialog.title("Confirming!");
            $.Dialog.content(content);
            $.Metro.initInputs();
        }
        
    });
    return false;
}
    
</script>
</html>
