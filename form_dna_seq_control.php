<?php include("DNA_strings.php");

$display_makerandom = 'inline';
$display_dnaseq_userInput = 'inline';
$display_Predefined = 'none';
$display_yeastdnaSeqs = 'none';

if(isset($_POST['dnaseq_radio'])){
	switch ($_POST['dnaseq_radio']) {
		case 'makerandom'://Protein sequence
			$check2 = 'checked="checked"';
			$display_makerandom = 'inline';
			break;
		case 'dnaseq_userInput'://Reading frame codons
			$check1 = 'checked="checked"';
			$display_dnaseq_userInput = 'inline';
			break;
	}
}
if(isset($_POST['yeastdnaSeqs_or_Predefined'])){
	switch ($_POST['yeastdnaSeqs_or_Predefined']) {
		case 'Predefined'://Reading frame codons
			$display_Predefined = 'inline';
			break;
		case 'yeastdnaSeqs'://Protein sequence
			$display_yeastdnaSeqs = 'inline';
			break;
	}
}
if( empty($_POST['dnaseq_radio']) and empty($_POST['yeastdnaSeqs_or_Predefined']) ){
	$display_makerandom = 'inline'; //default
}
?>
<div class="boarderbox col-md-6">

	<h2>Generate random sequence</h2><hr>
	<div style="display:<?php echo $display_makerandom;?>;">
		<div class="highlight">
			<input name="dnaseq_radio" type="radio" value="makerandom" <?php echo "$check2";?>/> <span>Make random sequence</span>
		</div>
	</div>
	<input name="numbCodons" type="text" value="64" maxlength="2"/>
	<p>A max value of 99 will generate a random sequence of 297 bases (3 base per codon)</p>
</div>

<div class="boarderbox col-md-6">
	<h2>Enter a DNA sequence</h2><hr>
	<div name="Paste DNA" style="display:<?php echo $display_dnaseq_userInput;?>;">
	</div>
	<div class="highlight">
	<input name="dnaseq_radio" type="radio" value="dnaseq_userInput" <?php echo "$check1";?>/>
	<span>Enter DNA seq 5'=>3'</span>
	</div>
	<div>
		<input name="DNAseq_name" type="text" value="<?php echo $form_val_DNAseq_name;?>" size="22" maxlength="100"/>
		<textarea name="dnaseq_userInput"><?php echo $form_val_dna_seq;?></textarea>
	</div>
</div>

<div class="boarderbox col-md-6">
	<hr>
	<div class="textH2">
		<a href="#" style="text-decoration:inline" onClick="toggle_it('Predefined')">
		<i class="fas fa-bars fa-lg">&nbsp;</i>
		</a>&nbsp;
		Test DNA sequences
	</div>
	<div id="Predefined" name="test dna strings" style="display:<?php echo $display_Predefined;?>;">
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
	</div><hr>
	<div class="textH2">
		<a href="#" style="text-decoration:none" onClick="toggle_it('yeastdnaSeqs')">
		<i class="fas fa-bars fa-lg">&nbsp;</i>
	</a>&nbsp;
	Yeast rRNA Genes
	</div>
	<div id="yeastdnaSeqs" name="ribosomal DNA sequences" style="display:<?php echo $display_yeastdnaSeqs;?>;">
		<?php include("rna_coding.php");?>
	</div>
</div>
