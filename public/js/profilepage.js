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
        $('.dynamic-form-skill').show("fast");
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
        $('.dynamic-form-education').toggle("fast");
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
        $('.dynamic-form-experience').toggle("fast");
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
        $('.dynamic-form-fa').toggle("fast");
    });

    $("#post-fa").click(function(){
      var title = $("#fa-title").val();
      var date = $("#fa-date").val();
      var achievement = $('input[name=achievement]:checked').val();
      $.post( "/fas", { title: title, achievement: achievement, date: date} , function(){
        location.reload();
      });

    });
});