$(document).ready(function(){        
	//$('*[id^="img-thumbnail"]').on('click',function(){

	function imgClicked1() {

		var src = $(this).attr('src');

		var imgs = $('*[id^="img-thumbnail"]')

		console.log(imgs);


		//console.log('clicked');
/* 		var src = $(this).attr('src');

		var img = '<img src="' + src + '" style="margin: 0 auto;" class="img-responsive center"/>';
		
		//start of new code new code
		var index = $(this).attr('name');
		//console.log(index)
		var html = '';
		html += img;                
		html += '<div style="height:25px;clear:both;display:block;margin-top:3px;">';
		html += '<a class="controls previous btn btn-default" href="' + (index-1) + '">&laquo; prev</a>';
		html += '<a class="controls next btn btn-default pull-right" href="'+ (index+1) + '">next &raquo;</a>';

		html += '</div>';
		
		$('#imgViewModal').modal();
		$('#imgViewModal').on('shown.bs.modal', function(){
			$('#imgViewModal .modal-body').html(html);
			//new code
			//$('a.controls').trigger('click');
		})
		$('#imgViewModal').on('hidden.bs.modal', function(){
			$('#imgViewModal .modal-body').html('');
		}); */
		
		
		
		
   }//);	
})


$(document).on('click', 'a.controls', function(){
	var index = $(this).attr('href');
	var src = $('#img-thumbnail'+ index).attr('src'); 



	//console.log(src);
	//$('#imgViewModal .modal-body img').attr('title', 'test');
	$('#imgViewModal .modal-body img').attr('src', src);
	
	
	var newPrevIndex = parseInt(index) - 1; 
	var newNextIndex = parseInt(newPrevIndex) + 2; 
	
	if($(this).hasClass('previous')){               
		$(this).attr('href', newPrevIndex); 
		$('a.next').attr('href', newNextIndex);
	}else{
		$(this).attr('href', newNextIndex); 
		$('a.previous').attr('href', newPrevIndex);
	}
	
	var total = $('#imgsCount').val(); 
	//console.log('toal: '+total+' - newNextIndex: '+newNextIndex);
	//hide next button
	//console.log(total == (newNextIndex-1));
	if(total == (newNextIndex-1)){
		$('a.next').hide();
	}else{
		$('a.next').show()
	}            
	//hide previous button
	if(newPrevIndex === 0){
		$('a.previous').hide();
	}else{
		$('a.previous').show()
	}
	
	
	return false;
});


function imgClicked(c) {
		//console.log('clicked');
		$('#imgViewModal .modal-body').html('');
		var src = $(c).attr('src');

		var imgs = $('*[id^="img-thumbnail"]')

		var html = '';
		var html_carousel_indicators  = '';
		var html_carousel_inner = '';

		html += '<div id="myCarousel" class="carousel slide" data-ride="carousel">';
		html += '<ol class="carousel-indicators">';

		for(i=0; i<imgs.length; i++) {
			
			
			html_carousel_indicators += '<li data-target="#myCarousel" data-slide-to="'+i+'"'+(i==0?' class="active"':'')+'></li>';

			html_carousel_inner += '<div class="item'+(i==0?' active':'')+'">';
			html_carousel_inner += '<img src="'+imgs[i].src+'">';
			html_carousel_inner += '</div>';

		}

		html += html_carousel_indicators;
		html += '</ol>';

		html += '<div class="carousel-inner">';
		html += html_carousel_inner;
		html += '</div>';

		html += '<a class="left carousel-control" href="#myCarousel" data-slide="prev">';
		html += '<span class="glyphicon glyphicon-chevron-left"></span>';
        html += '<span class="sr-only">Previous</span>';
		html += '</a>';
		
		html += '<a class="right carousel-control" href="#myCarousel" data-slide="next">';
        html += '<span class="glyphicon glyphicon-chevron-right"></span>';
        html += '<span class="sr-only">Next</span>';
		html += '</a>';
		
		html += '</div>';

		$('#imgViewModal .modal-body').html(html);
		$('#imgViewModal').modal();
/* 		$('.carousel-indicators').html(html_carousel_indicators);
		$('.carousel-inner').html(html_carousel_inner);
		$('#imgViewModal').modal();
		$('#imgViewModal').on('hidden.bs.modal', function(){
			$('.carousel-indicators').html('');
			$('.carousel-inner').html('');
		});
 */
				//console.log(src);
/* 		var img = '<img src="' + src + '" style="margin: 0 auto;" class="img-responsive center"/>';
		
		//start of new code new code
		var index = $(this).attr('name');
		//console.log(index)
		var html = '';
		html += img;                
		html += '<div style="height:25px;clear:both;display:block;margin-top:3px;">';
		html += '<a class="controls previous btn btn-default" href="' + (index-1) + '">&laquo; prev</a>';
		html += '<a class="controls next btn btn-default pull-right" href="'+ (index+1) + '">next &raquo;</a>';

		html += '</div>';
		
		$('#imgViewModal').modal();
		$('#imgViewModal').on('shown.bs.modal', function(){
			$('#imgViewModal .modal-body').html(html);
			//new code
			$('a.controls').trigger('click');
		})
		$('#imgViewModal').on('hidden.bs.modal', function(){
			$('#imgViewModal .modal-body').html('');
		}); */
		
		
		
		
   }

/* 
$(document).ready(function(){        
	$('*[id^="img-thumbnail"]').on('click',function(){

		var src = $(this).attr('src');
		var img = '<img src="' + src + '" style="margin: 0 auto;" class="img-responsive center"/>';
		
		//start of new code new code
		var index = $(this).parent('li').index();   
		//console.log(index)
		var html = '';
		html += img;                
		html += '<div style="height:25px;clear:both;display:block;margin-top:3px;">';
		html += '<a class="controls previous btn btn-default" href="' + (index) + '">&laquo; prev</a>';
		html += '<a class="controls next btn btn-default pull-right" href="'+ (index+2) + '">next &raquo;</a>';

		html += '</div>';
		
		$('#imgViewModal').modal();
		$('#imgViewModal').on('shown.bs.modal', function(){
			$('#imgViewModal .modal-body').html(html);
			//new code
			$('a.controls').trigger('click');
		})
		$('#imgViewModal').on('hidden.bs.modal', function(){
			$('#imgViewModal .modal-body').html('');
		});
		
		
		
		
   });	
})
 */        
/*          
$(document).on('click', 'a.controls', function(){
	var index = $(this).attr('href');
	var src = $('ul.gal li:nth-child('+ index +') img').attr('src'); 

	//$('#imgViewModal .modal-body img').attr('title', 'test');
	$('#imgViewModal .modal-body img').attr('src', src);
	
	
	var newPrevIndex = parseInt(index) - 1; 
	var newNextIndex = parseInt(newPrevIndex) + 2; 
	
	if($(this).hasClass('previous')){               
		$(this).attr('href', newPrevIndex); 
		$('a.next').attr('href', newNextIndex);
	}else{
		$(this).attr('href', newNextIndex); 
		$('a.previous').attr('href', newPrevIndex);
	}
	
	var total = $('ul.gal li').length + 1; 
	//hide next button
	if(total === newNextIndex){
		$('a.next').hide();
	}else{
		$('a.next').show()
	}            
	//hide previous button
	if(newPrevIndex === 0){
		$('a.previous').hide();
	}else{
		$('a.previous').show()
	}
	
	
	return false;
});
 */