<?php $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerCssFile($baseUrl.'/css/book.css'); ?>
<?php $this->beginContent('//layouts/home'); ?>

<div id="page_book">
	<?php echo $content; ?>
</div><!-- content -->

<?php $this->endContent(); ?>