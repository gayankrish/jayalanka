$(document).ready(function () {


  $('button[name^="remove_room_type_"]').on('click', function(event) {
      event.preventDefault();

/*      $("form[name='hotel_info']").on("submit", function(e){
        e.preventDefault();
    }); */ 

  //event.preventPropagation();
  console.log(event)
  //console.log("test")
/*   indexid = event.target.name.substring();
  console.log('clicked: remove button '+) */
  return false;
});





  $(".rateyo").rateYo();

  $(".rateyo").rateYo().on('rateyo.set', function(e, data) {
    //console.log("rating changed: "+data.rating);
    $('span.rating-counter').text(data.rating);
    $('input[name="rank"]').val(data.rating);
  });


  $('body').on('hidden.bs.modal', function () {
    //console.log('modal hidden')
    if($('.modal.in').length > 0)
    {
        $('body').addClass('modal-open');
    }
  });

/**
 * Handle image upload and preview - start
 */

 $(function() {

  $('.file_uploder').on('change', 'input', function(e) {
     if (e.target.files.length==0) {
      $('.image-preview').html('');
    }
    handleFileSelect(e); 
    console.log(e);
  });
});


//setUploadButtonStatus();

function setUploadButtonStatus() {
  if($('#img_uploader').val() == ""){
    $('#btnImgUpload').addClass("disabled");
  } else {
    $('#btnImgUpload').removeClass("disabled");
  }

}

  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    $('.image-preview').html('');

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0; i < files.length; i++) {
      f = files[i];

      // Only process image files.
       if (!f.type.match('image.*')) {
        continue;
      } 

      j = i;
      var html = '';
      html += '<div class="col-md-4">';
      html += '<img src="" class="thumbnail img-thumbnail" id="img-thumbnail'+(j+1)+'" name="'+(j+1)+'" onclick="imgClicked(this)">';
      html += '</div>';

      $('.image-preview').append(html);

      _imgTagId = 'img-thumbnail'+(j+1);
      previewImage(f, i,_imgTagId);
    }
  }

  
  function previewImage(file, index, imgTagId) {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(file);
      oFReader.onload = function (oFREvent) {
          document.getElementById(imgTagId).src = oFREvent.target.result;
      };
  };

  $('#myModal').on('hidden.bs.modal', function(){
      //console.log('modal hide');
      $('.image-preview').html('');
      $('.file_uploder').html('');	
      $file_loader = '<label class="btn btn-info" onclick="$(\'#img_uploader\').click();"><i class="glyphicon glyphicon-upload"></i> Add Images</label>';
      $file_loader += '<input type="file" id="img_uploader" name="img_files[]" accept=".jpg,.jpeg,.png" style="display:none;" multiple />';
      $('.file_uploder')
        .html($file_loader);		
	});


$('#btnImgUpload').on('click', function(){
  
  console.log($('#img_uploader').val());

  return false;
});


/**
 * Handle image upload and preview - end
 */

/* setInterval('showCurrentDateTime()', 1000);

$("time.timeago").timeago(); */


// Login form processing


  
/* 
if ($('#fadeout').length) {
  var newLocation = $('input#fadeout').val();
  var count = 4;

  $('#timoutmsg').show();
  var countdown = setInterval(function(){

    if (count == 0) {
      clearInterval(countdown);
      window.location = newLocation;

    }
      $('#timeoutval').html(count);
    count--;
  }, 1000);

} */



$('#login_form').validate({
    rules: {
        username: "required",
        password: "required"
      },

    messages: {
      username: {
        required: "Please enter your username"
      },

      password: {
        required: "Please enter your password"
      }
    }
});



$(document).on('click','#btn-login',function(){
  console.log("inside submit btn");
  var url = "modules/login.php";
  if($('#login_form').valid()){
    console.log("validation ok");
    console.log($("#login_form").serialize());
    //$('#logerror').html('<img src="ajax.gif" align="absmiddle"> Please wait...');
    $.ajax({
    type: "POST",
    url: url,
    data: $("#login_form").serialize(),
    success: function(data)
    {
      //console.log(data);
      if(data==1) {
            //window.location.href = "profile.php";
            location.reload();
            console.log('page reloaded');
      }
      else {  $('#loginerror').html('Incorrect username and/or passowrd!');
            $('#loginerror').addClass("alert alert-danger"); }
      }
      });
  } else {
    console.log("validation failed");
  }
  return false;
});


    $('#category').on('change', function(e){
      /*  if(this.id === "id"){
          var dataObj = {id:this.value};
          dynoDropdowns(this, '#name', dataObj);
        }else if(this.id === "name"){ */
          var dataObj = {'id':this.value};
          dynoDropdowns(this, '#sub_category', dataObj);
      //  }
    });

/*     
    $('#img_url').filestyle({
      iconName : 'glyphicon glyphicon-picture',
      buttonText : 'Add Image',
      buttonName : 'btn-default'
     });
 */


$('#show_contact').on('click', function(e){
    //var obj = this;
    $(this).hide();
    var cnt = $('#cnt_no').val();
    $('#contact_no').html(cnt);
});


});

  // Create image preview modal on click  

function imgClicked(c) {
	//console.log('clicked');
	$('#imgViewModal .modal-body').html('');
  var src = $(c).attr('src');
  var clickedImg = $(c).attr('name')-1;
	var imgs = $('*[id^="img-thumbnail"]')
  
	var html = '';
	var html_carousel_indicators  = '';
	var html_carousel_inner = '';
	html += '<div id="myCarousel" class="carousel slide" data-ride="carousel">';
	html += '<ol class="carousel-indicators">';
	for(i=0; i<imgs.length; i++) {
		
		
		html_carousel_indicators += '<li data-target="#myCarousel" data-slide-to="'+i+'"'+(i==clickedImg?' class="active"':'')+'></li>';
		html_carousel_inner += '<div class="item'+(i==clickedImg?' active':'')+'">';
		html_carousel_inner += '<img src="'+imgs[i].src+'" style="margin: 0 auto;">';
		html_carousel_inner += '</div>';
	}
	html += html_carousel_indicators;
	html += '</ol>';
	html += '<div class="carousel-inner" text-center>';
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
  
}

//Function to display current time in left sidebar - start

function showCurrentDateTime() {
  var _date = moment().format('LL');
  var _time = moment().format('LTS');

  $('#date').html(_date);
  $('#clock').html(_time);
}


function updateClock() {

    var months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    var currentTime = new Date ( );

    var currentDate = currentTime.getDate();
    var currentMonth = months[currentTime.getMonth()];
    var currentYear = currentTime.getYear();


    var currentHours = currentTime.getHours ( );
    var currentMinutes = currentTime.getMinutes ( );
    var currentSeconds = currentTime.getSeconds ( );

    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

    // Choose either "AM" or "PM" as appropriate
    var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

    // Convert the hours component to 12-hour format if needed
    currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

    // Convert an hours component of "0" to "12"
    currentHours = ( currentHours == 0 ) ? 12 : currentHours;

    // Compose the string for display
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
    
    
    $("#clock").html(currentTimeString);
        
 }

//Function to display current time in left sidebar - end

function dynoDropdowns(currElem, nxtElem, dataObj){
  $(nxtElem).empty();
    $.ajax({
        url:"modules/get_subcategories.php",
        type:"post",
        data:dataObj,
        dataType:"json", // <-------------expecting json from php
        success:function(data){
            // empty the field first here.
           var selectcontent = '';
           $.each(data, function(k, v){
             console.log(k + " -> " + v);
              /* $('<option />'{
                   value:obj.value,
                   text:obj.text
               }).appendTo(nxtElem); */
               selectcontent += '<option value='+ k + '>' + v + '</option>';
               //$(nxtElem).append('<option value='+ k + '>' + v + '</option>');
           });
                      $(nxtElem).html(selectcontent);
        },
        error:function(err){
           console.log(err);
        }
    });
}


$('button[name="add_more_types"]').on('click', function(event){
  event.preventDefault();

  var count = $('div[name^="room_type_"]').length;
  console.log(count);

  element = '<div class="form-inline" name="room_type_'+(count+1)+'">';
  element += '<div class="form-group">';
  //element += '<label for="room_types">Room Type</label>'
  element += '<select class="xform-control selectpicker" name="room_type_'+(count+1)+'" data-live-search="true" title="Room Type" data-size="10" data-live-search-placeholder="Search...">'

  $.get('modules/get_room_types.php', function (data, status){

    $.each(JSON.parse(data), function(k, v){
      element += '<option value="'+v.id+'">'+v.room_type+'</option>';
      console.log('options added');


      //console.log("k: "+k+" v: "+v.room_type);
    })

            element += '</select>&nbsp;';
  element += '<input type="number" name="room_count_'+(count+1)+'" class="form-control" placeholder="Number of rooms" min="1" path="trainCount">&nbsp;';
  //$element .= '<button class="btn btn-primary" name="addTrain"><i class="glyphicon glyphicon-plus"></i></button>&nbsp;';
  element += '<button class="btn btn-xs btn-danger" id="remove_room_type" name="remove_room_type_'+(count+1)+'"><i class="glyphicon glyphicon-minus"></i></button>';
  element += '</div>';
  element += '</div><br/>';

  $('div.add_more_room_types').append(element);
  $('.selectpicker').selectpicker('refresh');
  })
})

$('#set_room_types').on('click', '#remove_room_type', function(e) {
  e.preventDefault();
  console.log('clickedddd');
  return false;
});


/**
 * Save Hotel Form start
 */

 $(document).on('click','#save_hotel',function(){
  //console.log($("#hotel_info"));
  var url = "modules/save_hotel.php";
   /* if($('#hotel_info').valid()){  */
    console.log("validation ok");
    //console.log($('#hotel_info').serialize());
     //$('#logerror').html('<img src="ajax.gif" align="absmiddle"> Please wait...');
    $.ajax({
    type: "POST",
    url: url,
    data: $("#hotel_info").serialize(),
    success: function(data)
    {
      if(data) {
            //window.location.href = "profile.php";
            console.log('inside success');
            console.log(data)
            $('div[id^=save_status]').addClass('alert-success');
            $('div[id^=save_status]').html('<strong>New hotel saved successfully!</strong>')
            $('div[id^=save_status]').fadeOut(20000);

      }
      else { 
          $('div[id^=save_status]').addClass('alert-danger');
          $('div[id^=save_status]').html('<strong>Save failed!</strong>')
          $('div[id^=save_status]').fadeOut(20000);
        console.log(data)
      }
    }
      }); 
/*    } else {
    console.log("validation failed");
  }  */
  return false;
});

/**
 * Save Hotel Form end
 */

/**
 * Hotel form validation start
 */

 $('#hotel_info').validate({
    rules: {
        display_name: "required",
        address1: "required",
        email: "required",
        contact_nos: "required",
        hotel_type_id: "required",
        hotel_chain_id: "required",
        fax: "required",
        primary_contact_person: "required",
        city: "required",
        country_id: "required",

      },

    messages: {
      display_name: {
        required: "Please enter the name of the hotel"
      },

      address1: {
        required: "Please enter the address"
      }
    }
});

/**
 * Hotel form validation end
 */