 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $(document).ready(function(){
    $("#lightSlider").lightSlider(); 

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

    // ------------- adding F & A -------------

});