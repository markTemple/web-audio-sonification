<?php
//tempo fudge for MIDI.js
	switch ($track_header['tempo']){
        case  10000000:
        $canvas_tempo = 4;
        break;
        case  7500000:
        $canvas_tempo = 2;
        break;
        case  500000:
        $canvas_tempo = 1;
        break;
        case  400000:
        $canvas_tempo = .5;
        break;
        case  300000:
        $canvas_tempo = .25;
        break;
    }

	$timeBetweenFrames = 160*($canvas_tempo);
	$this2next = ($track_header['this2next'])*$canvas_tempo;

foreach($codon_plus_array2 as $rf_numb => $array){
	$instr_numb = 	$mididata["$rf_numb"]['instr_numb'];
	$rf = 			$mididata["$rf_numb"]['reading_frame'];
	$advance = 		$mididata["$rf_numb"]['advance'];
	$start_track = 		$track_header['start_track'];
	$on_vol = 			$track_header['on_vol'];
	$off_vol = 			$track_header['off_vol'];
	$duration = 		$track_header['duration'];//121
	//$this2next = 		$track_header['this2next'];
	$tempo = 			$track_header['tempo'];
	$STOP_count = 	0;
	$START_count = 	0;
	$remember_this_rf_numb = $rf_numb;
	if($rf_numb === 0){
		$on_vol = 			'127';
		$off_vol = 			'80';	//was 0 changed NOV 2016
	}
	foreach($array as $c_numb => $codon_data_arrays){
		$codon64_numb = 	$codon_data_arrays['codon64_numb'];
		$codon = 			$codon_data_arrays['codon'];
		$aa = 				$codon_data_arrays['aa'];
		$aa_numb = 			$codon_data_arrays['aa_numb'];
		$note = 			$codon_data_arrays['note'];
		$note_numb = 		$codon_data_arrays['note_numb'];
		$note_dot = 		$codon_data_arrays['note_dot'];
		$note_1chr = 		$codon_data_arrays['note_1chr'];
		$dna_seq_numb =		$codon_data_arrays['dna_seq_numb'];

		$RFs1or2or3 = range(1, $numb_of_RFs);
			foreach($RFs1or2or3 as $rf){
				$which_c_numb = (($dna_seq_numb-$rf)/$len_bp2sonify);
					if(is_int($which_c_numb)){
						$theCalc_c_numb = $which_c_numb; // determine which c_numb the bp is in
						$theCalc_rf = $rf; // determine which rf the bp is in
					}
			}
		$frame_note_data["$rf_numb"]["$c_numb"]['calculated rf'] = 		$theCalc_rf;
		$rf_numb = $remember_this_rf_numb;
		$calc_note = (($theCalc_rf*$timeBetweenFrames)+(($dna_seq_numb-$theCalc_rf)/$len_bp2sonify)*$this2next);
		$this_note = intval($calc_note);
		// match motif bp with bp from either rf, use its value for this note
		// note rf 0 (motifs are processed last as they were added last, 1 2 3 0, 1 2 0, 1 0.
		$next_note = $this_note + $this2next; //keep even///////////////////////////////////////////////////
		$frame_note_data["$rf_numb"]["$c_numb"]['dna_seq_numb'] = 	$dna_seq_numb;
		$frame_note_data["$rf_numb"]["$c_numb"]['codon64_numb'] = 	$codon64_numb;
		$frame_note_data["$rf_numb"]["$c_numb"]['codon'] = 			$codon;
		$frame_note_data["$rf_numb"]["$c_numb"]['aa'] = 				$aa;
		$frame_note_data["$rf_numb"]["$c_numb"]['aa_numb'] = 		$aa_numb;
		$frame_note_data["$rf_numb"]["$c_numb"]['note'] = 			$note;
		$frame_note_data["$rf_numb"]["$c_numb"]['note_numb'] = 		$note_numb;
		$frame_note_data["$rf_numb"]["$c_numb"]['instrument'] = 		$instr_numb;
		$frame_note_data["$rf_numb"]["$c_numb"]['reading_frame'] =	$rf;
		$frame_note_data["$rf_numb"]["$c_numb"]['start_track'] = 	$start_track;
		$frame_note_data["$rf_numb"]["$c_numb"]['this_note'] = 		$this_note;
		$frame_note_data["$rf_numb"]["$c_numb"]['next_note'] = 		$next_note;
		$frame_note_data["$rf_numb"]["$c_numb"]['stop_note'] = 		$this_note + $duration; //keep odd
		$advance = $next_note;
		$frame_note_data["$rf_numb"]["$c_numb"]['tempo'] = $tempo;
		$frame_note_data["$rf_numb"]["$c_numb"]['aa_formated'] = '<font color="#525552">'.$aa.'</font>'.'|';
		$frame_note_data["$rf_numb"]["$c_numb"]['protein_note_formated'] = '<font color="#525552">'.$note_dot.'</font>'.'|';

		// adjust time based on codon eg G= =5 C==5 A= -5 T =-5
		$frame_note_data["$rf_numb"]["$c_numb"]['quantize'] = 	$track_header['quantize'];
			if($track_header['quantize'] == 'adjust'){
				//quote $this_note otherwise formular not value is sent
				$frame_note_data["$rf_numb"]["$c_numb"]['play_note'] = 	adjustPlaynote($codon, $this_note);
			}else{
				$frame_note_data["$rf_numb"]["$c_numb"]['play_note'] = 	$this_note;
			}
		$frame_note_data["$rf_numb"]["$c_numb"]['on_vol'] = 		$on_vol;
		$frame_note_data["$rf_numb"]["$c_numb"]['off_vol'] = 		$off_vol;
		$frame_note_data["$rf_numb"]["$c_numb"]['codon_formated'] = '<font color="#525552">'.$codon.'</font>'.'|';
		$frame_note_data["$rf_numb"]["$c_numb"]['1bp_formated'] = '<font color="#525552">'.$codon.'</font>'.' |';
		$frame_note_data["$rf_numb"]["$c_numb"]['note_formated'] = 	'<font color="#525552">'.$note_dot.'</font>'.'|';
		//added 2017 to replace all_note_string
		$frame_note_data["$rf_numb"]["$c_numb"]['note_1letter'] = '<font color="#525552">'.substr($note_dot,0,1).'</font>';

		if(($_POST['stopstart'] == 'yes') and ($_POST['frameNum'] == '3') and ($rf_numb !== 0)){
			include("stop_start_codons.php");
		}
		elseif( ($_POST['stopstart'] == 'strict' or $_POST['stopstart'] == 'silent') and ($_POST['frameNum'] == '3') and ($rf_numb !== 0) ){
			include("stop_start_strict.php");
		}
	}
}
?>
