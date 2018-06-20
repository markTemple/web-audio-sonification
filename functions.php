<?php

function wordwrap2($str, $cols, $cut, $html_tag) {
 $len=strlen($str);
 $wordlen = '';
 $result = '';
 $tag=0;
	 for ($i=0;$i<$len;$i++) {
	   $chr = substr($str,$i,1);
	   if ($chr=="<")
		 $tag++;
	   elseif ($chr==">")
		 $tag--;
	   elseif (!$tag && $chr==" ")
		 $wordlen=0;
	   elseif (!$tag)
		 $wordlen++;
	   if (!$tag && !($wordlen%$cols))
		 $chr .= $cut;
	   $result .= $chr;
	 }
$result = str_replace('<br></'.$html_tag.'><br>', '</'.$html_tag.'><br>', $result);
$result = str_replace('<br><'.$html_tag.'><br>', '<'.$html_tag.'><br>', $result);
return $result;
}

function is_odd( $int )
{
  return( $int & 1 );
}

function dump($value,$level=0)
{
  if ($level==-1)
  {
    $trans[' ']='&there4;';
    $trans["\t"]='&rArr;';
    $trans["\n"]='&para;;';
    $trans["\r"]='&lArr;';
    $trans["\0"]='&oplus;';
    return strtr(htmlspecialchars($value),$trans);
  }
  //if ($level==0) echo '<pre>';
  $type= gettype($value);
  echo $type;
  if ($type=='string')
  {
    echo '('.strlen($value).')';
    $value= dump($value,-1);
  }
  elseif ($type=='boolean') $value= ($value?'true':'false');
  elseif ($type=='object')
  {
    $props= get_class_vars(get_class($value));
    echo '('.count($props).') <u>'.get_class($value).'</u>';
    foreach($props as $key=>$val)
    {
      echo "\n".str_repeat("\t",$level+1).$key.' => ';
      dump($value->$key,$level+1);
    }
    $value= '';
  }
  elseif ($type=='array')
  {
    echo '('.count($value).')';
    foreach($value as $key=>$val)
    {
      echo "\n".str_repeat("\t",$level+1).dump($key,-1).' => ';
      dump($val,$level+1);
    }
    $value= '';
  }
  echo " <b>$value</b>";
//  if ($level==0) echo '</pre>';
}

function make_motif_array(){
$motif_array2 = array(
array(1,	'ATG',		'Start codon',			1,'Electric Snare', 40, 'Cr','C'),
array(4,	'TGA',		'Stop codon',			4,'Crash Cymbal 1',	49, 'Cr','H'),
array(5,	'TAA',		'Stop codon',			5,'Chinese Cymbal',	52, 'Ch','M'),
array(6,	'TAG',		'Stop codon',			6,'Ride Bell',		53, 'Rd','L')
);
return $motif_array2;
}

function identifyMotif($dna_seq, $motif_array){
	$found_motif = '';//the start or stop codon
	foreach($motif_array as $motif){
		$dna_len = strlen($dna_seq);
		$motif_len = strlen($motif['1']);
		for($bit_numb = 0; $bit_numb < $dna_len; $bit_numb++) {
			$bits_of_dna = substr($dna_seq, $bit_numb, $motif_len);
				if($bits_of_dna == $motif[1]){
				//$first_only++; not used anywhere!
				$bp = $bit_numb+1;
				$found_motif["$bp"] = array(
				'codon64_numb' =>	$motif[0],
				'codon' => 			$motif[1],
				'aa' => 			$motif[2],
				'aa_numb' => 		$motif[3],
				'note' => 			$motif[4],
				'note_numb' => 		$motif[5],
				'note_dot' => 		$motif[6],
				'note_1chr' => 		$motif[7],
				'dna_seq_numb' =>	$bit_numb+1,
				'len_bp2sonify' =>	$motif_len,
				'lastDash' =>		$bp-1,
				'printMotif' =>		$bp,
				'startNext' =>		$bp+$motif_len
				);
			}else{
			//nothing yet
			}
		}
}
return $found_motif;
}

function found_motif_strings($dna_seq, $motif_array){
	foreach($motif_array as $motif){
		$dna_len = strlen($dna_seq);
		$motif_len = strlen($motif['1']);
			for($bit_numb = 0; $bit_numb < $dna_len; $bit_numb++) {
			$str_start = '';
			$str_end = '';
			$bits_of_dna = substr($dna_seq, $bit_numb, $motif_len);
				if($bits_of_dna == $motif[1]){
					for ($x = 1; $x <= $bit_numb; $x ++) {
					$str_start .= '-';
					}
				$end = $dna_len - $motif_len - $bit_numb;
					for ($x = 1; $x <= $end; $x ++) {
						$str_end .= '-';
					}
				$bits_of_dna = '<b>'.$bits_of_dna.'</b>';
				$where_is = $str_start.$bits_of_dna.$str_end;
				$bit_numb_str = $bit_numb+1;
				$where_is_array[$bit_numb] = array("<b>{$motif['2']}</b> (<b>{$motif['1']}</b>) at bp position <b>$bit_numb_str</b>. Sonified as <b>{$motif['4']}</b>", $where_is);
				}else{
				//nothing yet
				}
			}
		unset($where_is);
	}
return $where_is_array;
}

function makeTextstrings($dna_seq){//deleted $textCapture

	$bpArray = array
	("G", "A", "T", "C");
	$G = str_replace($bpArray[0], "", "$dna_seq", $countG);
	$A = str_replace($bpArray[1], "", "$dna_seq", $countA);
	$T = str_replace($bpArray[2], "", "$dna_seq", $countT);
	$C = str_replace($bpArray[3], "", "$dna_seq", $countC);

//$text_strings['GATC_content']
	$text_strings['GATC_content'] = 'This DNA sequence contains <b>';
	$text_strings['GATC_content'] .= $countG.'G, ';
	$text_strings['GATC_content'] .= $countA.'A, ';
	$text_strings['GATC_content'] .= $countT.'T</b> and <b>';
	$text_strings['GATC_content'] .= $countC.'C';
	$text_strings['GATC_content'] .= '</b> nucleotides. ';

//$text_strings['seq_length']
	$text_strings['seq_length'] = 'The length of this sequence is <b>';
	$text_strings['seq_length'] .= strlen($dna_seq);
	$text_strings['seq_length'] .= '</b> bp. ';

//$text_strings['gc_ratio']
	if(($countG + $countC !== 0) and ($countA + $countT !== 0)){
		$text_strings['gc_ratio'] = 'The GC/AT ratio is <b>';
		$text_strings['gc_ratio'] .= round((("$countG"+"$countC")/("$countA"+"$countT")), 2);
		$text_strings['gc_ratio'] = $text_strings['gc_ratio'].'</b>. ';
	}
	else{
		$text_strings['gc_ratio']
		= 'The GC/AT ratio could not be calculated because either the GC or AT content is zero. ';
	}

//$text_strings['dna_seq']
	$text_strings['dna_seq'] = wraptxt($dna_seq, 66);

//$text_strings['key_of_audio']
	$text_strings['key_of_audio'] = 'The audio output from the sequence is in the Key of <b>';
	$text_strings['key_of_audio'] .= $_POST['key_of_audio'].'</b> ';

//$text_strings['scale']
    $text_strings['scale'] = 'and is played in the <b>';
		if($_POST['frameNum'] == '3bp'){
   		 	$text_strings['scale'] .= 'semitone scale </b>(other scales cannot be used when the DNA sequence is sonified using the "1 note to 3bp" algorithm since a 64 note range plus larger intervals leads to notes beyond the instrument ranges';
		}else{
   		 	$text_strings['scale'] .= str_replace("_", " ", $_POST['scale']);
    		$text_strings['scale'] .= '</b> scale. ';
		}

return $text_strings;
}

// function playMidi($MidiTrk){
// 	if (isset($MidiTrk)){
// 		$save_dir = './midi_class_v175/tmp/';
// 		srand((double)microtime()*1000000);
// 		$midi_ID = rand();
// 	 	$file = $save_dir."testMIDI{$midi_ID}.mid";
// 		require('./midi_class_v175/classes/midi.class.php');
// 		$midi = new Midi();
// 		$midi->importTxt($MidiTrk);
// 		$midi->saveMidFile($file);
// 		//$midi->playMidFile($file,1,1,0,$_POST['plug']);
// 	}
// return $midi_ID;
// }

function shorten($string, $str_wth_spaces, $cutpt, $add='... ') {
	$len = '(';
	$len .= strlen($string);
	$len .= 'bp)';
	if(strlen($str_wth_spaces) <= $cutpt) return $str_wth_spaces;

	if(strlen($str_wth_spaces) >= $str_wth_spaces){
	$str_wth_spaces = substr($str_wth_spaces, 0, $cutpt).$add.$len;
	}
return $str_wth_spaces;
}

//make dropdown items link Sonification algorithm START STOP
function makeLinkBoxStopStart($options, $selectOption, $default, $name, $id, $print_title){
	echo '<label for="'.$name.'">'.$print_title.'</label>';
	echo '<select name="'.$name.'" id="'.$id.'"';
	foreach($options as $optionVal){
		$value = $optionVal[0];
		$value_readable = $optionVal[1];
		$selected = '';
		if(isset($selectOption)){ // if option is selected then check (get re-posted)
			if($value == $selectOption ){
				$selected = 'selected';
			}else{}
		}
		else{
			if($value == $default){ // if not selected then use a default value
				$selected = 'selected';
			}else{}
		}
		echo '<option class="3" value="'.$value.'" '.$selected.'>'.$value_readable.'</option>';
	}
		echo '<option class="3bp" value="1note2_3bp">1 Note per 3 bps</option>';
		echo '<option class="1" value="no">1 Note per AA residue</option>';
		echo '<option class="1bp" value="no">1 Note per bp</option>';
		echo '<option class="2bp" value="no">1 Note per 2 bps</option>';
		echo '<option class="2bpx2" value="no">1 Note each pair 2 bps</option>';
	echo '</select>';
}

//make dropdown generic
function makeSelectBox($options, $selectOption, $default, $name, $id, $print_title){
	echo '<label for="'.$name.'">'.$print_title.'</label>';
	echo '<select name="'.$name.'" id="'.$id.'"'.'class="submitbutton" >';
	foreach($options as $optionVal){
		$value = $optionVal[0];
		$value_readable = $optionVal[1];
		$selected = '';
		if(isset($selectOption)){ // if option is selected then check (get re-posted)
			if($value == $selectOption ){
				$selected = 'selected';
			}else{}
		}
		else{
			if($value == $default){ // if not selected then use a default value
				$selected = 'selected';
			}else{}
		}
		echo '<option value="'.$value.'" '.$selected.'>'.$value_readable.'</option>';
	}
	echo '</select>';
}
//make instrument group dropdown only
function makeSelectBox_catagory($options, $selectOption, $default, $name, $id, $print_title){
	echo '<label for="'.$name.'">'.$print_title.'</label>';
	echo '<select name="'.$name.'" id="'.$id.'"';
	$numb = 0;
	foreach($options as $optionKey => $optionVal){//array in other format! not tt
		$selected = '';
		if(isset($selectOption)){ // if option is selected then check (get re-posted)
			if($numb == $selectOption ){
				$selected = 'selected';
			}else{}
		}
		else{
			if($numb == $default){ // if not selected then use a default value
				$selected = 'selected';
			}else{}
		}
		echo '<option value="'.$numb.'" '.$selected.'>'.$optionKey.'</option>';
		$numb ++;
	}
	echo '</select>';
}

//make instrument select pair to Instra group above dropdown only

function makeSelectBox_item($options, $selectOption, $default, $name, $id, $print_title){
	echo '<label for="'.$name.'">'.$print_title.'</label>';
	echo '<select name="'.$name.'" id="'.$id.'"';
	$numb = 0;
	foreach($options as $optionKey => $optionVal){//array in other format! not tt
		foreach($optionVal as $instrument_numb => $instrument){//array in other format! not tt
		$selected = '';
		if(isset($selectOption)){ // if option is selected then check (get re-posted)
			if($selectOption == $instrument_numb ){
				$selected = 'selected';
			}else{}
		}
		else{
			if($instrument_numb == $default){ // if not selected then use a default value
				$selected = 'selected';
			}else{}
		}
		echo '<option class="'.$numb.'" value="'.$instrument_numb.'" '.$selected.'>'.$instrument.'</option> ';
		}
		$numb ++;
	}
	echo '</select>';
}

// generic - more useful!!
function makeRadioBoxes($options, $selectOption, $default, $name){
	$inputType 	= 'radio';
	foreach($options as $optionVal){
		$value = $optionVal[0];
		$value_readable = $optionVal[1];
		$check = '';
		$bStart = '';
		$bEnd = '';
		//hack to allow for pipe in string (used to post many variables
		if($name == 'music_style'){
			(implode("", (explode('|', $value))));
			(implode("", (explode('|', $selectOption))));
			}

		if(isset($selectOption)){ // if option is selected then check (get re-posted)
			if($value == $selectOption ){
				$check = 'checked="checked"';
				$bStart = '<element class="radio_span">';
				$bEnd = ' </element>';
			}else{}
		}
		else{
			if($value == $default){ // if not selected then use a default value
				$check = 'checked="checked"';
				$bStart = '<element class="radio_span">';
				$bEnd = ' </element>';			}else{}
		}
    echo'<label class="highlight">';
		echo'<input type="'.$inputType.'" name="'.$name.'" value="'.$value.'" '.$check.' /> '.$bStart.$value_readable.$bEnd;
    echo'</label><br>';

  }
}

// function getTDcol(){
// $td = array(
// 	1 => '<td bgcolor="#CCFFCC">',
// 	2 => '<td bgcolor="#FFFFCC">',
// 	3 => '<td bgcolor="#EEEEEE">',
// 	4 => '<td bgcolor="#FFCCFF">');
// return 	$td;
// }

function adjustPlaynote($codon, $this_note){
	$time_adjust = str_replace("G", "+25|", $codon);
	$time_adjust = str_replace("A", "-25|", "$time_adjust");
	$time_adjust = str_replace("T", "-25|", "$time_adjust");
	$time_adjust = str_replace("C", "+25|", "$time_adjust");
	$time_adjust_array= explode('|',$time_adjust);
	$ta_sum = ($time_adjust_array[0] + $time_adjust_array[1] + $time_adjust_array[2]);
	$play_note_var = $this_note + $ta_sum;
return 	$play_note_var;
}


function makeCodonPlus($codon, $codon2note){
	foreach($codon as $rf_numb => $codon_array){
		foreach($codon_array as $c_numb => $c){
			switch ($_POST['frameNum']) {
				case '1':
					$position[1] = $c_numb*3+1;
				break;
				case '3':
					$position[1] = $c_numb*3+1;
					$position[2] = $c_numb*3+2;
					$position[3] = $c_numb*3+3;
				break;
				case '1bp':
					$position[1] = $c_numb*1+1;
				break;
				case '2bp':
					$position[1] = $c_numb*2+1;
				break;
				case '3bp':
					$position[1] = $c_numb*3+1;
				break;
				case '2bpx2':
					$position[1] = $c_numb*2+1;
					$position[2] = $c_numb*2+2;
				break;
			}
			$dna_seq_numb = $position["$rf_numb"];
			foreach($codon2note as $c2n_rf => $c2n_array){
				foreach($c2n_array as $c2n){
					if($c == $c2n['1']){
						if (($_POST['frameNum'] == '2bp') ||
							($_POST['frameNum'] == '2bpx2') ||
							($_POST['frameNum'] == '1bp')){
							$octave = '';
						}else{
// all codons motifs enter this if statement, 1, 3, 3bp              echo $_POST['frameNum'];
            if ($_POST['frameNum'] == '3'){
							switch ($c2n[5]) {
								case $c2n[5] <12: 	$octave 	= 0; break;
								case $c2n[5] <24: 	$octave 	= 1; break;
								case $c2n[5] <36: 	$octave 	= 2; break;
								case $c2n[5] <48: 	$octave 	= 3; break;
								case $c2n[5] <60: 	$octave 	= 4; break;
								case $c2n[5] <72: 	$octave 	= 5; break;
								case $c2n[5] <84: 	$octave 	= 6; break;
								case $c2n[5] <96: 	$octave 	= 7; break;
								default: 			$octave 	= 'x';
              }
            }
            if ($_POST['frameNum'] == '1'){
							switch ($c2n[5]) {
								case $c2n[5] <24: 	$octave 	= 1; break;
								case $c2n[5] <36: 	$octave 	= 2; break;
								case $c2n[5] <48: 	$octave 	= 3; break;
								case $c2n[5] <60: 	$octave 	= 4; break;
								case $c2n[5] <72: 	$octave 	= 5; break;
								case $c2n[5] <84: 	$octave 	= 6; break;
								case $c2n[5] <96: 	$octave 	= 7; break;
								case $c2n[5] <108: 	$octave 	= 8; break;
                case $c2n[5] <120: 	$octave 	= 9; break;
                default: 			$octave 	= 'x';
              }
            }
            if ($_POST['frameNum'] == '3bp'){
							switch ($c2n[5]) {
								case $c2n[5] <3: 	$octave 	= 0; break;
								case $c2n[5] <12: 	$octave 	= 1; break;
								case $c2n[5] <24: 	$octave 	= 2; break;
								case $c2n[5] <26: 	$octave 	= 3; break;
								case $c2n[5] <48: 	$octave 	= 4; break;
								case $c2n[5] <60: 	$octave 	= 5; break;
								case $c2n[5] <72: 	$octave 	= 6; break;
								case $c2n[5] <84: 	$octave 	= 7; break;
								default: 			$octave 	= 'x';
              }
            }

            }
            
					$array1["$rf_numb"]["$c_numb"] = array(
					'codon64_numb' =>	$c2n[0],
					'codon' => 			$c2n[1],
					'aa' => 			$c2n[2],
					'aa_numb' => 		$c2n[3],
					'note' => 			$c2n[4],
					'note_numb' => 		$c2n[5],
					'note_dot' => 		$c2n[6].$octave,
					'note_1chr' => 		$c2n[7],
					'dna_seq_numb' =>	$dna_seq_numb);

					}else{
				}
			}
		}
		}
	}
return $array1;
}


//push in motif_array????
function makeCodon2note($mididata, $seq2note_algorithm, $numb_of_RFs){
  $rf_numb_count = range(1, $numb_of_RFs);
	foreach($rf_numb_count as $rf_numb){

		// $low2high = getInstuRange($mididata["$rf_numb"]['instr_numb']);
		// $low2high = null;
		// if($low2high === null){

      // match table notes to canvas notes good for rfc
      $low2high = '24,100';
      if($_POST['frameNum'] == '3bp'){$low2high = '1,100';}

		// if($_POST['frameNum'] == '3bp'){$low2high = '36,127';}// otherwise 64 notes go higher that 127

		$low2high_string = explode(',',$low2high);
		$low_note = $low2high_string[0];

  //echo $low_note;
		// $k = $_POST['key2play'];
		// $low_note = $low_note + $k;//yes good

		$noteNumber_NoteName = midiNumb2note();

		$allNotes_from_low = array_slice($noteNumber_NoteName, $low_note, '127', $preserve_keys=true);

		$_POST['key_of_audio'] = $allNotes_from_low["$low_note"];

		$major = array(2, 2, 1, 2, 2, 2, 1);
		$natural_minor = array(2, 1, 2, 2, 1, 2, 2);
		$harmonic_minor = array(2, 1, 2, 2, 1, 3, 1);
		$melodic_minor = array(2, 1, 2, 2, 2, 2, 1);
		$major_pentatonic = array (2, 2, 3, 2, 3);
		$minor_pentatonic = array (3, 2, 2, 3, 2);
		$blues = array (3, 2, 1, 1, 3, 2);
		$semitone = array (1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
		$whole_notes = array (2, 2, 2, 2, 2, 2);
		$three_semitones = array (3, 3, 3, 3);


		if($_POST['frameNum'] == '3bp')// otherwise 64 notes go higher that 127
		{
      $intervals_whwwhww_12 = midiNoteScale($semitone);// only allow restricted note range

		}else{
			$intervals_whwwhww_12 = midiNoteScale($$_POST['scale']);
		}

		$scale_from_rootNote[] = array($low_note => $allNotes_from_low["$low_note"]);

		foreach($intervals_whwwhww_12 as $relative_interval_from_root){
			$magic_numb = $low_note + $relative_interval_from_root;

			foreach($allNotes_from_low as $midi_note_numb => $range){//$i is wrong

				if($magic_numb == $midi_note_numb){
				$scale_from_rootNote[] = array($midi_note_numb => $range);
				}
			}
		}
    unset($intervals_whwwhww_12);
    
		$codon2note["$rf_numb"] = $seq2note_algorithm();
		foreach($scale_from_rootNote as $i => $midi_numb2note){//$i starts on zero
			foreach($codon2note["$rf_numb"] as $i2 => $codon_array){//$i2 starts on zero also
				$hack = $i + 1;
				if($codon_array['3'] == $hack){
					$k = array_keys($midi_numb2note);
					$v = array_values($midi_numb2note);

					$codon2note["$rf_numb"]["$i2"][4] = $v[0];
					$codon2note["$rf_numb"]["$i2"][5] = $k[0];
					$len = strlen($v[0]);

					if($len === 1){
						$codon2note["$rf_numb"]["$i2"][6] = $v[0].'.';
					}else{
						$codon2note["$rf_numb"]["$i2"][6] = $v[0];
					}
					$arr1 = str_split($v[0]);
					$codon2note["$rf_numb"]["$i2"][7] = $arr1[0];
				}else{}
			}
		}	unset($scale_from_rootNote);
	}
return $codon2note;
}

function midiNoteScale($get_scale){
$octave_range = range(1, 10);
$scale = 0;//start scale here	 changed use to be 0 now 1
foreach($octave_range as $i => $toten){
	foreach($get_scale as $interval){
		//$scale_val = $scale;
		$scale = $scale + $interval;
		$scale_array[] = $scale;
	}
}
return $scale_array;
}

function make3frames($dna_seq){
	$reading_frame_1_string = chunk_split($dna_seq, 3, '|');
	$codon[1]= explode('|',$reading_frame_1_string);
	array_pop($codon[1]);

	$reading_frame_2_string = chunk_split(substr($dna_seq, 1), 3, '|');
	$codon[2]= explode('|',$reading_frame_2_string);
	array_pop($codon[2]);

	$reading_frame_3_string = chunk_split(substr($dna_seq, 2), 3, '|');
	$codon[3]= explode('|',$reading_frame_3_string);
	array_pop($codon[3]);

return $codon;
}

function make_2BPx2($dna_seq){
	$diBPstring = chunk_split($dna_seq, 2, '|');
	$di_bp[1]= explode('|',$diBPstring);
	array_pop($di_bp[1]);

	$diBPstring2 = chunk_split(substr($dna_seq, 1), 2, '|');
	$di_bp[2]= explode('|',$diBPstring2);
	array_pop($di_bp[2]);

return $di_bp;
}

function makeprotein($dna_seq){
	$protein_string = chunk_split($dna_seq, 3, '|');
	$protein[1]= explode('|',$protein_string);
	array_pop($protein[1]);
return $protein;
}

function make_2BP($dna_seq){
	$diBPstring = chunk_split($dna_seq, 2, '|');
	$di_bp[1]= explode('|',$diBPstring);
	array_pop($di_bp[1]);
return $di_bp;
}

function make_1BP($dna_seq){
	$monoBPstring = chunk_split($dna_seq, 1, '|');
	$mono_bp[1]= explode('|',$monoBPstring);
	array_pop($mono_bp[1]);
return $mono_bp;
}

function make_3BP($dna_seq){
	$triBPstring = chunk_split($dna_seq, 3, '|');
	$tri_bp[1]= explode('|',$triBPstring);
	array_pop($tri_bp[1]);
return $tri_bp;
}

function truncate_string($string, $max_length){
    if (strlen($string) > $max_length) {
         $string = substr($string,0,$max_length);
         $string .= '_sequence_length_exceeded_Max_1000_bp_';
    }
return $string;
}

// function makeMIDIheader($tracks, $chunks, $division, $tempo, $TrkEnd, $start_track){
// 	$Mfile = "Mfile ".$tracks." ".$chunks." ".$division."\n";
// 	$MidiTrk = $Mfile;
// 	$MidiTrk .= "MTrk\n";
// 	$MidiTrk .= $start_track." Tempo ".$tempo."\n";
// 	$MidiTrk .= $start_track." Meta Text \"".$_POST["DNAseq_name"]."\""."\n";
// 	$MidiTrk .= $TrkEnd." Meta TrkEnd"."\n";
// 	$MidiTrk .= "TrkEnd"."\n";
// return $MidiTrk;
// }
//
function makeRandomseq($len, $seq2note_algorithm){
$seq = '';
for($count = 1; $count <= $len; $count ++) {
	$ranCodons[] = (rand(1,64));
	}
$aa = $seq2note_algorithm();// $seq2note_algorithm
foreach($ranCodons as $codonNumb){
	foreach ($aa as $bb){
		if($bb['0'] == $codonNumb) {
			$seq .= $bb['1'];
		}
	}
}
return $seq;
}

function makeGATC(){
$s4 = '';
$GATC = array('G', 'A', 'T', 'C');
for ($count = 1; $count <= 6; $count ++) {
	foreach($GATC as $x => $nuc){
		for ($counter = 1; $counter <= 3; $counter ++) {
		$s4 .= $nuc;
		}
	}
}
return $s4;
}

function makeGATC1(){
$s16 = '';
$GATC = array('G', 'A', 'T', 'C');
	for($counter = 1; $counter <= 8; $counter ++) {
		foreach($GATC as $x => $nuc1){
			foreach($GATC as $x => $nuc2){
				$s16 .= $nuc1.$nuc2;
			}
		}
	}
return $s16;
}

function makeGATC2(){
$s64 = '';
$GATC = array('G', 'A', 'T', 'C');
	for($counter = 1; $counter <= 1; $counter ++) {
		foreach($GATC as $x => $nuc1){
			foreach($GATC as $x => $nuc2){
				foreach($GATC as $x => $nuc3){
					$s64 .= $nuc1.$nuc2.$nuc3;
				}
			}
		}
	}
return $s64;
}

function makeGCrich(){
$sGC = '';
$GATC = array('G', 'C');
	for($counter = 1; $counter <= 32; $counter ++) {
		foreach($GATC as $x => $nuc1){
			foreach($GATC as $x => $nuc2){
				$sGC .= $nuc1.$nuc2;
			}
		}
	}
return $sGC;
}

function makeATrich(){
$sAT  = '';
$GATC = array('A', 'T');
	for($counter = 1; $counter <= 32; $counter ++) {
		foreach($GATC as $x => $nuc1){
			foreach($GATC as $x => $nuc2){
				$sAT .= $nuc1.$nuc2;
			}
		}
	}
return $sAT;
}

function makeAlternatingAT_GC(){
$sGC = '';
$GC = array('G', 'C');
	for($counter = 1; $counter <= 8; $counter ++) {
		foreach($GC as $x => $nuc1){
			foreach($GC as $x => $nuc2){
				$sGC .= $nuc1.$nuc2;
			}
		}
	}
$AT = array('A', 'T');
$sAT = '';
	for($counter = 1; $counter <= 8; $counter ++) {
		foreach($AT as $x => $nuc1){
			foreach($AT as $x => $nuc2){
				$sAT .= $nuc1.$nuc2;
			}
		}
	}
return $sGC.$sAT.$sGC.$sAT;
}

function wraptxt($txt, $wraplen){
$txtWrap = wordwrap($txt, $wraplen, '<br>' ,TRUE);
return $txtWrap;
}

function show_array($a){
echo "<pre>";
print_r($a);
echo "</pre>";
}
