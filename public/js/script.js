  $(document).ready(function(){
   /* $("button").click(function(){
     var id=$(this).attr('id');


     $.ajax({
      url: '/public/addcart/'+id,
      type: 'get',

    });
   });*/
    $(".delete").click(function(){
      var id=$(this).attr('id');


      $.ajax({
        url: '/public/delcart/'+id,
        type: 'get',
        success:function(){
         location.reload();
       }
     });
    })
    $(".qty").change(function(){
      var val=$(this).val();
      var id=$(this).attr('id');

      $.ajax({
        url: '/public/updateCart/'+id+'/'+val,
        type: 'get',
        success:function(data){

         $('.total').html(data);
       }
     });
    })
    function select(){
      var optionSelected=this.selectedIndex == 1;
      var valueSelected=this.value;
      $('select').on('change', function (e) {
       var id=$(this).attr('id');
       var optionSelected = $("option:selected", this);
       var valueSelected = this.value;
       $.ajax({
        url: '/public/updateSelect/'+id+'/'+valueSelected,
        type: 'get',

      });
     })
    }
  select();
/*
  function checkbox(){
          $('input[type="checkbox"]').click(function(){
              if($(this).prop("checked") == true){
                var val=$(this).val();
                var text+=$val+',';
                  var id=$(this).parent().attr('id');
                  alert(text)

              }
                $.ajax({
            url: '/public/updateCheckbox/'+id+'/'+val,
            type: 'get',
           
       });
              else if($(this).prop("checked") == false){
                  alert("Checkbox is unchecked.");
              }
              
          });
        }
        checkbox();*/






        

function checkbox(){
        var text=[];
        $('input[type="checkbox"]').click(function(){
          if($(this).prop("checked") == true){

            var val=$(this).val();
            text.push(val);
            var id=$(this).parent().attr('id');

           
          }
          if($(this).prop("checked") == false){
            var val=$(this).val();



            for( var i=0;i<text.length;i++){
              if ( text[i] === val) 
                text.splice(i, 1);
            }

            var id=$(this).parent().attr('id');
            

          }
          var text1=text.toString();
          console.log(text1)
           $.ajax({
        url: '/public/updateCheckbox/'+id+'/'+text1,
        type: 'get',
        
      });
        })
        
}
checkbox()

$('.order').click(function(){
  select();
  checkbox();
})
      });