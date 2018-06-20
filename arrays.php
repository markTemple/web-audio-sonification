<?php

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
		$mididata["$rf_numb"]['rf_numb'] = $rf_numb;
	}

	$mididata[1]['instr_numb'] = 	$_POST['Instrument_Frame_1'];
	$mididata[2]['instr_numb'] = 	$_POST['Instrument_Frame_2'];
	$mididata[3]['instr_numb'] = 	$_POST['Instrument_Frame_3'];

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
array(1,'GCA','xxx',7),
array(2,'GCC','xxx',8),
array(3,'GCG','xxx',9),
array(4,'GCT','xxx',22),
array(5,'AGA','xxx',23),
array(6,'AGG','xxx',24),
array(7,'CGA','xxx',25),
array(8,'CGC','xxx',26),
array(9,'CGG','xxx',27),
array(10,'CGT','xxx',28),
array(11,'AAC','xxx',29),
array(12,'AAT','xxx',30),
array(13,'GAC','xxx',31),
array(14,'GAT','xxx',32),
array(15,'TGC','xxx',33),
array(16,'TGT','xxx',34),
array(17,'CAA','xxx',35),
array(18,'CAG','xxx',36),
array(19,'GAA','xxx',37),
array(20,'GAG','xxx',38),
array(21,'GGA','xxx',39),
array(22,'GGC','xxx',40),
array(23,'GGG','xxx',41),
array(24,'GGT','xxx',42),
array(25,'CAC','xxx',43),
array(26,'CAT','xxx',44),
array(27,'ATA','xxx',45),
array(28,'ATC','xxx',46),
array(29,'ATT','xxx',47),
array(30,'CTA','xxx',48),
array(31,'CTC','xxx',49),
array(32,'CTG','xxx',50),
array(33,'CTT','xxx',51),
array(34,'TTA','xxx',52),
array(35,'TTG','xxx',53),
array(36,'AAA','xxx',54),
array(37,'AAG','xxx',55),
array(38,'ATG','xxx',56),
array(39,'TTC','xxx',57),
array(40,'TTT','xxx',58),
array(41,'CCA','xxx',59),
array(42,'CCC','xxx',60),
array(43,'CCG','xxx',61),
array(44,'CCT','xxx',62),
array(45,'AGC','xxx',63),
array(46,'AGT','xxx',64),
array(47,'TCA','xxx',65),
array(48,'TCC','xxx',66),
array(49,'TCG','xxx',67),
array(50,'TCT','xxx',68),
array(51,'TAA','xxx',69),
array(52,'TAG','xxx',70),
array(53,'TGA','xxx',71),
array(54,'ACA','xxx',72),
array(55,'ACC','xxx',73),
array(56,'ACG','xxx',74),
array(57,'ACT','xxx',75),
array(58,'TGG','xxx',76),
array(59,'TAC','xxx',77),
array(60,'TAT','xxx',78),
array(61,'GTA','xxx',79),
array(62,'GTC','xxx',80),
array(63,'GTG','xxx',81),
array(64,'GTT','xxx',82));
return $array;
}

// Each MIDI note is assigned to a note
function midiNumb2note(){
  $array = array(
  0=>'C',1=>'Db',2=>'D',3=>'Eb',4=>'E',5=>'F',6=>'Gb',7=>'G',8=>'Ab',9=>'A',10=>'Bb',11=>'B',12=>'C',13=>'Db',14=>'D',15=>'Eb',16=>'E',17=>'F',18=>'Gb',19=>'G',20=>'Ab',21=>'A',22=>'Bb',23=>'B',24=>'C',25=>'Db',26=>'D',27=>'Eb',28=>'E',29=>'F',30=>'Gb',31=>'G',32=>'Ab',33=>'A',34=>'Bb',35=>'B',36=>'C',37=>'Db',38=>'D',39=>'Eb',40=>'E',41=>'F',42=>'Gb',43=>'G',44=>'Ab',45=>'A',46=>'Bb',47=>'B',48=>'C',49=>'Db',50=>'D',51=>'Eb',52=>'E',53=>'F',54=>'Gb',55=>'G',56=>'Ab',57=>'A',58=>'Bb',59=>'B',60=>'C',61=>'Db',62=>'D',63=>'Eb',64=>'E',65=>'F',66=>'Gb',67=>'G',68=>'Ab',69=>'A',70=>'Bb',71=>'B',72=>'C',73=>'Db',74=>'D',75=>'Eb',76=>'E',77=>'F',78=>'Gb',79=>'G',80=>'Ab',81=>'A',82=>'Bb',83=>'B',84=>'C',85=>'Db',86=>'D',87=>'Eb',88=>'E',89=>'F',90=>'Gb',91=>'G',92=>'Ab',93=>'A',94=>'Bb',95=>'B',96=>'C',97=>'Db',98=>'D',99=>'Eb',100=>'E',101=>'F',102=>'Gb',103=>'G',104=>'Ab',105=>'A',106=>'Bb',107=>'B',108=>'C',109=>'Db',110=>'D',111=>'Eb',112=>'E',113=>'F',114=>'Gb',115=>'G',116=>'Ab',117=>'A',118=>'Bb',119=>'B',120=>'C',121=>'Db',122=>'D',123=>'Eb',124=>'E',125=>'F',126=>'Gb',127=>'G');
  return $array;
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
    "Woodblock",
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

// function make_scale(){
// 	$array=array(
// 		1 => array('major', 'Major scale'),
// 		2 => array('major_pentatonic', 'Major pentatonic scale'),
// 		3 => array('minor_pentatonic', 'Minor pentatonic scale'),
// 		4 => array('natural_minor', 'Natural minor scale'),
// 		5 => array('harmonic_minor', 'Harmonic minor scale'),
// 		6 => array('melodic_minor', 'Melodic minor scale'),
// 		7 => array('blues', 'Blues scale'),
// 		8 => array('semitone', 'Semitone intervals'),
// 		9 => array('whole_notes', 'Whole notes intervals'),
// 		10 => array('three_semitones', 'Three semitone intervals')
// 	);
// return $array;
// }

// function make_key2play(){
// 	$array=array(
// 	1 => array('-3', 'A '),
// 	2 => array('-2', 'A#'),
// 	3 => array('-1', 'B'),
// 	4 => array('0', 'C'),
// 	5 => array('1', 'C#'),
// 	6 => array('2', 'D'),
// 	7 => array('3', 'D#'),
// 	8 => array('4', 'E'),
// 	9 => array('5', 'F'),
// 	10 => array('6', 'F#'),
// 	11 => array('7', 'G'),
// 	12 => array('8', 'G#')
// 	);
// return $array;
// }

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

?>