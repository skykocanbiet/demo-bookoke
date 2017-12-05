<div class="sidebar-nav navbar-collapse">
    <?php
        $group_no = Yii::app()->user->getState('group_no');
        $this->widget('zii.widgets.CMenu',array(
            'encodeLabel'       => false,
            'activateParents'   => true,
            'htmlOptions'       => array(
                'class' => 'nav',
                'id'    => 'side-menu',
            ),
            'items'             => array(
                /* DASHBOARD */
                array(  'label'             => '<i class="icon_left_sidebar fa fa-dashboard fa-fw"></i> Dashboard',
                        'url'               => array('/site/index'),
                        'activateParents'   => true
                ),

                /* MANAGER USER */
                array(  'label'             => '<span class="icon_left_sidebar glyphicon glyphicon-user" aria-hidden="true"></span> Manager Users <span class="fa arrow"></span>',
                        'url'               =>  array('/itemsUsers/Role/Manager'),
                        'visible'           => $group_no=='admin' || $group_no=='superadmin',
                        'activateParents'   => true,
                        'submenuOptions'    => array('class' => 'nav nav-second-level'),
                        'items'             => array(
                                                    array(  'label' => 'Role',   
                                                            'url' => array('/itemsUsers/Role/Manager'),
                                                    ),
                                                    array(  'label' => 'Users',   
                                                            'url' => array('/itemsUsers/Users/Admin'),
                                                    ),
                                                    array(  'label' => 'Group',   
                                                            'url' => array('/itemsUsers/Group/Admin'),
                                                    ),
													array(  'label' => 'View history login',
                                                            'url' => array('/itemsUsers/GpHistoryLogin/Admin'),
                                                    ),
                                                    
                                                    
                        ),
                        
                ),

                /* MANAGER CUSTOMER */
                array(  'label'             => '<i class="fa fa-users" aria-hidden="true"></i> Manager Patients <span class="fa arrow"></span>',
                    'url'               => array('/itemsUsers/Role/Manager'),
                    'visible'           => $group_no=='admin' || $group_no=='superadmin' || $group_no == 'dentist',
                    'activateParents'   => true,
                    'submenuOptions'    => array('class' => 'nav nav-second-level'),
                    'items'             => array(
                        array(  'label' => 'Create patient ',
                            'url' => array('/itemsCustomers/Customer/create'),
                        ),
                        array(  'label' => 'View information patient',
                            'url' => array('/itemsCustomers/Customer/Admin'),
                        ), 						
						array(  'label' => 'View medicine alert',
                            'url' => array('/itemsCustomers/MedicineAlert/Admin'),
                        ),
						array(  'label' => 'Question quick',
                            'url' => array('/itemsQuestionQuick/QuestionQuick/Admin'),
                        ),
                    ),
                ),

                /* MANAGER SCHEDULE */
                array(  'label'             => '<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Manager Schedule <span class="fa arrow"></span>',
                    'url'               => array('#'),
                    'visible'           => $group_no=='admin' || $group_no=='superadmin' || $group_no == 'dentist' || $group_no== 'receptionists',
                    'activateParents'   => true,
                    'submenuOptions'    => array('class' => 'nav nav-second-level'),
                    'items'             => array(
                        /*array(  'label' => 'Create Schedule ',
                            'url' => array('/itemsUsers/Role/Manager'),
                        ),
                        array(  'label' => 'View Schedule',
                            'url' => array('/itemsUsers/Users/Admin'),
                        ),			*/			
                    ),
                ),

                /* MANAGER SERVICE */
                array(  'label'             => '<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Manager Service <span class="fa arrow"></span>',
                    'url'               => array('/itemsService/CsServiceType/Admin'),
                    'visible'           => $group_no=='admin' || $group_no=='superadmin' || $group_no == 'dentist' || $group_no== 'receptionists' || $group_no== 'itsupport',
                    'activateParents'   => true,
                    'submenuOptions'    => array('class' => 'nav nav-second-level'),
                    'items'             => array(
                        array(  'label' => 'Service Type',
                            'url' => array('/itemsService/CsServiceType/Admin'),
                        ),
                        array(  'label' => 'Service',
                            'url' => array('/itemsService/CsService/Admin'),
                        ),
                    ),
                ),
                 /* MANAGER LOCATION */
                array(  'label'             => '<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Manager Location <span class="fa arrow"></span>',
                    'url'               => array('/itemsLocation/CsCity/Admin'),
                    'visible'           => $group_no=='admin' || $group_no=='superadmin' || $group_no == 'dentist' || $group_no== 'receptionists',
                    'activateParents'   => true,
                    'submenuOptions'    => array('class' => 'nav nav-second-level'),
                    'items'             => array(
                        array(  'label' => 'City',
                            'url' => array('/itemsLocation/CsCity/Admin'),
                        ),
                        array(  'label' => 'State',
                            'url' => array('/itemsLocation/CsState/Admin'),
                        ),
                         array(  'label' => 'Country',
                            'url' => array('/itemsLocation/CsCountry/Admin'),
                        ),
                    ),
                ),
                /* MANAGER PRODUCTS */
                array(  'label'             => '<span class="glyphicon glyphicon-gift" aria-hidden="true"></span> Manager Products <span class="fa arrow"></span>',
                    'url'               => array(''),
                    'visible'           => $group_no=='admin' || $group_no=='superadmin' || $group_no == 'dentist' || $group_no== 'receptionists' || $group_no== 'itsupport',
                    'activateParents'   => true,
                    'submenuOptions'    => array('class' => 'nav nav-second-level'),
                    'items'             => array(
                        array(  'label' => 'Products',
                            'url' => array('/itemsProducts/Product/Admin'),
                        ),
                         array(  'label' => 'Products Image',
                            'url' => array('/itemsProducts/ProductImage/Admin'),
                        ),
                        array(  'label' => 'Products Line',
                            'url' => array('/itemsProducts/ProductLine/Admin'),
                        ),
                         array(  'label' => 'Products Type',
                            'url' => array('/itemsProducts/ProductType/Admin'),
                        ),
                    ),
                ),
                /* MANAGER POST */
				array(  'label'             => '<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Manager Posts <span class="fa arrow"></span>',
                    'url'               => array('/itemsPost/news/Admin'),
                    'visible'           => $group_no=='admin' || $group_no=='superadmin' || $group_no == 'dentist' || $group_no== 'receptionists' || $group_no== 'itsupport',
                    'activateParents'   => true,
                    'submenuOptions'    => array('class' => 'nav nav-second-level'),
                    'items'             => array(
						// array(  'label' => 'About',
      //                       'url' => array('/itemsPost/about/update/id/1'),
      //                   ),
						array(  'label' => 'Promotion',
                            'url' => array('/itemsPost/promotion/Admin'),
                        ),
						array(  'label' => 'Service',
                            'url' => array('/itemsPost/service/Admin'),
                        ),
						array(  'label' => 'Prices',
                            'url' => array('/itemsPost/prices/Admin'),
                        ),
                        array(  'label' => 'News',
                            'url' => array('/itemsPost/news/Admin'),
                        ),
                        array(  'label' => 'News Line',
                            'url' => array('/itemsPost/NewsLine/Admin'),
                        ),
                        array(  'label' => 'News Type',
                            'url' => array('/itemsPost/PNewsType/Admin'),
                        ),
                        array(  'label' => 'Tags',
                            'url' => array('/itemsPost/tags/Admin'),
                        ),
						array(  'label' => 'Recruitment',
                            'url' => array('/itemsPost/Recruitment/Admin'),
                        ),
						array(  'label' => 'Comments',
                            'url' => array('/itemsPost/Comments/Admin'),
                        ),
                        array(  'label' => 'Review Customer',
                            'url' => array('/itemsPost/Comments/Admin'),
                        ),
                        
						
						
                        
                    ),
                ),
                
				
				/* MANAGER BRANCH */
                array(  'label'             => '<i class="glyphicon glyphicon-grain"></i> Manager Branch',
                    'url'               => array('/itemsBranch/branch/Admin'),
                    'activateParents'   => true
                ),
				
				/* MANAGER SETTING */    
                array(  'label'             => '<i class="fa fa-cog" aria-hidden="true"></i> Manager Setting <span class="fa arrow"></span>',
                    'url'               => array('/itemsSetting/IpRequest/Admin'),
                    'visible'           => $group_no=='admin' || $group_no=='superadmin' || $group_no == 'dentist',
                    'activateParents'   => true,
                    'submenuOptions'    => array('class' => 'nav nav-second-level'),
                    'items'             => array(
                        array(  'label' => 'Ip Request ',
                            'url' => array('/itemsSetting/IpRequest/Admin'),
                        ),
                       
                    ),
                ),
                /* MANAGER FAQ*/
                array(  'label'             => '<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Manager FAQ <span class="fa arrow"></span>',
                    'url'               => array(''),
                    'visible'           => $group_no=='admin' || $group_no=='superadmin' || $group_no == 'dentist' || $group_no== 'receptionists' || $group_no== 'itsupport' ,
                    'activateParents'   => true,
                    'submenuOptions'    => array('class' => 'nav nav-second-level'),
                    'items'             => array(
                        array(  'label' => 'FAQ',
                            'url' => array('/itemsFAQ/faq/Admin'),
                        ),
                         array(  'label' => 'FAQ Line',
                            'url' => array('/itemsFAQ/faqline/Admin'),
                        ),
                        array(  'label' => 'FAQ Type',
                            'url' => array('/itemsFAQ/faqtype/Admin'),
                        ),
                    ),
                ),
                /* MANAGER CONTACT */
                array(  'label'             => '<i class="fa fa-comment-o"></i> Contact',
                        'url'               => array('/itemsContact/contact/Admin'),
                        'activateParents'   => true
                ),
                /* MANAGER EMAIL */
                 array(  'label'             => '<i class="fa fa-envelope"></i> Email',
                        'url'               => array('/itemsEmail/email/Admin'),
                        'activateParents'   => true
                ),
				
            ),
        ));
     ?>
</div>
<!-- /.sidebar-collapse -->

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
        