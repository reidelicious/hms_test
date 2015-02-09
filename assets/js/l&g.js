$(document).ready(function(){

	$("a.switcher").bind("click", function(e){
		e.preventDefault();
		
		var theid = $(this).attr("id");
		var theproducts = $("ul#products");
		var classNames = $(this).attr('class').split(' ');
		
		var gridthumb = "img/products/grid-default-thumb.png";
		var listthumb = "img/products/list-default-thumb.png";
		
		if($(this).hasClass("active")) {
			// if currently clicked button has the active class
			// then we do nothing!
			return false;
		} else {
			// otherwise we are clicking on the inactive button
			// and in the process of switching views!

  			if(theid == "gridview") {
				$(this).removeClass(" btn-custom");
				$(this).addClass("active btn-warning");	
				$("#listview").removeClass("active btn-warning");
				$("#listview").addClass("btn-custom");
		
			
				
			
				// remove the list class and change to grid
				theproducts.removeClass("list");
				theproducts.addClass("grid");
			
				// update all thumbnails to larger size
			//	$("img.thumb").attr("src",gridthumb);
			}
			
			else if(theid == "listview") {
				$(this).removeClass(" btn-custom");
				$(this).addClass("active btn-warning");
				
				$("#gridview").removeClass("active btn-warning");		
				$("#gridview").addClass("btn-custom");
					
				var theimg = $(this).children("img");
				theimg.attr("src","images/list-view-active.png");
					
				// remove the grid view and change to list
				theproducts.removeClass("grid")
				theproducts.addClass("list");
				// update all thumbnails to smaller size
			//$("img.thumb").attr("src",listthumb);
			} 
		}

	});
});