<?php

$fasta_all = file_get_contents('rna_coding.fasta');
$fasta_array = explode('>',$fasta_all);
array_shift($fasta_array);

unset($fasta_all);

foreach($fasta_array as $each_record){
	$record_lines[] = explode("\n",$each_record);
}
unset($fasta_array);

$unwanted_whitespace = array
(" ", "\t", "\n", "\r", "\0", "\x0B");

foreach($record_lines as &$line){
	array_pop($line);
	$record_lines_header[] = array_shift($line);
	foreach($line as $v){
		$x[] = str_replace($unwanted_whitespace, "", "$v");
	}
$record_lines_dna_seq[] = implode("",$x);
unset($x);
}

foreach($record_lines_header as &$header){
	$header = explode(', Chr ',$header);

	$zero = $header[0];
	$a = explode('SGDID:',$zero);
	$a[1] = 'SGDID:'.$a[1];

	$one = 'Chr '.$header[1];
	$b = explode(', "',$one );
	$b[1] = '"'.$b[1];

	$c = explode(' ',$a[0]);

	$header[0] = $c[0];
	$header[1] = $c[1];
	$header[2] = $a[1];
	$header[3] = $b[0];
	$header[4] = $b[1];
}


unset($record_lines);
// echo '<br>';


?>
<hr>

<div class="container">
	<h2>Yeast rRNA sequences</h2>
		<div class="card card-body">
			<?php
foreach($record_lines_header as $k => $h){
$short = shorten($record_lines_dna_seq["$k"], $record_lines_dna_seq["$k"], '90');//was 75 maybe make 2 columns or simple make 75 and hide all
$check = '';
if(($h['0']  == $_POST['DNAseq_name']) and ($_POST['dnaseq_radio'] !== 'dnaseq_userInput')){
$check = 'checked="checked"';
}
?>
			<div class="highlight">
				<div class="radio_span">
					<input name="dnaseq_radio" type="radio" value="
						<?php echo $h[0].'|'.$record_lines_dna_seq["$k"].'|'.'yeastdnaSeqs';?>" 
                 
						<?php echo $check;?> />
						<?php echo 	$h[0]; ?>
					</div>
					<div class="DNA_seq">
						<?php echo $short;?>
					</div>
				</div>
				<?php
}
?>
			</div>
		</div>
</div>
