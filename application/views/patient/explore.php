<?php echo link_tag('assets/css/l&g.css');
	  echo link_tag('assets/css/dimmer.min.css');
 ?>
 <script src="<?php echo base_url('assets/js/dimmer.min.js')?>"></script>
 <script src="<?php echo base_url('assets/js/l&g.js')?>"></script>

<div class="container">
    <div class="grid fluid">
        <div class="row">
            <div class="span3">
            </br></br>
                <nav class="sidebar light">
                    <ul>
                        <li class="stick bg-red"><a href="#"><i class="icon-cog"></i>Doctors</a></li>
                        <li class="stick bg-yellow"><a href="#"><i class="icon-cog"></i>Clinic</a></li>
                    </ul>
            	</nav>
            </div>
            <div class="span9">
          	  <div class="lg">
                    <header>                 
                        <h1>Doctors</h1>       
                    </header>
			
            	    <ul id="products" class="grid clearfix">
              	      <!-- row 1 -->
                    <li class="clearfix dims">
                    	 <div class="ui dimmer">
                          	<div class="content">
                             	<div class="center">
                               		<div class="ui primary button">Add</div>
                               		<div class="ui button">View</div>
                             	</div>
                            </div>
                         </div>
                          
                        <section class="left">
                            <div class="thumb">  <?php echo  img('assets/images/red.jpg'); ?></div>
                            <h3>Marjhun Christopher Galanido</h3>                      
                        </section>
                        <section class="right">
                            <span class="price">Family Doctor</span>
                        </section>
                    </li>
                    
                    <!-- row 2 -->
                    <li class="clearfix">
                        <section class="left">
                              <div class="thumb">  <?php echo  img('assets/images/red.jpg'); ?></div>
                            <h3>Angel James Torayno</h3>
                        
                        </section>
                        
                        <section class="right">
                            <span class="price">Family Doctor</span>
                            <span class="darkview">
                            
                            <a href="javascript:void(0);"  class="firstbtn btn btn-warning" data-toggle="modal" data-target="#myModal">View Profile</a> 
                            </span>
                        </section>
                    </li>
                    
                    <!-- row 3 -->
                    <li class="clearfix">
                        <section class="left">
                              <div class="thumb">  <?php echo  img('assets/images/red.jpg'); ?></div>
                            <h3>Angel James Torayno</h3>
                        
                        </section>
                        
                        <section class="right">
                            <span class="price">Family Doctor</span>
                            <span class="darkview">
                            
                            <a href="javascript:void(0);"  class="firstbtn btn btn-warning" data-toggle="modal" data-target="#myModal">View Profile</a> 
                            </span>
                        </section>
                    </li>
                    
            
                    
         
                </ul>
                
                <footer>   
                <br />
                  <div class="pagination small">
                    <ul>
                        <li class="first"><a><i class="icon-first-2"></i></a></li>
                        <li class="prev"><a><i class="icon-previous"></i></a></li>
                        <li><a>1</a></li>
                        <li><a>2</a></li>
                        <li class="active"><a>3</a></li>
                        <li class="spaces"><a>...</a></li>
                        <li class="disabled"><a>4</a></li>
                        <li><a>500</a></li>
                        <li class="next"><a><i class="icon-next"></i></a></li>
                        <li class="last"><a><i class="icon-last-2"></i></a></li>
                    </ul>
                </div>
                </footer>
                    
            </div>
            	
            </div>
        </div>
</div>
        
    
</div>

  

<script type="text/javascript">

$('.dims')
  .dimmer({
    on: 'hover',
	duration    : {
  	show : 0,
	 hide : 10
	}
  });
</script>


