 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $(document).ready(function(){
    // inline editable setup
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editable.defaults.ajaxOptions = {type: "PUT"}
    // 
    $('.editable').editable();


    // Slideshows of images
    $("#lightSlider").lightSlider();
    $("#lightSlider1").lightSlider(); 

    // ------------POSTING DATA----------
    // ------- adding skills ----------
    $("#add-skill").click(function(){
        $('.dynamic-form-skill').toggle("fast", function(){
          if ($('.dynamic-form-skill').is(':visible')) 
            {$('#add-skill').html('Close form');} 
          else 
          {
            $('#add-skill').html('Add Skill');
          }
          
        });
    });
    // Post the skill
    $("#post-skill").click(function(){
      var skill = $("#skill-input").val();
      $.post( "/skills", { skill: skill } , function(){
        location.reload();
      });

    });

    // ------------- adding education ------------
     $("#add-education").click(function(){
        $('.dynamic-form-education').toggle("fast", function(){
          if ($('.dynamic-form-education').is(':visible')) 
            {$('#add-education').html('Close form');} 
          else 
          {
            $('#add-education').html('Add Education');
          }
          
        });
        
    });

    $("#post-education").click(function(){
      var title = $("#education-title").val();
      var place = $("#education-place").val();
      var fromdate = $("#education-fromdate").val();
      var todate = $("#education-todate").val();
      
      $.post( "/educations", { title: title, place: place, fromdate: fromdate, todate: todate} , function(){
        location.reload();
      });

    });
    // -------------- adding experience ----------

    $("#add-experience").click(function(){
        $('.dynamic-form-experience').toggle("fast", function(){
          if ($('.dynamic-form-experience').is(':visible')) 
            {$('#add-experience').html('Close form');} 
          else 
          {
            $('#add-experience').html('Add Experience');
          }
          
        });
    });

    $("#post-experience").click(function(){
      var title = $("#experience-title").val();
      var place = $("#experience-place").val();
      var fromdate = $("#experience-fromdate").val();
      var todate = $("#experience-todate").val();
      
      $.post( "/experiences", { title: title, place: place, fromdate: fromdate, todate: todate} , function(){
        location.reload();
      });

    });


    // ------------- adding F & A -------------
    $("#add-fa").click(function(){
        $('.dynamic-form-fa').toggle("fast", function(){
          if ($('.dynamic-form-fa').is(':visible')) 
            {$('#add-fa').html('Close form');} 
          else 
          {
            $('#add-fa').html('Add Featured & Awards');
          }
          
        });
    });

    $("#post-fa").click(function(){
      var title = $("#fa-title").val();
      var date = $("#fa-date").val();
      var achievement = $('input[name=achievement]:checked').val();
      $.post( "/fas", { title: title, achievement: achievement, date: date} , function(){
        location.reload();
      });

    });

    // --------- Delete requests ---------

    $('a.delete-btn').click(function(){
      event.preventDefault();
      var url = $(this).attr('href');
      var yesDelete = confirm("Are you sure you want to delete this?");
      if(yesDelete)
       { $.ajax({
                     url: url,
                     type: 'DELETE',
                     success: function(result) {
                       location.reload();
                     }
               });
        }

    });

    // 
});