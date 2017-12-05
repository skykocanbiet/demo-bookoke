<style type="text/css">
	.error-page > .headline{
		font-size: 40px;
	}
	.error-page > .error-content > h3{
		color: #d8d8d8;
	}
</style>

<div class="error-page">
<h2 class="headline text-yellow">Error <?php echo $code; ?></h2>
<div class="error-content">
<h3><i class="fa fa-warning text-yellow"></i> <?php echo CHtml::encode($message); ?></h3>
<p style="color: #d8d8d8;font-style: 36px;">Page not found!</p>
<p style="color: #bebebe;">
  We could not find the page you were looking for.
  Meanwhile, you may <a href='http://elitedental.bookoke.com/itemsDashBoard/DashBoardBusiness/index'>return to dashboard</a> or try using the search form.
</p>
<form class='search-form'>
  <div class='input-group'>
    <input type="text" name="search" class='form-control' placeholder="Search"/>
    <div class="input-group-btn">
      <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
    </div>
  </div><!-- /.input-group -->
</form>
</div><!-- /.error-content -->
</div><!-- /.error-page -->


<!-- 
<?php

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div> -->