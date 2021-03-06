<?php include("DNA_strings.php");?>




<div class="container boarderbox">
  <h2>
  Select one DNA sequences
  </h2>
    <div class="row">
    <div class="col-md-6">

    <h3> Default DNA sequences</h3>
    <div class="card card-body">
      <div style="display:<?php echo $display_makerandom;?>;">
        <label class="highlight">
          <input name="dnaseq_radio" type="radio" value="makerandom" <?php echo "$check2";?>/> 
          <input name="numbCodons" type="text" value="<?php echo $form_val_numbCodons;?>"  maxlength="2" size="2"/>
          <span class="radioText_DNA">
            Codons: A random DNA sequence
          </span>
        </label>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <h3> User DNA sequences</h3>
    <div class="card card-body">
      <div name="Paste DNA" style="display:<?php echo $display_dnaseq_userInput;?>;">
          <label class="highlight">
          <input name="dnaseq_radio" type="radio" value="dnaseq_userInput" <?php echo "$check1";?>/>
          <span class="radioText_DNA">
            Enter your own DNA sequence
          </span>
          </label>
        <input name="DNAseq_name" type="hidden" value="<?php echo $form_val_DNAseq_name;?>" size="22" maxlength="100"/>
        <textarea name="dnaseq_userInput"><?php echo $form_val_dna_seq;?></textarea>
      </div>
    </div>
    </div>
    </div>

	<div class="col-md-12">
  <h3>Pre-defined DNA sequences</h3>
		<div class="card card-body">
    <?php
    foreach($DNA_strings as $v){
    $check = '';
    if(($v['0']  == $_POST['DNAseq_name']) and ($_POST['dnaseq_radio'] !== 'dnaseq_userInput')){
    $check = 'checked="checked"';
    }
    ?>
			<div class="radio_span">
			  <label class="highlight"><input name="dnaseq_radio" type="radio" value="<?php echo $v['0'].'|'.$v['1'].'|'.'Predefined';?>"<?php echo $check;?> /><?php echo ' '.$v['0'];?></label>
    </div>
      <div class="DNA_seq">
        <?php echo shorten($v['1'], $v['2'], 100);?>
      </div>
    <hr>
  <?php
}
?>
</div>
    </div>
					<!-- <div class="boarderbox col-md-6">
						<?php //include("rna_coding.php");?>
					</div> -->
  </div>
</div>
<div>
