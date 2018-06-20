<?php
include("./functions.php");
include("./arrays.php");

$flag = ''; //will be set in verify sequence below

if(isset($_POST['dna_seq'])){
  $dna_seq = $_POST['dna_seq'];
}else{
  include("./verify_sequence.php");
}

if($flag === 'notok'){
  header("Location: error.php?msg=$msg");
}else
{ //run page below

//show_array($_POST);//causes tables to change format!!! CARE!

include("./header.php");
include("./sonify.java");

//add code to set limit on lenght of DNA sequence
if(strlen("$dna_seq") > 5000){
  echo '<br/>';
  echo 'The DNA sequence is too long, please limit the sequence to 1000 bp';
  echo '<br/>';
  echo 'The DNA sequence you entered was ';
  echo strlen("$dna_seq");
  echo ' bp long';
  echo '<br/>';
  echo 'DNA sequence - <br/>';
  echo wordwrap2($dna_seq, $width = 60, $break = "<br>", $html = "b");
  echo '<br/>';
  break;
  //break;
}

// $track_header = makeTrackHeader();
$mididata = makeMididataArray();
//show_array($mididata);

foreach($_POST as $key => $selected){// put in to function avoid repitition
  if(isset($selected)){
    $postdata["$key"] = $selected;
    }else{}
}
//$postdata["music_style"] = 'Default';
if(!isset($yeastdnaSeqs_or_Predefined)){$yeastdnaSeqs_or_Predefined = '';}

$dna_seq = truncate_string($dna_seq, 10000);// a bit random!

if($_POST['frameNum'] == '3'){
  $codon               = make3frames($dna_seq);
  $seq2note_algorithm       = 'Make_codon2noteArray_scale';
  // $track_header['this2next']     = $track_header['this2next'];
  $len_bp2sonify = 3;
  $numb_of_RFs = 3;
}
elseif($_POST['frameNum'] == '1'){
  $codon               = makeprotein($dna_seq);
  $seq2note_algorithm       = 'Make_codon2noteArray_scale';
  // $track_header['this2next']     = $track_header['this2next'] * 0.5;
  $len_bp2sonify = 3;
  $numb_of_RFs = 1;
}
elseif($_POST['frameNum'] == '1bp'){
  $codon               = make_1BP($dna_seq);
  $seq2note_algorithm       = 'Make_monoBP_2noteArray_scale';
  // $track_header['this2next']     = $track_header['this2next'] * 0.5;
  $len_bp2sonify = 1;
  $numb_of_RFs = 1;
}
elseif($_POST['frameNum'] == '2bp'){
  $codon               = make_2BP($dna_seq);
  $seq2note_algorithm       = 'Make_diBP_2noteArray_scale';
  // $track_header['this2next']     = $track_header['this2next'] * 0.5;
  $len_bp2sonify = 2;
  $numb_of_RFs = 1;
}
elseif($_POST['frameNum'] == '2bpx2'){
  $codon               = make_2BPx2($dna_seq);
  $seq2note_algorithm       = 'Make_diBP_2noteArray_scale';
  // $track_header['this2next']     = $track_header['this2next'];
  $len_bp2sonify = 2;
  $numb_of_RFs = 2;
}
elseif($_POST['frameNum'] == '3bp'){
  $codon               = make_3BP($dna_seq);
  $seq2note_algorithm       = 'Make_triBP_2noteArray_scale';
  // $track_header['this2next']     = $track_header['this2next'] * 0.5;
  $len_bp2sonify = 3;
  $numb_of_RFs = 3;// add another catogory 1 rf all codons
}else{}

$motif2note = make_motif_array();//makes purcussive array sn/cy
//show_array($motif2note);

if( $postdata['frameNum'] == '3' || $postdata['frameNum'] == '1' || $postdata['frameNum'] == '3bp' ) {
  $motif_position1 = identifyMotif($dna_seq, $motif2note);//new
}
if(! empty($motif_position1)) {
  $Motif_key = $numb_of_RFs+1;
  ksort($motif_position1);
  $motif_position[0] = $motif_position1;
  //dump($motif_position);
  foreach($motif_position as $motif){
  $keys[] = array_keys($motif);
  }
  $first = 1;
  $dna_len = strlen($dna_seq);
  $count = count($keys[0]);
    $dashes = '';
    $dash_extend = '';
    $endstring = '';
  foreach($keys as $v){
    foreach($v as $motifStartBP){
      $lastDash = $motif_position[0][$motifStartBP]['lastDash'];
      $motifseq = $motif_position[0][$motifStartBP]['codon'];
      $startNext = $motif_position[0][$motifStartBP]['startNext'];
      $len_bp2sonify = $motif_position[0][$motifStartBP]['len_bp2sonify'];
      $verylast = $startNext;
      if($first === 1){//first
        for ($x = 1; $x <= $lastDash; $x ++) {
          $dashes .= '-';
        }
      }else{}
      if(($first !== 1) and ($count >= $first)){//in betweens
      for ($x = $next; $x <= $lastDash; $x ++) {
        $dashes .= '-';
      }
      }else{}
      if($count === $first){//last
      //echo 'only once!';
      //echo $next;
      //echo $dna_len;
      $lastdash = '';
      for ($x = $verylast; $x <= $dna_len; $x ++) {
        $endstring .= '-';
        }
      }else{}
      $first = $first+1;
      $next = $startNext;
      $dashes .= $motifseq;
      $lastMotifStr = substr_replace("$dash_extend","$dashes", $lastDash);
      $dashes = '';
      $motifseq = '';
      $dash_extend = $lastMotifStr;
    }
  }
  $lastMotifStr .= $endstring;
  //echo $lastMotifStr;
  }else{
}
$codon2note = makeCodon2note('', $seq2note_algorithm, $numb_of_RFs);
$codon_plus_array = makeCodonPlus($codon, $codon2note);

 //show_array($codon2note);
 //show_array($codon_plus_array);


unset($codon);
unset($codon2note);

if((! empty($motif_position1)) and ($_POST['sonify_motif'] == 'yes')){
//note this causes motif pos to be appended as array key 0 since rf are 1 (2,3)
//make use of this to address motif data from array 0
$codon_plus_array2 = ($codon_plus_array + $motif_position);
}else{
$codon_plus_array2 = $codon_plus_array;
}
//show_array($codon_plus_array2);

unset($codon_plus_array);
include("make_frame_note_data.php");
unset($codon_plus_array2);

//##############################################################
//show_array($frame_note_data);//eg three arrays with all data

$count = '';;
foreach($frame_note_data as $k => $array){
  $count++;
}
//$tracks_for_midi_header = $count+1;
//include("MidiTrk.php");
//show_array($track_header);

//show_array($frame_note_data);

foreach($frame_note_data as $rf_numb => $array){
  $frame_note_data_chunks[] = array_chunk($array, '22');
}
//all new code to capture all note strings for all 6 styles
$count66 = 0;
$noteRow = '';

  for($j = 0; $j < count($frame_note_data[1]); $j++){
    $noteRow = intval(($j / 22) +1);
    $one_note_chunks[$noteRow] = '';//define the variable prior to next for loop below
  }
  $stStr1 = '';
  $endStr1 = '';
  $endStr2 = '';
  $endStr3 = '';

    switch ($_POST['frameNum']) {
      case '3'://Reading frame codons
        $endStr3 = '|';
        break;
      case '1'://Protein sequence
        $stStr1 = '&#x2011';
        $endStr1 = '&#x2011|';
        break;
      case '3bp'://Tri-nucleotides
        $stStr1 = '&#x2011';
        $endStr1 = '&#x2011|';
        break;
      case '2bpx2'://Di-nucleotide pairs
        $endStr2 = '|';
        break;
      case '2bp'://Di-nucleotides
        $endStr1 = '&#x2011|';
        break;
      case '1bp'://Mono-nucleotides
        $endStr1 = '&#x2011|';
        break;
    }

for($j = 0; $j < count($frame_note_data[1]); $j++){
  $noteRow = intval(($count66 / 22) +1);
  if(!empty($frame_note_data[1][$j])){
  $one_note_chunks[$noteRow] .= $stStr1.$frame_note_data[1][$j]['note_1letter'].$endStr1;
  }
  if(!empty($frame_note_data[2][$j])){
  $one_note_chunks[$noteRow] .=  $frame_note_data[2][$j]['note_1letter'].$endStr2;
  }
  if(!empty($frame_note_data[3][$j])){
  $one_note_chunks[$noteRow] .=  $frame_note_data[3][$j]['note_1letter'].$endStr3;
  //echo $count66;
  }
$count66++;
}

//#################################

foreach($frame_note_data_chunks as $rf_numb => $chunks){
$rf_numb++;
  foreach($chunks as $chunk_numb => $array){
    $mididata["$rf_numb"]['codon_string']["$chunk_numb"] = '';
    $mididata["$rf_numb"]['note_string']["$chunk_numb"] = '';
    $mididata["$rf_numb"]['protein_string']["$chunk_numb"] = '';
    $mididata["$rf_numb"]['protein_note_string']["$chunk_numb"] = '';
    $mididata["$rf_numb"]['1bp_formated']["$chunk_numb"] = '';
    foreach($array as $c_numb => $codon_data_arrays){
      $mididata["$rf_numb"]['codon_string']["$chunk_numb"] .= $codon_data_arrays['codon_formated'];
      $mididata["$rf_numb"]['note_string']["$chunk_numb"]   .= $codon_data_arrays['note_formated'];

      $mididata["$rf_numb"]['protein_string']["$chunk_numb"]   .= $codon_data_arrays['aa_formated'];/////////////////
      $mididata["$rf_numb"]['protein_note_string']["$chunk_numb"]   .= $codon_data_arrays['protein_note_formated'];

      $mididata["$rf_numb"]['1bp_formated']["$chunk_numb"]   .=   $codon_data_arrays['1bp_formated'];/////////////////

    }
  }
  $codon_str_table["$rf_numb"] = implode('', $mididata["$rf_numb"]['codon_string']);
  $note_str_table["$rf_numb"] = implode('', $mididata["$rf_numb"]['note_string']);
  $protein_str_table["$rf_numb"] = implode('', $mididata["$rf_numb"]['protein_string']);////////////
  $protein_note_str_table["$rf_numb"] = implode('', $mididata["$rf_numb"]['protein_note_string']);////////////
  $monobp_formated_str_table["$rf_numb"] = implode('', $mididata["$rf_numb"]['1bp_formated']);
}

//($monobp_formated_str_table);

//above 5 strings were implode('<br>', but BREAKS removed to make text scroll on various screen sizes
?>
<!-- <form action="./index.php" method="post" > -->
        <?php
include("form_audio_control.php");

//$blah = playMidi($MidiTrk);//works to write  MID file to tmp directory
//the function has been updated to return a random number to act as a uneque identifier
//for user mid file

//$text_strings = makeTextstrings($dna_seq, $textCapture);
$text_strings = makeTextstrings($dna_seq);

//var_dump($text_strings);

//echo 'blah = '.$blah;
//use ID to call midi file
// $bas64MIDfile =
// (base64_encode(file_get_contents("./midi_class_v175/tmp/testMIDI{$blah}.mid" )));

?>
<div id="spin" class="overlaySpin">

</div>


<div class="container">
  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="boarderbox col-md-8">
      <h1><?php echo $_POST['DNAseq_name']; ?></h1><hr>
      <form action="./read_fasta.php" method="post" >
        <?php include("form_audio_control.php"); ?>
        <input name="dna_seq" type="hidden" value="<?php echo $dna_seq ;?>" />
        <input name="DNAseq_name" type="hidden" value="<?php echo $_POST['DNAseq_name']; ?>" />
        <input name="yeastdnaSeqs_or_Predefined" type="hidden" value="<?php echo $yeastdnaSeqs_or_Predefined ;?>" />
        <button type="submit" class="btn btn-secondary" onClick="javascript: form.action='index.php';" />
        Re-sonify <i class="fas fa-dna"></i> sequence
        </button>
      <canvas id="dnapaper" width="500px" height="200px">
      </canvas>
      <div class="btn-group btn-sm">
        <button type="button" class="btn btn-primary" id="play" />
        <i class="fas fa-play">
        </i>
        Play
        </button>
      <button type="button" class="btn btn-primary" id="suspend" />
      <i class="fas fa-pause">
      </i>
      Pause
      </button>
      </div>
      </form>
        <div class="card card-body">
          <p>The mapping of each codon or motif in the auditory display is represented in this animation and in the tables below. The RE-SONIFY button will pass the same sequence back to the previous page where the algorithm properties can be changed. Each circle represents a reading frame and shows the mapping of the DNA sequence to audio notes.<br>
        </div>
      </div>
    </div>
    <div class="col-md-2">
    </div>
</div>
<hr>
<?php
echo '<script>';
echo 'var stopstart = ' . json_encode($postdata['stopstart']) . ';';
echo 'let frameNum = ' . json_encode($postdata['frameNum']) . ';';
echo 'let numb_of_RFs = ' . json_encode($numb_of_RFs) . ';';
echo 'let dna_php = ' . json_encode($dna_seq) . ';';
echo 'let sonify_motif = ' . json_encode($_POST['sonify_motif']) . ';';
echo '</script>';
?>
<script src="./spinnyDNA.js">
</script>
<?php  //include("./JZZ_PlayMidiFile.php"); ?>


<div class="container">
  <div class="row">
    <div class="boarderbox col-md-12">
      <h3>Summary of sonified audio
      </h3>
      <?php
$rf_numb_count = array(1, 2, 3);
$pair_count = array(1, 2);
?>
      <table class="box-table-a" summary="DNA reading frames">
        <tr>
          <th width="20%">
          </th>
          <th align="left" width="80%">Audio generated from 
            <b>
              <?php echo $_POST['DNAseq_name']; ?>
            </b>
          </th>
        </tr>
        <tr>
          <th>All Instrument Notes
          </th>
          <td align="left">
            <p class="DNA_seq">
              <?php foreach($one_note_chunks as $v){echo $v;}?>
            </p>
          </td>
        </tr>
        <?php
//*****************************************//
if($_POST['frameNum'] === '3'){//readingFrame codons
foreach($rf_numb_count as $rf){
$textCapture[] =array($mididata["$rf"]['reading_frame'], $mididata["$rf"]['instrument_name']);?>
        <tr>
          <th width="20%">
            <?php echo $mididata["$rf"]['reading_frame']; ?>
          </th>
          <td align="left">
            <p class="DNA_seq">
              <?php echo $codon_str_table["$rf"]; ?>
            </p>
          </td>
        </tr>
        <tr>
          <th width="20%">
            <?php echo $mididata["$rf"]['instrument_name']; ?>
          </th>
          <td align="left">
            <p class="DNA_seq">
              <?php echo $note_str_table["$rf"]; ?>
            </p>
          </td>
        </tr>
        <?php
}
?>
      </table>
      <?php
}
//*****************************************//
elseif($_POST['frameNum'] === '1'){//Protein sequence
$textCapture[] =array($mididata['1']['reading_frame'], $mididata['1']['instrument_name']);?>
      <tr>
        <th width="20%">DNA sequence
        </th>
        <td align="left">
          <p class="DNA_seq">
            <?php echo $codon_str_table['1'];?>
          </p>
        </td>
      </tr>
      <tr>
        <th width="20%">
          <?php echo $mididata['1']['reading_frame']; ?>
        </th>
        <td align="left">
          <p class="DNA_seq">
            <?php echo $protein_str_table['1']; ?>
          </p>
        </td>
      </tr>
      <tr>
        <th width="20%">
          <?php echo $mididata['1']['instrument_name']; ?>
        </th>
        <td align="left">
          <p class="DNA_seq">
            <?php echo $protein_note_str_table['1']; ?>
          </p>
        </td>
      </tr>
      </table>
    <?php
}
//*****************************************//
elseif($_POST['frameNum'] === '3bp'){//Tri-nucleotides
$textCapture[] =array('"Tri-nucleotide sequence"', $mididata['1']['instrument_name']);?>
    <tr>
      <th width="20%">DNA sequence
      </th>
      <td align="left">
        <p class="DNA_seq">
          <?php echo $codon_str_table['1']; ?>
        </p>
      </td>
    </tr>
    <tr>
      <th width="20%">
        <?php echo $mididata['1']['instrument_name']; ?>
      </th>
      <td align="left">
        <p class="DNA_seq">
          <?php echo $protein_note_str_table['1']; ?>
        </p>
      </td>
    </tr>
    </table>
  <?php
}
//*****************************************//
elseif($_POST['frameNum'] === '2bpx2'){//Di-nucleotide pairs
foreach($pair_count as $rf){
$textCapture[] =array($mididata["$rf"]['reading_frame'], $mididata["$rf"]['instrument_name']);?>
  <tr>
    <th width="20%">
      <?php echo $mididata["$rf"]['reading_frame']; ?>
    </th>
    <td align="left">
      <p class="DNA_seq">
        <?php echo $codon_str_table["$rf"]; ?>
      </p>
    </td>
  </tr>
  <tr>
    <th width="20%">
      <?php echo $mididata["$rf"]['instrument_name']; ?>
    </th>
    <td align="left">
      <p class="DNA_seq">
        <?php echo $protein_note_str_table["$rf"]; ?>
      </p>
    </td>
  </tr>
  <?php
}?>
  </table>
<?php
}
//*****************************************//
elseif($_POST['frameNum'] === '2bp'){//Di-nucleotides
$textCapture[] =array('"Di-nucleotide sequence"', $mididata['1']['instrument_name']);?>
<tr>
  <th width="20%">DNA sequence
  </th>
  <td align="left">
    <p class="DNA_seq">
      <?php echo $codon_str_table['1']; ?>
    </p>
  </td>
</tr>
<tr>
  <th width="20%">
    <?php echo $mididata['1']['instrument_name']; ?>
  </th>
  <td align="left">
    <p class="DNA_seq">
      <?php echo $protein_note_str_table['1']; ?>
    </p>
  </td>
</tr>
</table>
<?php
}
//*****************************************//
elseif($_POST['frameNum'] === '1bp'){//Mono-nucleotides
$textCapture[] =array('"Mono-nucleotide sequence"', $mididata['1']['instrument_name']);?>
<tr>
  <th width="20%">DNA sequence
  </th>
  <td align="left">
    <p class="DNA_seq">
      <?php //echo $monobp_formated_str_table['1']; ?>
      <?php echo str_replace(' ', '-', $monobp_formated_str_table['1']); ?>
    </p>
  </td>
</tr>
<tr>
  <th width="20%">
    <?php echo $mididata['1']['instrument_name']; ?>
  </th>
  <td align="left">
    <p class="DNA_seq">
      <?php echo $protein_note_str_table['1']; ?>
    </p>
  </td>
</tr>
</table>
<?php
}
?>
</div>

<div class="container">
  <div class="row">
    <div class="boarderbox col-md-12">
  <table class="box-table-a" summary="DNA reading frames">
    <tr>
      <th width="100%">Summary of 
        <b>
          <?php echo $_POST['DNAseq_name']; ?>
        </b> properties
      </th>
    </tr>
    <tr>
      <td align="left" width="100%">
        <?php
echo '<p>'.$text_strings['seq_length'];
echo $text_strings['GATC_content'];
echo $text_strings['gc_ratio'];
echo $text_strings['key_of_audio'];
echo $text_strings['scale'];
//show_array($textCapture);
$count = count($textCapture);
echo 'This sequence was processed as <b>'.$count.'</b> reading frame(s).<br>'.'This sequence was sonified as; <br>';
foreach($textCapture as $txt){
echo '<b>'.$txt['0'].'</b> using the instrument <b>'.$txt['1'].'</b><br>';
}  ?>
    </p>
    </td>
  </tr>
</table>
</div>


<div class="container">
  <div class="row">
    <div class="boarderbox col-md-12">  
      <table class="box-table-a" summary="DNA reading frames">
    <tr>
      <th width="20%">Nucleotide sequence (5'=>3')
      </th>
      <td align="left">
        <p class="DNA_seq">
          <?php echo str_replace('<br>', '', $text_strings['dna_seq']); ?>
        </p>
      </td>
    </tr>
  </table>
  <?php
if(! empty($motif_position1)){
?>
  <table class="box-table-a" summary="DNA reading frames">
    <tr>
      <th width="20%">Motifs
      </th>
      <td align="left">
        <p class="DNA_seq">
          <?php
$txtM = '';
foreach($motif2note as $motif){
$txtM .= $motif['2'].' (<b>'.$motif['1'].'</b>), ';
}
echo $txtM;
?>
        </p>
      </td>
    </tr>
  </table>
  <table class="box-table-a" summary="DNA reading frames">
    <tr>
      <th width="20%">Summary of identified motifs
      </th>
      <td align="left">
        <p class="DNA_seq">
          <?php $lastMotifStr = str_replace('T', '<b>T</b>', $lastMotifStr); ?>
          <?php $lastMotifStr = str_replace('A', '<b>A</b>', $lastMotifStr); ?>
          <?php $lastMotifStr = str_replace('G', '<b>G</b>', $lastMotifStr); ?>
          <?php echo str_replace('-', '&#8209', $lastMotifStr); ?>
        </p>
      </td>
    </tr>
  </table>
  <?php
}else{
?>
  <table class="box-table-a" summary="DNA reading frames">
    <tr>
      <th width="20%">Summary of identified motifs
      </th>
      <td align="left">
        <p class="DNA_seq">No Mofifs Found
        </p>
      </td>
    </tr>
  </table>
  <?php
}
}//end of if ok run page
?>
</div>
</div>
<?php
include("footer.php");
?>
