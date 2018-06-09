<?php
if( ($_POST['stopstart'] == 'silent') and ($dna_seq_numb <=3)){
	$STOP_count = 1;
}
if(('TAA' == $codon) or ('TGA' == $codon) or ('TAG' == $codon)){
	$STOP_count = 	1;
	$START_count = 	0;
	$codon_type = 	'STOP';
	$on_vol = 		'10';//highlight first STOP codon as red
	$off_vol = 		'80';
	$frame_note_data["$rf_numb"]["$c_numb"]['STOP_count']       = 	$STOP_count;
	$frame_note_data["$rf_numb"]["$c_numb"]['START_count']      = 	$START_count;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_type']       = 	$codon_type;
	$frame_note_data["$rf_numb"]["$c_numb"]['on_vol']           = 	$on_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['off_vol']          = 	$off_vol;
        $frame_note_data["$rf_numb"]["$c_numb"]['off_vol']          =   $off_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_formated']   =
        '<font color="#C64521">'.$codon.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_formated']    =
        '<font color="#C64521">'.$note_dot.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_1letter'] = 	'<font color="#C64521">'.'.'.'</font>';
}
elseif('ATG' == $codon){
	$STOP_count = 	0;
	$START_count = 	1;
	$codon_type = 	'START';
	$on_vol = 		'127';
	$off_vol = 		'80';
	$frame_note_data["$rf_numb"]["$c_numb"]['STOP_count'] = 	$STOP_count;
	$frame_note_data["$rf_numb"]["$c_numb"]['START_count'] = 	$START_count;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_type'] = 	$codon_type;
	$frame_note_data["$rf_numb"]["$c_numb"]['on_vol'] = 		$on_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['off_vol'] = 		$off_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_formated'] =	'<font color="#3CB371">'.$codon.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_formated'] = 	'<font color="#3CB371">'.$note_dot.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_1letter'] = 	'<font color="#3CB371">'.substr($note_dot,0,1).'</font>';
}
elseif($STOP_count == 1){
	$codon_type = 	'passed STOP';
	$on_vol = 		'10';
	$off_vol = 		'80';
	$frame_note_data["$rf_numb"]["$c_numb"]['STOP_count'] = 	$STOP_count;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_type'] = 	$codon_type;
	$frame_note_data["$rf_numb"]["$c_numb"]['on_vol'] = 		$on_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['off_vol'] = 		$off_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_formated'] =
        '<font color="#C64521">'.$codon.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_formated'] =
        '<font color="#C64521">'.$note_dot.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_1letter'] = 	'<font color="#C64521">'.'.'.'</font>';
}
elseif($START_count == 1){
	$codon_type = 	'passed START';
	$on_vol = 		'127';
	$off_vol = 		'80';
	$frame_note_data["$rf_numb"]["$c_numb"]['START_count'] = 	$START_count;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_type'] = 	$codon_type;
	$frame_note_data["$rf_numb"]["$c_numb"]['on_vol'] = 		$on_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['off_vol'] = 		$off_vol;
	$frame_note_data["$rf_numb"]["$c_numb"]['codon_formated'] =
        '<font color="#3CB371">'.$codon.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_formated'] =
        '<font color="#3CB371">'.$note_dot.'</font>'.'|';
	$frame_note_data["$rf_numb"]["$c_numb"]['note_1letter'] = 	'<font color="#3CB371">'.substr($note_dot,0,1).'</font>';
}
?>
