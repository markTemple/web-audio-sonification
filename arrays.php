<?php

function makeTrackHeader(){
	$Motif_key = '';//new not sure if it should have a value?
	if($_POST['music_style'] !== 'no'){
		$music_style = explode('|',$_POST['music_style']);
		$_POST['tempo'] = 		$music_style[6];
		$_POST['duration'] = 	($_POST['division'] * $music_style[7])+1;
		$_POST['this2next'] = 	($_POST['division'] * $music_style[8]);
		}else{
	}
	$a['tempo'] = 		$_POST['tempo'];	// smaller is faster
	$a['duration'] = 	($_POST['division'] * $_POST['duration_ratio'])+1;//keep odd
	$a['this2next'] = 	($_POST['division'] * $_POST['t2t_factor']);
	$a['tracks'] = 		$_POST['tracks'];
	$a['chunks'] = 		$Motif_key	+1;
	$a['division'] =		$_POST['division']; //click for ONE bar, notes at 160 are triplets, 120 are quarter notes (4 per bar)?
	$a['TrkEnd'] = 		$_POST['TrkEnd'];
	$a['start_track'] = 	$_POST['start_track'];
	$a['on_vol'] = 		$_POST['on_vol'];
	$a['off_vol'] = 		$_POST['off_vol'];
	$a['quantize'] = 	$_POST['quantize'];
	return $a;
}

function makeMididataArray(){
	$rf_numb_count = range(1, $_POST['frameNum']);// strange but works
	foreach($rf_numb_count as $rf_numb){
		if($_POST['frameNum'] == 3){
			$mididata["$rf_numb"]['reading_frame'] = "\"Reading frame ".$rf_numb."\"";
		}
		elseif($_POST['frameNum'] == 1){
			$mididata["$rf_numb"]['reading_frame'] = "\"Protein (AA residues)\"";
		}
		elseif($_POST['frameNum'] == '2bp'){
			$mididata["$rf_numb"]['reading_frame'] = "\"Di-nucleotides\"";
		}
		elseif($_POST['frameNum'] == '1bp'){
			$mididata["$rf_numb"]['reading_frame'] = "\"Mono-nucleotides\"";
		}
		elseif($_POST['frameNum'] == '2bpx2'){
			$mididata["$rf_numb"]['reading_frame'] = "\"Di-nucleotides pairs ".$rf_numb."\"";
		}
		elseif($_POST['frameNum'] == '3bp'){
			$mididata["$rf_numb"]['reading_frame'] = "\"Sequence as tri-nucleotides\"";
		}
		$mididata[0]['reading_frame'] = "\"Motifs\"";
		$mididata["$rf_numb"]['rf_numb'] = $rf_numb;
		$mididata["$rf_numb"]['advance'] = $rf_numb * 160; // note position in each bar 160
		$mididata["$rf_numb"]['spacer'] = '|';
	}
	$mididata[0]['reading_frame'] = "\"Motifs\"";
	$mididata[0]['rf_numb'] = 0;
	$mididata[0]['advance'] = 160; // note position in each bar 160
	$mididata[0]['spacer'] = '|';

	if($_POST['music_style'] !== 'no'){
		$music_style = explode('|',$_POST['music_style']);
		$_POST['instra_groups_1'] = 	$music_style[0];
		$_POST['instra_groups_2'] = 	$music_style[1];
		$_POST['instra_groups_3'] = 	$music_style[2];
		$_POST['Instrument_Frame_1'] = 	$music_style[3];
		$_POST['Instrument_Frame_2'] = 	$music_style[4];
		$_POST['Instrument_Frame_3'] = 	$music_style[5];
		}else{
	}

	$mididata[1]['instr_numb'] = 	$_POST['Instrument_Frame_1'];
	$mididata[2]['instr_numb'] = 	$_POST['Instrument_Frame_2'];
	$mididata[3]['instr_numb'] = 	$_POST['Instrument_Frame_3'];
	$mididata[0]['instr_numb'] = 	0;

	$mididata[1]['channel_numb'] = 	1;
	$mididata[2]['channel_numb'] = 	2;
	$mididata[3]['channel_numb'] = 	3;
	$mididata[0]['channel_numb'] = 	10;

	$GMlist_array = Make_GM_Instrument_List();

	foreach($mididata as $rf_numb => $midi){
		foreach($GMlist_array as $instrument_group_name => $instrument_group_array){
			foreach($instrument_group_array as $instrument_number => $instrument_name){
				if($instrument_number == $midi['instr_numb']){
					$mididata["$rf_numb"]['instrument_name'] = $instrument_name;
				}
			}
		}
	}
	$mididata[0]['instrument_name'] = 'Drums from channel 10';// make new array fo list/use these????
	return $mididata;
}


function Make_codon2noteArray_scale(){
$array = array(
array(1,'GCA','Ala',1),
array(2,'GCC','Ala',1),
array(3,'GCG','Ala',1),
array(4,'GCT','Ala',1),
array(5,'AGA','Arg',2),
array(6,'AGG','Arg',2),
array(7,'CGA','Arg',2),
array(8,'CGC','Arg',2),
array(9,'CGG','Arg',2),
array(10,'CGT','Arg',2),
array(11,'AAC','Asn',3),
array(12,'AAT','Asn',3),
array(13,'GAC','Asp',4),
array(14,'GAT','Asp',4),
array(15,'TGC','Cys',5),
array(16,'TGT','Cys',5),
array(17,'CAA','Gln',6),
array(18,'CAG','Gln',6),
array(19,'GAA','Glu',7),
array(20,'GAG','Glu',7),
array(21,'GGA','Gly',8),
array(22,'GGC','Gly',8),
array(23,'GGG','Gly',8),
array(24,'GGT','Gly',8),
array(25,'CAC','His',9),
array(26,'CAT','His',9),
array(27,'ATA','Ile',10),
array(28,'ATC','Ile',10),
array(29,'ATT','Ile',10),
array(30,'CTA','Leu',11),
array(31,'CTC','Leu',11),
array(32,'CTG','Leu',11),
array(33,'CTT','Leu',11),
array(34,'TTA','Leu',11),
array(35,'TTG','Leu',11),
array(36,'AAA','Lys',12),
array(37,'AAG','Lys',12),
array(38,'ATG','Mt*',13),
array(39,'TTC','Phe',14),
array(40,'TTT','Phe',14),
array(41,'CCA','Pro',15),
array(42,'CCC','Pro',15),
array(43,'CCG','Pro',15),
array(44,'CCT','Pro',15),
array(45,'AGC','Ser',16),
array(46,'AGT','Ser',16),
array(47,'TCA','Ser',16),
array(48,'TCC','Ser',16),
array(49,'TCG','Ser',16),
array(50,'TCT','Ser',16),
array(51,'TAA','ST*',17),
array(52,'TAG','ST*',17),
array(53,'TGA','ST*',17),
array(54,'ACA','Thr',18),
array(55,'ACC','Thr',18),
array(56,'ACG','Thr',18),
array(57,'ACT','Thr',18),
array(58,'TGG','Trp',19),
array(59,'TAC','Tyr',20),
array(60,'TAT','Tyr',20),
array(61,'GTA','Val',21),
array(62,'GTC','Val',21),
array(63,'GTG','Val',21),
array(64,'GTT','Val',21));
return $array;
}

function Make_monoBP_2noteArray_scale(){
$array = array(
array(1,'G','xxx',1),
array(2,'A','xxx',2),
array(3,'T','xxx',3),
array(4,'C','xxx',4)
);
return $array;
}

function Make_diBP_2noteArray_scale(){
$array = array(
array(1,'GG','xxx',1),
array(2,'GA','xxx',2),
array(3,'GT','xxx',3),
array(4,'GC','xxx',4),
array(5,'AG','xxx',5),
array(6,'AA','xxx',6),
array(7,'AT','xxx',7),
array(8,'AC','xxx',8),
array(9,'TG','xxx',9),
array(10,'TA','xxx',10),
array(11,'TT','xxx',11),
array(12,'TC','xxx',12),
array(13,'CG','xxx',13),
array(14,'CA','xxx',14),
array(15,'CT','xxx',15),
array(16,'CC','xxx',16)
);
return $array;
}

function Make_triBP_2noteArray_scale(){
$array = array(
array(1,'GCA','xxx',1),
array(2,'GCC','xxx',2),
array(3,'GCG','xxx',3),
array(4,'GCT','xxx',4),
array(5,'AGA','xxx',5),
array(6,'AGG','xxx',6),
array(7,'CGA','xxx',7),
array(8,'CGC','xxx',8),
array(9,'CGG','xxx',9),
array(10,'CGT','xxx',10),
array(11,'AAC','xxx',11),
array(12,'AAT','xxx',12),
array(13,'GAC','xxx',13),
array(14,'GAT','xxx',14),
array(15,'TGC','xxx',15),
array(16,'TGT','xxx',16),
array(17,'CAA','xxx',17),
array(18,'CAG','xxx',18),
array(19,'GAA','xxx',19),
array(20,'GAG','xxx',20),
array(21,'GGA','xxx',21),
array(22,'GGC','xxx',22),
array(23,'GGG','xxx',23),
array(24,'GGT','xxx',24),
array(25,'CAC','xxx',25),
array(26,'CAT','xxx',26),
array(27,'ATA','xxx',27),
array(28,'ATC','xxx',28),
array(29,'ATT','xxx',29),
array(30,'CTA','xxx',30),
array(31,'CTC','xxx',31),
array(32,'CTG','xxx',32),
array(33,'CTT','xxx',33),
array(34,'TTA','xxx',34),
array(35,'TTG','xxx',35),
array(36,'AAA','xxx',36),
array(37,'AAG','xxx',37),
array(38,'ATG','xxx',38),
array(39,'TTC','xxx',39),
array(40,'TTT','xxx',40),
array(41,'CCA','xxx',41),
array(42,'CCC','xxx',42),
array(43,'CCG','xxx',43),
array(44,'CCT','xxx',44),
array(45,'AGC','xxx',45),
array(46,'AGT','xxx',46),
array(47,'TCA','xxx',47),
array(48,'TCC','xxx',48),
array(49,'TCG','xxx',49),
array(50,'TCT','xxx',50),
array(51,'TAA','xxx',51),
array(52,'TAG','xxx',52),
array(53,'TGA','xxx',53),
array(54,'ACA','xxx',54),
array(55,'ACC','xxx',55),
array(56,'ACG','xxx',56),
array(57,'ACT','xxx',57),
array(58,'TGG','xxx',58),
array(59,'TAC','xxx',59),
array(60,'TAT','xxx',60),
array(61,'GTA','xxx',61),
array(62,'GTC','xxx',62),
array(63,'GTG','xxx',63),
array(64,'GTT','xxx',64));
return $array;
}

// Each MIDI note is assigned to a note
function midiNumb2note(){

$array = array(
0=>'C',1=>'Db',2=>'D',3=>'Eb',4=>'E',5=>'F',6=>'Gb',7=>'G',8=>'Ab',9=>'A',10=>'Bb',11=>'B',12=>'C',13=>'Db',14=>'D',15=>'Eb',16=>'E',17=>'F',18=>'Gb',19=>'G',20=>'Ab',21=>'A',22=>'Bb',23=>'B',24=>'C',25=>'Db',26=>'D',27=>'Eb',28=>'E',29=>'F',30=>'Gb',31=>'G',32=>'Ab',33=>'A',34=>'Bb',35=>'B',36=>'C',37=>'Db',38=>'D',39=>'Eb',40=>'E',41=>'F',42=>'Gb',43=>'G',44=>'Ab',45=>'A',46=>'Bb',47=>'B',48=>'C',49=>'Db',50=>'D',51=>'Eb',52=>'E',53=>'F',54=>'Gb',55=>'G',56=>'Ab',57=>'A',58=>'Bb',59=>'B',60=>'C',61=>'Db',62=>'D',63=>'Eb',64=>'E',65=>'F',66=>'Gb',67=>'G',68=>'Ab',69=>'A',70=>'Bb',71=>'B',72=>'C',73=>'Db',74=>'D',75=>'Eb',76=>'E',77=>'F',78=>'Gb',79=>'G',80=>'Ab',81=>'A',82=>'Bb',83=>'B',84=>'C',85=>'Db',86=>'D',87=>'Eb',88=>'E',89=>'F',90=>'Gb',91=>'G',92=>'Ab',93=>'A',94=>'Bb',95=>'B',96=>'C',97=>'Db',98=>'D',99=>'Eb',100=>'E',101=>'F',102=>'Gb',103=>'G',104=>'Ab',105=>'A',106=>'Bb',107=>'B',108=>'C',109=>'Db',110=>'D',111=>'Eb',112=>'E',113=>'F',114=>'Gb',115=>'G',116=>'Ab',117=>'A',118=>'Bb',119=>'B',120=>'C',121=>'Db',122=>'D',123=>'Eb',124=>'E',125=>'F',126=>'Gb',127=>'G');

return $array;
}

//key = instrument number eg. 0 -> grand piano uses notes 21 to 108 etc
//use this to keep instru in good sounding range
function getInstuRange($instraNumb){

$instru_2noteRange = array(
0=>'12,108',1=>'24,108',2=>'24,108',3=>'36,108',4=>'24,103',5=>'24,103',6=>'36,89',7=>'36,96',8=>'48,108',9=>'72,108',10=>'48,84',11=>'48,89',12=>'48,84',13=>'60,96',14=>'48,77',15=>'48,84',16=>'36,96',17=>'36,96',18=>'36,96',19=>'24,108',20=>'36,108',21=>'48,89',22=>'48,84',23=>'48,89',24=>'36,84',25=>'36,84',26=>'36,86',27=>'36,86',28=>'24,86',29=>'36,86',30=>'36,86',31=>'36,86',32=>'24,55',33=>'24,55',34=>'24,55',35=>'24,55',36=>'24,55',37=>'24,55',38=>'24,55',39=>'24,55',40=>'48,96',41=>'48,84',42=>'48,72',43=>'36,55',44=>'36,96',45=>'36,96',46=>'36,103',47=>'36,57',48=>'36,96',49=>'24,96',50=>'36,96',51=>'36,96',52=>'48,79',53=>'48,79',54=>'36,84',55=>'36,72',56=>'48,94',57=>'24,75',58=>'24,55',59=>'48,82',60=>'36,77',61=>'36,96',62=>'36,96',63=>'36,96',64=>'48,87',65=>'48,80',66=>'36,75',67=>'36,68',68=>'48,91',69=>'48,81',70=>'24,72',71=>'48,91',72=>'60,108',73=>'48,96',74=>'48,96',75=>'48,96',76=>'48,96',77=>'48,84',78=>'48,96',79=>'48,84');

return $instru_2noteRange["$instraNumb"];
}

function Make_GM_Instrument_List(){
$array=array(

  "Piano" =>array
    (
    0 =>"Acoustic Grand Piano",
    "Bright Acoustic Piano",
    "Electric Grand Piano",
    "Honky-tonk Piano",
    "Electric Piano 1",
    "Electric Piano 2",
    "Harpsichord",
    "Clavinet"
    ),

   "Chromatic Percussion" =>array
    (
     8=>"Celesta",
    "Glockenspiel",
    "Music Box",
    "Vibraphone",
    "Marimba",
    "Xylophone",
    "Tubular Bells",
    "Dulcimer"
    ),

    "Organ" =>array
    (
    16=>"Drawbar Organ",
    "Percussive Organ",
    "Rock Organ",
    "Church Organ",
    "Reed Organ",
    "Accordion",
    "Harmonica",
    "Tango Accordion"
    ),

    "Guitar" =>array
    (
    24=>"Acoustic Guitar (nylon)",
    "Acoustic Guitar (steel)",
    "Electric Guitar (jazz)",
    "Electric Guitar (clean)",
    "Electric Guitar (muted)",
    "Overdriven Guitar",
    "Distortion Guitar",
    "Guitar harmonics"
    ),

    "Bass" =>array
    (
    32=>"Acoustic Bass",
    "Electric Bass (finger)",
    "Electric Bass (pick)",
    "Fretless Bass",
    "Slap Bass 1",
    "Slap Bass 2",
    "Synth Bass 1",
    "Synth Bass 2"
    ),

    "Strings" =>array(
    40=>"Violin",
    "Viola",
    "Cello",
    "Contrabass",
    "Tremolo Strings",
    "Pizzicato Strings",
    "Orchestral Harp",
    "Timpani"
    ),

    "Ensemble" =>array(
    48=>"String Ensemble 1",
    "String Ensemble 2",
    "Synth Strings 1",
    "Synth Strings 2",
    "Choir Aahs",
    "Voice Oohs",
    "Synth Voice",
    "Orchestra Hit"
    ),

    "Brass " =>array(
    56=>"Trumpet",
    "Trombone",
    "Tuba",
    "Muted Trumpet",
    "French Horn",
    "Brass Section",
    "Synth Brass 1",
    "Synth Brass 2"
    ),

    "Reed" =>array(
    64=>"Soprano Sax",
    "Alto Sax",
    "Tenor Sax",
    "Baritone Sax",
    "Oboe",
    "English Horn",
    "Bassoon",
    "Clarinet"
    ),

    "Pipe" =>array(
    72=>"Piccolo",
    "Flute",
    "Recorder",
    "Pan Flute",
    "Blown Bottle",
    "Shakuhachi",
    "Whistle",
    "Ocarina"
    ),

    "Synth Lead" =>array(
    80=>"Lead 1 (square)",
    "Lead 2 (sawtooth)",
    "Lead 3 (calliope)",
    "Lead 4 (chiff)",
    "Lead 5 (charang)",
    "Lead 6 (voice)",
    "Lead 7 (fifths)",
    "Lead 8 (bass + lead)"
    ),

    "Synth Pad" =>array(
    88=>"Pad 1 (new age)",
    "Pad 2 (warm)",
    "Pad 3 (polysynth)",
    "Pad 4 (choir)",
    "Pad 5 (bowed)",
    "Pad 6 (metallic)",
    "Pad 7 (halo)",
    "Pad 8 (sweep)"
    ),

    "Synth Effects" =>array(
    96
    =>"FX 1 (rain)",
    "FX 2 (soundtrack)",
    "FX 3 (crystal)",
    "FX 4 (atmosphere)",
    "FX 5 (brightness)",
    "FX 6 (goblins)",
    "FX 7 (echoes)",
    "FX 8 (sci-fi)"
    ),

    "Ethnic" =>array(
    104=>"Sitar",
    "Banjo",
    "Shamisen",
    "Koto",
    "Kalimba",
    "Bag pipe",
    "Fiddle",
    "Shanai"
    ),

    "Percussive" =>array(
    112=>"Tinkle Bell",
    "Agogo",
    "Steel Drums",
    "Woodblock",
    "Taiko Drum",
    "Melodic Tom",
    "Synth Drum",
    "Reverse Cymbal"
    ),

    "Sound Effects" =>array(
    120=>"Guitar Fret Noise",
    "Breath Noise",
    "Seashore",
    "Bird Tweet",
    "Telephone Ring",
    "Helicopter",
    "Applause",
    "Gunshot"
    )
);
return $array;
}


function make_scale(){
	$array=array(
		1 => array('major', 'Major scale'),
		2 => array('major_pentatonic', 'Major pentatonic scale'),
		3 => array('minor_pentatonic', 'Minor pentatonic scale'),
		4 => array('natural_minor', 'Natural minor scale'),
		5 => array('harmonic_minor', 'Harmonic minor scale'),
		6 => array('melodic_minor', 'Melodic minor scale'),
		7 => array('blues', 'Blues scale'),
		8 => array('semitone', 'Semitone intervals'),
		9 => array('whole_notes', 'Whole notes intervals'),
		10 => array('three_semitones', 'Three semitone intervals')
	);
return $array;
}

function make_key2play(){
	$array=array(
	1 => array('-3', 'A '),
	2 => array('-2', 'A#'),
	3 => array('-1', 'B'),
	4 => array('0', 'C'),
	5 => array('1', 'C#'),
	6 => array('2', 'D'),
	7 => array('3', 'D#'),
	8 => array('4', 'E'),
	9 => array('5', 'F'),
	10 => array('6', 'F#'),
	11 => array('7', 'G'),
	12 => array('8', 'G#')
	);
return $array;
}

function make_plug(){
	$array=array(
	1 => array("qt", 'Play with quicktime'),
	2 => array("wm", 'Play with windows media')//,
//	3 => array("jv", 'Play with java-applet'),
//	4 => array("bk", 'Play with beatnik')
	);
return $array;
}

function make_on_vol(){
	$array=array(
	1 => array('40', 'quiet'),
	2 => array('80', 'moderate'),
	3 => array('120', 'loud')
	);
return $array;
}

function make_quantize(){
	$array=array(
	1 => array('do_not_adjust', 'Yes'),
	2 => array('adjust', 'No')
	);
return $array;
}

function make_sonify_motif(){
	$array=array(
	1 => array('yes', 'yes'),
	2 => array('no', 'no')
	);
return $array;
}

function make_frameNum(){
	$array=array(
	1 => array('3', 'Reading frame codons'),
	2 => array('1', 'Protein sequence'),
	3 => array('3bp', 'Tri-nucleotides'),
	4 => array('2bpx2', 'Di-nucleotide pairs'),
	5 => array('2bp', 'Di-nucleotides'),
	6 => array('1bp', 'Mono-nucleotides')
	);
return $array;
}

function make_stopstart(){
$array=array(
	1 => array('silent', 'Silent until ATG'),
	2 => array('strict', 'Restart on ATG'),
	3 => array('yes', 'Restart after 10 codons'),
	4 => array('no', 'Ignore Start/Stop')
	);
return $array;
}

function make_music_style(){
$array=array(
	1 => array('no', 'none'),
	2 => array('0|3|1|1|28|14|500000|0.25|1', 'Default'),
	3 => array('1|1|1|9|11|13|300000|.5|.333', 'Chromatic Perc'),
	4 => array('11|11|11|95|89|92|7500000|4|0.333', 'Drone'),
	5 => array('5|5|5|40|42|48|400000|2|1', 'Strings'),
	6 => array('0|0|0|3|1|2|400000|0.5|0.666', 'Barrelhouse'),
	7 => array('13|13|9|104|107|77|500000|5|1', 'Ethnic'),
	8 => array('6|6|5|52|53|47|1000000|3|1', 'Ohh Aahhs'),
	9 => array('14|14|14|113|115|117|500000|1|1', 'Percussive'),
	10 => array('0|0|11|0|0|88|7500000|2|1.333', 'New Age')
	);
return $array;
}

function make_tempo(){
$array=array(
	1 => array('10000000', 'slow'),
	2 => array('500002', 'slower'),
	3 => array('500000', 'medium'),
	4 => array('400000', 'faster'),
	5 => array('300000', 'fast')
	);
return $array;
}

function make_duration_ratio(){
$array=array(
	1 => array('0.25', 'short'),
	2 => array('1', 'medium'),
	3 => array('8','long')
	//1 => array('0.25', 'quarter'),
	//2 => array('0.5', 'half'),
	//3 => array('1', 'one'),
	//4 => array('2', 'two'),
	//5 => array('4', 'four'),
	//6 => array('8','eight')
	);
return $array;
}

function make_t2t_factor(){
$array=array(
	1 => array('0.333', 'Scramble'),
	2 => array('0.666', 'Syncopate'),
	3 => array('1', 'Triplets'),
	4 => array('1.333', 'Triplets plus rest')
	);
return $array;
}

function make_Instrument(){
$array=array(
	array('0', 'Acoustic Grand Piano'),
	array('1', 'Bright Acoustic Piano'),
	array('2', 'Electric Grand Piano'),
	array('3', 'Honky-tonk Piano'),
	array('4', 'Electric Piano 1'),
	array('5', 'Electric Piano 2'),
	array('6', 'Harpsichord'),
	array('7', 'Clavinet'),
	array('8', 'Celesta'),
	array('9', 'Glockenspiel'),
	array('10', 'Music Box'),
	array('11', 'Vibraphone'),
	array('12', 'Marimba'),
	array('13', 'Xylophone'),
	array('14', 'Tubular Bells'),
	array('15', 'Dulcimer'),
	array('16', 'Drawbar Organ'),
	array('17', 'Percussive Organ'),
	array('18', 'Rock Organ'),
	array('19', 'Church Organ'),
	array('20', 'Reed Organ'),
	array('21', 'Accordion'),
	array('22', 'Harmonica'),
	array('23', 'Tango Accordion'),
	array('24', 'Acoustic Guitar (nylon)'),
	array('25', 'Acoustic Guitar (steel)'),
	array('26', 'Electric Guitar (jazz)'),
	array('27', 'Electric Guitar (clean)'),
	array('28', 'Electric Guitar (muted)'),
	array('29', 'Overdriven Guitar'),
	array('30', 'Distortion Guitar'),
	array('31', 'Guitar harmonics'),
	array('32', 'Acoustic Bass'),
	array('33', 'Electric Bass (finger)'),
	array('34', 'Electric Bass (pick)'),
	array('35', 'Fretless Bass'),
	array('36', 'Slap Bass 1'),
	array('37', 'Slap Bass 2'),
	array('38', 'Synth Bass 1'),
	array('39', 'Synth Bass 2'),
	array('40', 'Violin'),
	array('41', 'Viola'),
	array('42', 'Cello'),
	array('43', 'Contrabass'),
	array('44', 'Tremolo Strings'),
	array('45', 'Pizzicato Strings'),
	array('46', 'Orchestral Harp'),
	array('47', 'Timpani'),
	array('48', 'String Ensemble 1'),
	array('49', 'String Ensemble 2'),
	array('50', 'Synth Strings 1'),
	array('51', 'Synth Strings 2'),
	array('52', 'Choir Aahs'),
	array('53', 'Voice Oohs'),
	array('54', 'Synth Voice'),
	array('55', 'Orchestra Hit'),
	array('56', 'Trumpet'),
	array('57', 'Trombone'),
	array('58', 'Tuba'),
	array('59', 'Muted Trumpet'),
	array('60', 'French Horn'),
	array('61', 'Brass Section'),
	array('62', 'Synth Brass 1'),
	array('63', 'Synth Brass 2'),
	array('64', 'Soprano Sax'),
	array('65', 'Alto Sax'),
	array('66', 'Tenor Sax'),
	array('67', 'Baritone Sax'),
	array('68', 'Oboe'),
	array('69', 'English Horn'),
	array('70', 'Bassoon'),
	array('71', 'Clarinet'),
	array('72', 'Piccolo'),
	array('73', 'Flute'),
	array('74', 'Recorder'),
	array('75', 'Pan Flute'),
	array('76', 'Blown Bottle'),
	array('77', 'Shakuhachi'),
	array('78', 'Whistle'),
	array('79', 'Ocarina'),
	array('80', 'Lead 1 (square)'),
	array('81', 'Lead 2 (sawtooth)'),
	array('82', 'Lead 3 (calliope)'),
	array('83', 'Lead 4 (chiff)'),
	array('84', 'Lead 5 (charang)'),
	array('85', 'Lead 6 (voice)'),
	array('86', 'Lead 7 (fifths)'),
	array('87', 'Lead 8 (bass + lead)'),
	array('88', 'Pad 1 (new age)'),
	array('89', 'Pad 2 (warm)'),
	array('90', 'Pad 3 (polysynth)'),
	array('91', 'Pad 4 (choir)'),
	array('92', 'Pad 5 (bowed)'),
	array('93', 'Pad 6 (metallic)'),
	array('94', 'Pad 7 (halo)'),
	array('95', 'Pad 8 (sweep)'),
	array('96', 'FX 1 (rain)'),
	array('97', 'FX 2 (soundtrack)'),
	array('98', 'FX 3 (crystal)'),
	array('99', 'FX 4 (atmosphere)'),
	array('100', 'FX 5 (brightness)'),
	array('101', 'FX 6 (goblins)'),
	array('102', 'FX 7 (echoes)'),
	array('103', 'FX 8 (sci-fi)'),
	array('104', 'Sitar'),
	array('105', 'Banjo'),
	array('106', 'Shamisen'),
	array('107', 'Koto'),
	array('108', 'Kalimba'),
	array('109', 'Bag pipe'),
	array('110', 'Fiddle'),
	array('111', 'Shanai'),
	array('112', 'Tinkle Bell'),
	array('113', 'Agogo'),
	array('114', 'Steel Drums'),
	array('115', 'Woodblock'),
	array('116', 'Taiko Drum'),
	array('117', 'Melodic Tom'),
	array('118', 'Synth Drum'),
	array('119', 'Reverse Cymbal'),
	array('120', 'Guitar Fret Noise'),
	array('121', 'Breath Noise'),
	array('122', 'Seashore'),
	array('123', 'Bird Tweet'),
	array('124', 'Telephone Ring'),
	array('125', 'Helicopter'),
	array('126', 'Applause'),
	array('127', 'Gunshot')
	);
return $array;
}
?>
