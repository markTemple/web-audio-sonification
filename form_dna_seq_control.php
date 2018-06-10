<?php include("DNA_strings.php");?>

<div class="container">
  <div class="row">
    <div class="boarderbox col-md-6">
      <hr>  
      <h2>Make random sequence
      </h2>
      <div style="display:<?php echo $display_makerandom;?>;">
        <div class="highlight">
          <input name="dnaseq_radio" type="radio" value="makerandom" 
                 <?php echo "$check2";?>/> 
          <span>Make random sequence
          </span>
        </div>
      </div>
      <input name="numbCodons" type="text" value="64" maxlength="2"/>
    </div>
    <div class="boarderbox col-md-6">
      <hr>
      <h2>Enter a DNA sequence
      </h2>
      <div name="Paste DNA" style="display:<?php echo $display_dnaseq_userInput;?>;">
      </div>
      <div class="highlight">
        <input name="dnaseq_radio" type="radio" value="dnaseq_userInput" 
               <?php echo "$check1";?>/>
        <span>Enter DNA seq 5'=>3'
        </span>
      </div>
      <div>
        <input name="DNAseq_name" type="text" value="<?php echo $form_val_DNAseq_name;?>" size="22" maxlength="100"/>
        <textarea name="dnaseq_userInput">
          <?php echo $form_val_dna_seq;?>
        </textarea>
      </div>
    </div>
  </div>
</div>
</div>
<div class="container">
  <div class="row">
    <div class="boarderbox col-md-6">
      <hr>
      <h2 data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <i class="fa fa-spinner fa-spin" style="font-size:24px">
        </i> &nbsp;
        <span class="textH2">Test DNA sequences
          </h2> 
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <?php
foreach($DNA_strings as $v){
$check = '';
if(($v['0']  == $_POST['DNAseq_name']) and ($_POST['dnaseq_radio'] !== 'dnaseq_userInput')){
$check = 'checked="checked"';
}
?>
            <div class="highlight">
              <div class="radio_span">
                <input name="dnaseq_radio" type="radio" value="<?php echo $v['0'].'|'.$v['1'].'|'.'Predefined';?>"
                       <?php echo $check;?> />
                <?php echo $v['0'];?>
              </div>
              <div class="DNA_seq">
                <?php echo shorten($v['1'], $v['2'], 75);?>
              </div>
            </div>
            <?php
}
?>
          </div>
        </div>
        </div>
      <div class="boarderbox col-md-6">
        <?php include("rna_coding.php");?>
      </div>
    </div>
  </div>
<div>



