<script type="text/javascript">
	 function Country(code){
      var id = $("#providerCountry").val();

//var id = document.getElementById("providerCountry").val();

        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/CityCoutry',   
            data: {"id":id},  
          
            success:function(data){   
           

               // document.getElementById("city").innerHTML = this.responseText;
              	state(code);
                $("#city").html(data);
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
    });

        }
          function state(code){
      var code = $("#providerCountry").val();

//var id = document.getElementById("providerCountry").val();

        $.ajax({
            type:'POST',
            url: baseUrl+'/itemsPartner/Provider/StateCountry',   
            data: {"code":code},  
          
            success:function(data){   
           
             
               // document.getElementById("city").innerHTML = this.responseText;
                
                $("#state").html(data);
            },
            error: function(data){
            console.log("error");
            console.log(data);
            }
    });

        }
</script>