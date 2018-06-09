<?php 
$flag = 'ok';   // This is the flag and we set it to OK

if($_POST['dnaseq_radio'] == 'dnaseq_userInput'){
	$dna_seq = $_POST['dnaseq_userInput'];
	$msg = '';      // Initializing the message to hold the error messages
	
	$unwanted_whitespace = array
	(" ", "\t", "\n", "\r", "\0", "\x0B");
	$unwanted_letters = array
	("B", "D", "E", "F", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "U", "V", "W", "X", "Y", "Z");
	$unwanted_numbers = array
	("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
	
	if(isset($dna_seq)){
	$dna_seq = strtoupper($dna_seq);
	$dna_seq = trim($dna_seq);
	}else{
		$flag = 'notok'; 
		$msg .= 'variable is set but is NULL<BR>';
	}
	$count = 0;
	
	$dna_seq = str_replace($unwanted_whitespace, "", "$dna_seq", $count);
	if($count !== 0){$msg .= 'Unwanted whitespaces were removed from the DNA sequence<BR>';$count = 0;}
	
		$dna_seq = str_replace($unwanted_letters, "", "$dna_seq", $count);
	if($count !== 0){$msg .= 'Unwanted letters (not GATC) were removed from the DNA sequence<BR>';$count = 0;}
	
		$dna_seq = str_replace($unwanted_numbers, "", "$dna_seq", $count);
	if($count !== 0){$msg .= 'Unwanted numbers were removed from the DNA sequence<BR>';$count = 0;}
	
	if(!ctype_alpha($dna_seq)){
		$flag = 'notok';   //setting the flag to error flag.
		$msg .= 'Please use only alphabets a to z as DNA sequence<BR>';
	}else{}
	if(strlen($dna_seq) < 5){ 
		$flag = 'notok'; 
		$msg .= 'The DNA sequence was less than 5 nucleotides in length<BR>';
	}
}elseif($_POST['dnaseq_radio'] == 'makerandom'){
	$seq2note_algorithm = 'Make_codon2noteArray_scale';
	$dna_seq = makeRandomseq($_POST['numbCodons'], $seq2note_algorithm);
	
	$_POST['DNAseq_name'] = 'A random DNA sequence of '.$_POST['numbCodons'].' codons';////////////////////
	
	if($_POST['numbCodons'] < 3 ){
		$flag = 'notok'; 
		$msg = 'Please set the number of codons to be greater than 2<BR>';
	}
}else{
	//split dna
	$dna_seq_post_array = explode('|',$_POST['dnaseq_radio']);
	
	$_POST['DNAseq_name'] 	= $dna_seq_post_array['0'];//use to remember radio select
	$dna_seq 				= $dna_seq_post_array['1'];
	$yeastdnaSeqs_or_Predefined = $dna_seq_post_array['2'];
}
//unset($_POST['dnaseq_userInput']);
//unset($_POST['dnaseq_radio']);

?>