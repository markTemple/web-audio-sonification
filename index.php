<?php
include("./header.php");
include("./functions.php");
include("./arrays.php");
include("sonify.java");

foreach($_POST as $key => $selected){
	if(isset($selected)){
		$postdata["$key"] = $selected;
	}else{}
}
//dump($_POST);
$check1 = '';
$check2 = '';

if(!empty($_POST['dnaseq_radio'])){
//if($_POST['dnaseq_radio'] == 'dnaseq_userInput'){
	$form_val_DNAseq_name = $_POST['DNAseq_name'];
  $form_val_dna_seq = $_POST['dna_seq'];
  $form_val_numbCodons = $_POST['numbCodons'];}
	else{
  $form_val_numbCodons = '39';
	$form_val_DNAseq_name = 'User_input_DNA';
	$form_val_dna_seq = 'GGGAAAGGGAAATTTCCCGGGAAAGGGAAATTTCCCGGGAAAGGGAAATTTCCCGGGAAAGGGAAATTTCCCGG';
	$check2 = 'checked="checked"'; // set defalt radio to random
	//fix for Notice: Undefined variable errors in form_audio_control.php
	$postdata['frameNum'] = '3';
	$postdata['stopstart'] = 'strict';
	$postdata['sonify_motif'] = 'no';
	$_POST['DNAseq_name'] = '';
	$_POST['dnaseq_radio'] = '';
	$_POST['yeastdnaSeqs_or_Predefined'] = '';
}
?>
<!-- <div>
<h2>An auditory display tool for DNA sequence analysis</h2>
</div> -->

<div class="container boarderbox">
<h1>An auditory display tool for DNA sequence analysis</h1><hr>
  <div class="row">
    <div class="col-md-6">
    <h2>Select an algorithm</h2>
      <div class="card card-body">

      <form action="./read_fasta.php" method="post" >
      <?php include("form_audio_control.php"); ?>
      <span>
      <?php 	$frameNum = make_frameNum();
//makeSelectBox
      makeRadioBoxes($frameNum, $postdata['frameNum'], '3', 'frameNum', 'frameNum_id', 'Algorithm: ');?>
      </span>
      </div>
    </div>
    <div class="col-md-6" id="rfc">
      <h3>Codon options</h3>
      <div class="card card-body">
      <span>
        <?php 	$stopstart = make_stopstart();
makeRadioBoxes($stopstart, $postdata['stopstart'], 'strict', 'stopstart', 'stopstart_id', 'Select: ');
?>
      </span>
      <hr>
      <div class="row w-100">
        <div class="col-4">
          <span>
            <?php 	$sonify_motif = make_sonify_motif();
makeRadioBoxes($sonify_motif, $postdata['sonify_motif'], 'no', 'sonify_motif', 'sonify_motif_id', 'Percussion: ');?>
          </span>
        </div>
        <div class="col-8">
          <p class="p2">Play START with Snare drum and STOP with Crash Cymbal
          </p>
        </div>
        </div>
        </div>
    </div>
  </div>

<script>
var algorithm_radio = $('input:radio[name=frameNum]:checked').val();
if(algorithm_radio !== '3'){
  document.getElementById("rfc").style.opacity = 0.5;
}

$('input[name=frameNum]').change(function(){
    value = $( 'input[name=frameNum]:checked' ).val();
    if(value == 3){
      document.getElementById("rfc").style.opacity = 1;
    }else{
      document.getElementById("rfc").style.opacity = 0.5;
    }
});
</script>

  <div class="row">
    <div class="col-md-6">
      <div id="summary" class="help_text">
        <p class="collapse" id="collapseSummary01">
          The Reading-frame-codons algorithm sonifys each overlapping codon (made up of 3 base) as a single note. Codons in 3 reading frames are sonified using 3 instruments. A 
          <b>start codon
          </b> is ATG and there are 3 
          <b>stop codons
          </b> (TGA, TAG and TAA). These codons act to start or stop protein synthesis. The Protein-sequence algorithm plays only the open reading frame (assume reading frame 1) and non-overlapping codons are mapped to 20 notes, since there are 20 different amino acid residues in a protein.
          The Tri-nucleotides algorithms plays all codons (64 in total) as individual notes. The two Di-nucleotide algorithms sonify overlapping or non-overlapping motifs of 2 base-pairs. Overlapping motifs are sonified using 2 instruments and only 16 notes are possible. Lastly the Mono-nucleotides algorithm sonifies each  individual bases to a single note.
        </p>
        <a class="collapsed" data-toggle="collapse" href="#collapseSummary01" aria-expanded="false" aria-controls="collapseSummary01">
        </a>
      </div>
    </div>
    <div class="col-md-6">
      <div id="summary" class="help_text">
        <p class="collapse" id="collapseSummary02">
          Options only apply to the 
          <b>Reading-frame-codons
          </b> selection. 
          <br>
          With the Silent-until-ATG option, no audio is generated in either frame until an ATG codon is detected, often this causes the sonification to be silent at the begining. The Restart-on-ATG option plays all codons from the beginning of the sequence. For both of these options, a Stop codon will silence the audio in the frame in which it occurs (this effects only one instrument). The Restart-after-10-codons option automatically turns the audio on again in the absence of a Start codon - simply to avoid long periods of silence.
          Each frames is audible until a STOP codon occurs, ATG restarts the frames audio. The Ignore-Start/Stop option will play all codons for the entire sequence.
        </p>
        <a class="collapsed" data-toggle="collapse" href="#collapseSummary02" aria-expanded="false" aria-controls="collapseSummary02">
        </a>
      </div>
    </div>
  </div>  
</div>
</div>

<div class="container boarderbox">
  <div class="row">
      <div class="col-12">
        <p>
        <button type="submit" class="btn-primary btn"/>
        <i class="fas fa-volume-up"></i> Sonify
        </button>
        </p>
      </div>
      <div class="col-12">
        <p>
        Apply the Sonification Algorithm above to the chosen DNA sequence below. This will create an auditory display so that you can hear the sequence.
        </p>
      </div>
    </div>
  </div>
</div>

<?php include("form_dna_seq_control.php"); ?>
</form>
<?php include("footer.php");?>
