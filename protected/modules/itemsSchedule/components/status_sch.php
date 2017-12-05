<?php
/**
* 
*/
class status_sch 
{
	static function getStatusColor($status)
	{
		$col = '';
		switch ($status) {
			case '1':		// lịch mới
				$col = '#59b35a';
				break;
			case '2':		// đã đến
				$col = '#3bb3a8';
				break;
			case '3':		// vào khám
				$col = '#0864aa';
				break;
			case '4':		// hoàn tất
				$col = '#66869d';
				break;
			case '5':		// bỏ về
				$col = '#a08264';
				break;
			case '-1':		// Hủy hẹn
				$col = '#dbbd5a';
				break;
			case '-2':		//Không đến
				$col = '#965050';
				break;
			case '0':		//Không làm việc
				$col = '#b4b4b4';
				break;
			
			default:
				$col = '#b4b4b4';
				break;
		}
		return $col;
	}
}