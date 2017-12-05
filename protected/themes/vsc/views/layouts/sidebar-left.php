<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <?php  $id_user = Yii::app()->user->getState('user_id');?>
  <!-- Sidebar user panel -->
  <div class="user-panel">
    
      <div class="pull-left image">
      <a href="<?php echo Yii::app()->baseUrl; ?>/itemsUsers/users/update/id/<?php echo $id_user; ?>">
        <img style="width: 45px; height: 45px;" src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/user2-160x160.png" class="img-circle" alt="User Image" />
        </a>
      </div>
      <div class="pull-left info">
        <p><a href="<?php echo Yii::app()->baseUrl; ?>/itemsUsers/users/update/id/<?php echo $id_user; ?>"><?php echo Yii::app()->user->user_name;?></a></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    
  </div>

  <!-- search form -->
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search..."/>
      <span class="input-group-btn">
        <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
      </span>
    </div>
  </form>
  <!-- /.search form -->

  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">

    <li class="header">MAIN</li>

    <li class="<?php if(Yii::app()->controller->id == 'admin'){ echo "active"; } ?>">
      <a href="<?php echo Yii::app()->baseUrl; ?>/admin/index">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
      </a>
    </li>

    <?php if( Yii::app()->user->getState('group_no') == 'superadmin' || Yii::app()->user->getState('group_no') == 'admin' ){ ?>
    <li class="treeview <?php if(isset(Yii::app()->controller->module->id) &&  Yii::app()->controller->module->id == 'itemsUsers'){ echo "active"; } ?> ">
      <a href="<?php echo Yii::app()->baseUrl; ?>/itemsUsers/Users/Admin">
        <i class="fa fa-user"></i>
        <span>Manager Users</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if(Yii::app()->controller->id == 'role'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsUsers/Role/Manager"><i class="fa fa-circle-o"></i>Role</a></li>
        <li class="<?php if(Yii::app()->controller->id == 'users'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsUsers/Users/Admin"><i class="fa fa-circle-o"></i> User</a></li>
        <li class="<?php if(Yii::app()->controller->id == 'group'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsUsers/Group/Admin"><i class="fa fa-circle-o"></i>Group</a></li>
        <li class="<?php if(Yii::app()->controller->id == 'gpHistoryLogin'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsUsers/GpHistoryLogin/Admin"><i class="fa fa-circle-o"></i>History login</a></li>
      </ul>
    </li>
    <?php } ?>

    <li class="treeview <?php if(isset(Yii::app()->controller->module->id) && Yii::app()->controller->module->id == 'itemsCustomers'){ echo "active"; } ?>">
      <a href="">
        <i class="fa fa-users"></i>
        <span>Manager Customer</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
            <li class="<?php if(Yii::app()->controller->id == 'customer'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsCustomers/Customer/Admin"><i class="fa fa-circle-o"></i>Customers</a></li>
            <li class="<?php if(Yii::app()->controller->id == 'medicineAlert'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsCustomers/MedicineAlert/Admin"><i class="fa fa-circle-o"></i>Medicine Alert</a></li>
            <li class="<?php if(Yii::app()->controller->id == 'questionQuick'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsQuestionQuick/QuestionQuick/Admin"><i class="fa fa-circle-o"></i>Question quick</a></li>
        </ul>
    </li>

    <li class="treeview <?php if(isset(Yii::app()->controller->module->id) &&  Yii::app()->controller->module->id == 'itemsService'){ echo "active"; } ?>">
      <a href="#">
        <i class="glyphicon glyphicon-wrench"></i>
        <span>Manager Services</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if(Yii::app()->controller->id == 'csServiceType'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsService/CsServiceType/Admin"><i class="fa fa-circle-o"></i>Service Type</a></li>
        <li class="<?php if(Yii::app()->controller->id == 'csService'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsService/CsService/Admin"><i class="fa fa-circle-o"></i>Service</a></li>
      </ul>
    <li>

    <li class="treeview <?php if(isset(Yii::app()->controller->module->id) &&  Yii::app()->controller->module->id == 'itemsProducts'){ echo "active"; } ?>">
      <a href="#">
        <i class="fa fa-cubes"></i>
        <span>Manager Products</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if(Yii::app()->controller->id == 'product'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsProducts/Product/Admin"><i class="fa fa-circle-o"></i>Products</a></li>
        <li class="<?php if(Yii::app()->controller->id == 'productImage'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsProducts/ProductImage/Admin"><i class="fa fa-circle-o"></i>Images</a></li>
        <li class="<?php if(Yii::app()->controller->id == 'productLine'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsProducts/ProductLine/Admin"><i class="fa fa-circle-o"></i>Products Line</a></li>
        <li class="<?php if(Yii::app()->controller->id == 'productType'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsProducts/ProductType/Admin"><i class="fa fa-circle-o"></i>Products Type</a></li>
      </ul>
    <li>


    <li class="<?php if(isset(Yii::app()->controller->module->id) &&  Yii::app()->controller->module->id == 'itemsSales'){ echo "active"; } ?>">
      <a href="<?php echo Yii::app()->baseUrl; ?>/itemsSales/order/View">
        <i class="fa fa-shopping-basket"></i>
        <span>Manager Order</span>
        <span class="label label-primary pull-right">0</span>
      </a>
    </li>

    <li class="treeview <?php if(isset(Yii::app()->controller->module->id) && Yii::app()->controller->module->id == 'itemsPost'){ echo "active"; } ?>">

      <a href="#">
        <i class="fa fa-newspaper-o" ></i>
        <span>Manager Post</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>

      <ul class="treeview-menu">

        <li class="<?php if(Yii::app()->controller->id == 'pInfrastructure' || Yii::app()->controller->id == 'pInfrastructureType' || Yii::app()->controller->id == 'pImagesType' ){ echo "active"; } ?>">

          <a href="#"><i class="fa fa-circle-o"></i>About<i class="fa fa-angle-left pull-right"></i></a>
          
          <ul class="treeview-menu">
            <li class="<?php if(Yii::app()->controller->id == 'pInfrastructure'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsPost/PInfrastructure/Admin"><i class="fa fa-circle-o"></i>Instructions</a></li>
            <li class="<?php if(Yii::app()->controller->id == 'pInfrastructureType'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsPost/PInfrastructureType/Admin"><i class="fa fa-circle-o"></i>Instructions Type</a></li>
            <li class="<?php if(Yii::app()->controller->id == 'pImagesType'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsPost/pImagesType/Admin"><i class="fa fa-circle-o"></i>Images Type</a></li>
          </ul>

        </li>

        <li class="<?php if(Yii::app()->controller->id == 'pImages'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsPost/pImages/Admin"><i class="fa fa-circle-o"></i>Images</a></li>
        
        <li class="<?php if(Yii::app()->controller->id == 'service'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsPost/service/Admin"><i class="fa fa-circle-o"></i>Service</a></li>

         <li class="<?php if(Yii::app()->controller->id == 'news'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsPost/news/Admin"><i class="fa fa-circle-o"></i>News</a></li>

        <li class="<?php if(Yii::app()->controller->id == 'newsLine'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsPost/NewsLine/Admin"><i class="fa fa-circle-o"></i>News Line</a></li>

        <li class="<?php if(Yii::app()->controller->id == 'promotion'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsPost/promotion/Admin"><i class="fa fa-circle-o"></i>Promotion</a></li>

        <li class="<?php if(Yii::app()->controller->id == 'faq'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsPost/Faq/Admin"><i class="fa fa-circle-o"></i>FAQ</a></li>
      
        <li class="<?php if(Yii::app()->controller->id == 'newsType'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsPost/tags/Admin"><i class="fa fa-circle-o"></i>Tags</a></li>

        <li class="<?php if(Yii::app()->controller->id == 'recruitment'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsPost/Recruitment/Admin"><i class="fa fa-circle-o"></i>Recruitment</a></li>

        <li class="<?php if(Yii::app()->controller->id == 'comments'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsPost/Comments/Admin"><i class="fa fa-circle-o"></i>Comments</a></li>
        <li class="<?php if(Yii::app()->controller->id == 'comments'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsPost/PReviewCustomer/Admin"><i class="fa fa-circle-o"></i>Review Customer</a></li>

      </ul>
    <li>

    <li class="treeview <?php if(isset(Yii::app()->controller->module->id) &&  Yii::app()->controller->module->id == 'itemsContact'){ echo "active"; } ?>">
      <a href="#">
        <i class="fa fa-comment-o"></i>
        <span>Contact</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if(Yii::app()->controller->id == 'product'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsContact/contact/Admin"><i class="fa fa-circle-o"></i>Feedback Mail</a></li>
        <li class="<?php if(Yii::app()->controller->id == 'productImage'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsEmail/email/Admin"><i class="fa fa-circle-o"></i>Send Questions </a></li>
      </ul>
    <li>
    
    <li class="treeview <?php if(isset(Yii::app()->controller->module->id) &&  Yii::app()->controller->module->id == 'itemsLocation'){ echo "active"; } ?>">
      <a href="#">
        <i class="fa fa-map-marker"></i>
        <span>Manager Location</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if(Yii::app()->controller->id == 'product'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsLocation/CsCity/Admin"><i class="fa fa-circle-o"></i>City</a></li>
        <li class="<?php if(Yii::app()->controller->id == 'productImage'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsLocation/CsState/Admin"><i class="fa fa-circle-o"></i>State</a></li>
        <li class="<?php if(Yii::app()->controller->id == 'productLine'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsLocation/CsCountry/Admin"><i class="fa fa-circle-o"></i>Country</a></li>
      </ul>
    <li>

    <li class="<?php if(isset(Yii::app()->controller->module->id) && Yii::app()->controller->module->id == 'itemsSeo'){ echo "active"; } ?>">
      <a href="<?php echo Yii::app()->baseUrl; ?>/itemsSeo/SeoData/Admin">
        <i class="fa fa-line-chart" aria-hidden="true"></i>
        <span>Manager SEO</span>
      </a>
    </li>


    <li class="header">Setting</li>

    <li class="<?php if(Yii::app()->controller->id == 'branch'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsBranch/branch/Admin"><i class="fa fa-home" aria-hidden="true"></i>Branch</a></li>
    <li class="<?php if(Yii::app()->controller->id == 'ipRequest'){ echo "active"; } ?>"><a href="<?php echo Yii::app()->baseUrl; ?>/itemsSetting/IpRequest/Admin"><i class="fa fa-map-signs" aria-hidden="true"></i>Ip Request</a></li>



  </ul>
</section>


<script>
/* Only allow type number on input */
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
        