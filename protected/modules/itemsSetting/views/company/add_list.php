<style>
/* The Modal (background) */
.modal {

    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 0px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    border-radius: 0px;
    border: 1px solid #888;
    width: 60%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
.Banner_list{
    background: #4e9a7b;
    color: white;
    padding: 9px 30px;
    font-size: 18px;
   
    
  

}
.content_list{
    padding: 10px;
}
.save{
    border-radius: 0px;
   
}
.save:hover{
       box-shadow: 0 5px 15px rgba(0,0,0,.5);
}
.save:focus{
         border: 0px solid #888;
        box-shadow: 3px 4px 3px 1px #CCC;
}

.n1{
    margin-bottom: 5px;
}
.addliast label{
    margin-top: 5px;
    margin-bottom: 5px;
}
.thumb-image{float:left;width:100%;position:relative;padding:5px;}
#img:hover i {
    display: inline;
}
#img .camera {
    position: absolute;
    text-align: center;
    top: 35px;
    left: 35px;
    font-size: 3em;
    border-radius: 50%;
}
.camera:hover {
    display: inline;
}
.camera {
    opacity: 0.8;
    display: none;
    cursor: pointer;
}

</style>

<script>
$(document).ready(function() {
        $("#fileUpload").on('change', function() {
          //Get count of selected files
          var countFiles = $(this)[0].files.length;
          var imgPath = $(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = $("#image-holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } 
        });
      });
</script>

<body>



<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content clearfix">
   <div class="Banner_list" >
   <label>Create</label>
    <span class="close">×</span>
    </div>
    <div>
        <form id="frm-add-provider" onsubmit="return false;" class="form-horizontal">
        <div class="content_list clearfix" id="img">
            <div class="col-sm-12 n1">
               <div class="col-sm-2"  >
                  
                  <div id="image-holder" style="margin-top:10px;">

                    <img src="<?php echo Yii::app()->request->baseUrl;?>" id="file_preview_1" style="width:100%;">
                    
                   
                    </div>
                    
                     <!-- <div id="wrapper" style="margin-top: 0px;">
                     <input id="fileUpload" name="fileUpload" multiple="multiple" type="file"  /> 
                     </div> -->
                      <i class="camera fa fa-camera icon-2x"></i> 
                     <div id="wrapper" style="margin-top: 0px;">
                  <input
                    type="file" id="fileUpload" name="fileUpload"
                    style="border-radius: 100%; position: absolute; width: 75%;
    height: 100px;
  top: 0px; opacity: 0">
 </div>
               </div>
               <div class="col-sm-10">
                    <label>Name</label>
                    <input type="text" style="width:100%" required class="form-control" name="providerName" id="providerName" >
            
                    <label>URL website</label>
                     <div class="input-group">
                          <span class="input-group-addon">http://</span>
                          <input style="border: solid 1px #ccc;  " class="form-control" id="WebsiteUrl" name="WebsiteUrl" type="text" value="">
                    </div>
          
           
                   
               </div>
               <div class="clearfix"></div>
               <hr style="margin-top:5px; margin-bottom:0px;">
               <div class="col-sm-2">
                   <label>Sub-Domain</label>
               </div>
                <div class="col-sm-10 addliast" style="padding-top: 5px;">
                  <label>https://dev.wintegrate.com/bookoke/</label>  <input type="text" style="width: 56%; float: right;" required class="form-control" name="websubmain" id="websubmain" >
                </div>
               <div class="clearfix"></div>
            <hr style="margin-top:5px; margin-bottom:0px;">
               <div class="col-sm-2">
                   <label>Contact Detail</label>
               </div>
               <div class="col-sm-5 addliast">
                   <label>Hotline</label>
                    <input type="number" class="form-control" name="providerPhone" id="providerPhone"  placeholder="Phone">
                    <label>Office phone</label>
                <input type="number" class="form-control" name="providerHPhone" id="providerHPhone" required >
               </div>
               <div class="col-sm-5 addliast">
                  <label>Email</label>
                    <input type="email" class="form-control" name="providerMail" id="providerMail" required >
                     <label>Address</label>
                    <input type="text" class="form-control" name="providerAddress" id="providerAddress" required > 
               </div>
                <div class="clearfix"></div>
              <hr style="margin-top:5px; margin-bottom:0px;">
               <div class="col-sm-2">
                   <label>Detail Location</label>
               </div>
               <div class="col-sm-5 addliast">
                     <label>Country</label>
                     <?php  $model = new Company(); ?>
                   <select class="form-control" name="providerCountry" id="providerCountry" 
                            onchange="Country()">
                        <option value="VN" >Viet Nam</option>
                        <?php 
                            foreach ($model->getCountry() as $k=>$v){ 
                        ?>
                        <option value="<?php echo $v['code'] ?>"><?php echo $v['country'] ?></option>
                     <?php } ?>
                    </select>
                <label>City</label>
                <div id="city" >
                    <select class="form-control" name="providerCity" id="providerCity">
                       
                            <?php 
                                $model = new Company();

                                foreach ($model->getCity() as $k=>$v){ 
                            ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['name_long'] ?></option>
                            <?php } ?>
                    </select>
                </div>
               </div>
               <div class="col-sm-5 addliast">
               <div id="state">
                  <label>State</label>
                   <select class="form-control" name="providerState" id="providerState">
                      
                        <?php 
                            $model = new Company();
                            foreach ($model->getState() as $k=>$v){ 
                        ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['name_long'] ?></option>
                     <?php } ?>
                    </select>
                  </div>
                    <label>ZIP code</label>
                <input type="number" class="form-control" name="providerZipcode" id="providerZipcode" required >
               </div>
                <div class="clearfix"></div>
                <hr style="margin-top:5px; margin-bottom:0px;">
               <div class="col-sm-2">
                   <label>Coordinates</label>
               </div>
               <div class="col-sm-5 addliast">
                   <label>X</label>
                    <input type="number" step="any" class="form-control" name="providerX" id="providerX" required >
                   
               </div>
               <div class="col-sm-5 addliast">
                  <label>Y</label>
                <input type="number" step="any" class="form-control" name="providerY" id="providerY" required >
               </div>
               <div style="text-align:right; padding:10px;padding: 20px;">
               <div class="clearfix"></div>
                <hr style="margin-top:10px; margin-bottom:10px;">
                <button id="save"  class="btn btn-success save">Save</button>
                <button type="button" id="cancelNewCustomer" style="background:#F1F5F7; color:#252C32; border-color:#F1F5F7; " class="btn btn-danger save">Cancel</button>
            </div>
            </div>
            
            
         

        </form>
    </div>
  </div>

</div>

 <?php 
   include "_jscity.php";
   //include "_jsstate.php";
 ?>
<!-- https://my.setmore.com/profile/#configure/company_details -->