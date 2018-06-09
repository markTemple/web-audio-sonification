<?php
if(('TAA' == $codon) or ('TGA' == $codon) or ('TAG' == $codon)){
	$STOP_count = 	1;
	$START_count = 	0;
	$codon_type = 	'STOP';
	$on_vol = 		'4';//highlight first STOP codon as red
	$off_vol = 		'1';
	$frame_note_data["$rf_numb"]["$c_numb"]['STOP_count']       = 	$STOP_count;
	$frame_note_data["$rf_numb"]["$c_numb"]['START_count']      = 	$START_count;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_type']       = 	$codon_type;
	$frame_note_data["$rf_numb"]["$c_numb"]['on_vol']           = 	$on_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['off_vol']          = 	$off_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_formated']   =	'<font color="#C64521">'.$codon.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_formated']    = 	'<font color="#C64521">'.$note_dot.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_1letter'] = 	'<font color="#C64521">'.'.'.'</font>';//added 2017
}
elseif('ATG' == $codon){
	$STOP_count = 	0;
	$START_count = 	1;
	$codon_type = 	'START';
	$on_vol = 		'127';
	$off_vol = 		'2';
	$frame_note_data["$rf_numb"]["$c_numb"]['STOP_count'] = 	$STOP_count;
	$frame_note_data["$rf_numb"]["$c_numb"]['START_count'] = 	$START_count;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_type'] = 	$codon_type;
	$frame_note_data["$rf_numb"]["$c_numb"]['on_vol'] = 		$on_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['off_vol'] = 		$off_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_formated'] =	'<font color="#3CB371">'.$codon.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_formated'] = 	'<font color="#3CB371">'.$note_dot.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_1letter'] = 	'<font color="#3CB371">'.substr($note_dot,0,1).'</font>';
}
elseif(($STOP_count >=1) and ($STOP_count <= 9)){
	$STOP_count		++;
	$codon_type = 	'passed STOP';
	$on_vol = 		'3';
	$frame_note_data["$rf_numb"]["$c_numb"]['STOP_count'] = 	$STOP_count;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_type'] = 	$codon_type;
	$frame_note_data["$rf_numb"]["$c_numb"]['on_vol'] = 		$on_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['off_vol'] = 		$off_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_formated'] =	'<font color="#C64521">'.$codon.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_formated'] = 	'<font color="#C64521">'.$note_dot.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_1letter'] = 	'<font color="#C64521">'.'.'.'</font>';
}
elseif(($START_count >=1) and ($START_count <= 9)){
	$START_count	++;
	$codon_type = 	'passed START';
	$on_vol = 		'127';
	$off_vol = 		'81';
	$frame_note_data["$rf_numb"]["$c_numb"]['START_count'] = 	$START_count;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_type'] = 	$codon_type;
	$frame_note_data["$rf_numb"]["$c_numb"]['on_vol'] = 		$on_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['off_vol'] = 		$off_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_formated'] =	'<font color="#3CB371">'.$codon.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_formated'] = 	'<font color="#3CB371">'.$note_dot.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_1letter'] = 	'<font color="#3CB371">'.substr($note_dot,0,1).'</font>';
}
?>
