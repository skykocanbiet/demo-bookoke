<?php
return array(


    //Set id agent of cs
    'id_agent' => '1',

    //Set id agent of cs
    'agent_no' => 'website_nhakhoa2000',

    //Set id agent of cs
    'agent_name' => 'Website Nha khoa 2000',
    
    //Key code of agent
    'key_pass_code'  =>  'b26c204f6634d',

    //Security code of agent
    'agent_sec_code' => 'c80fc4f4aa58e65277f3756f3b207806', 

    // default password customer
    'member_unit_point'      =>  '50000',

	//Group User
    'id_group_admin' => 1,
    'id_group_subadmin' => 2,
    'id_group_dentist' => 3,// bac si
    'id_group_receptionist' => 4, // tiep tan
    'id_group_customer_service' => 5,// cham soc khach hàng
    'id_group_accountant' => 8, // ke toan
    'id_group_assistant'=>9,// tro thu


    'id_company' => '216',
    'id_branch' => 13,
    'code_company'=> 'DEMO',
    'subdomain'   => 'demo',
    'password_default'=>"callnex2017",
    
    //Group services
    'id_service_exam' => 1,
    'id_service_exam' => '1',

    //Lines per page in clients
    'lpp_clients' => 10,
    
    'type' => array(
        'active' => 1,
        'gateway_faststart' => 1,
        'gateway_inactive' => 4,
        'recognize_login_ani' => 16,
        'pin_source' => 32,
        'gateway_SIP' =>64,
        'codec_audio' => 512,
        'charge_incoming' => 1024,
        'gateway_send_remote_id' => 4096,
        'codec_video' => 131072,
        'do_not_generate_ringback' => 262144,
        'record_call' => 524288,
        'codec_fax' => 1048576,
    ),
	'id_group_dentist' => '3',
);
?>