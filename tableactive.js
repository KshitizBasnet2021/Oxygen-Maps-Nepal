
  $(document).ready(function(){

    load_data(1);
    let selected='0';
    let search_box=false;
    function load_data(page, query = '')
    {
      $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      if(search_box){
      var query = $('#search_box').val();
      search_box=false;
    }
    else{
      var query='p'+selected;
    }
      load_data(page, query);
    });

        $(document).on('click', '#pp0', function(){
      var query = 'p0';
       selected='0';
      load_data(1, query);
    });
            $(document).on('click', '#pp1', function(){
      var query = 'p1';
      selected='1';
      load_data(1, query);
    });
    $(document).on('click', '#pp2', function(){
      var query = 'p2';
      selected='2';
      load_data(1, query);
    });
            $(document).on('click', '#pp3', function(){
      var query = 'p3';
      selected='3';
      load_data(1, query);
    });
                    $(document).on('click', '#pp4', function(){
      var query = 'p4';
      selected='4';
      load_data(1, query);
    });
            $(document).on('click', '#pp5', function(){
      var query = 'p5';
      selected='5';
      load_data(1, query);
    });
    
    $(document).on('click', '#pp6', function(){
      var query = 'p6';
      selected='6';
      load_data(1, query);
    });
      $(document).on('click', '#pp7', function(){
      var query = 'p7';
      selected='7';
      load_data(1, query);
    });

    $('#search_box').keyup(function(){
      var query = $('#search_box').val();
      search_box=true;
      load_data(1, query);
    });
     
    $("select#sortHospitals").change(function(){
        var selectedHospital = $(this).children("option:selected").val();
        if(selectedHospital==0){
            var query = 'p'+selected;
            load_data(1, query);
        }
          if(selectedHospital==1){
            var query = 'a'+selected;
            load_data(1, query);
        }
         if(selectedHospital==2){
            var query = 'o'+selected;
            load_data(1, query);
        }
         if(selectedHospital==3){
            var query = 'n'+selected;
            load_data(1, query);
        }
    });
  });

