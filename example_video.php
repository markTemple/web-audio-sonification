<?php
include("header.php");
include("./functions.php");
include("sonify.java");
?>


<!-- <div class="container-fluid"> -->
<div class="container">
<div class="row">
    <div class="boarderbox col-md-6">
    <h2>An artificial test DNA sequence</h2>
    <p>A sequence of (GGG)n with three stop codons added, each in a different reading frame. As each Stop codon is passed the instsrument representing the reading frame stops playing. Stop codons are used in biology to halt translation (in process of gene expression to make a protein) and may indicate the end of a gene coding sequence. </p>
    <div class="video-wrap">
    <div class="video-container">
    <iframe width="560" height="349" src="https://www.youtube.com/embed/MMzd78C6yNQ?rel=0&autohide=1&showinfo=0" frameborder="0"> </iframe>
    </div>
    </div>
    <p>This simple mononucleotide sequence is useful to understanding the sonification output and highlights the characteristic triplet note phrasing which is the basis of the subsequent auditory displays. Since the same codon motif occurs in each reading frame the same note is played on each of three instruments giving rise to a highly repetitive pattern. As each Stop codon (TAA) is passed it causes an instrument to stop playing, the audio ends in silence. </p>
  </div>

  <div class="boarderbox col-md-6">
    <h2>An artificial test DNA sequence</h2>
    <p>A sequence of (GGG)n with three Start codons added, each in a different reading frame. As each Start codon is passed the instsrument representing the reading frame Starts playing. Start codons may be used in biology to signal the start site of translation (in the process of gene expression to make a protein) and may indicate the beginning of a gene coding sequence. </p>
    <div class="video-wrap">
    <div class="video-container">
    <iframe width="560" height="349" src="https://www.youtube.com/embed/nsUl-7SvD3M?rel=0&autohide=1&showinfo=0" frameborder="0"> </iframe>
    </div>
    </div>
    <p>Notice how the audio is silent until the occurence of a Start codon in a the second reading frame that triggers the guitar to play. Subsequent Start codons turn on the audio of the other reading frames in which they occur. Also notice how the change in sequence from the ggg codon to gga,gat,atg and tgg codons causes a flutter of notes that is distinct from the mono-tonal note that represents ggg. </p>
  </div>

  <div class="boarderbox col-md-6">
    <h2>An repetitive DNA sequence</h2>
    <p>Homo sapiens chromosome 22 terminal deletion breakpoint region sequence, telomere-junction (22q13.3) GenBank: AJ277167.1</p>
    <div class="video-wrap">
    <div class="video-container">
    <iframe width="560" height="349" src="https://www.youtube.com/embed/6UF1pTmxw1A?rel=0&autohide=1&showinfo=0" frameborder="0"> </iframe>
    </div>
    </div>
    <p>The first half of this sequence represents a more complex and naturally occuring DNA sequence. In this example the algorthm options were chosen to ignore Start and Stop codons (since this sequence is not a coding sequence). The second half of this squence contains the telomer repeat sequences (which are features found at the ends of the chromosomes). The telomer repeats (TTAGGG) give rise to a repetitive audio pattern (possibly a more harmonic or melodic phrase?) that is easily discerned. Within this repetitive sequence there is a single nucleotide change (mutation). The absence of this single nucleotide (in this instance a missing 'T' base/nucleotide) causes both a flutter of notes and a shift in the voicing of the repeat sequence. </p>
  </div>

  <div class="boarderbox col-md-6">
    <h2>Coding Sequence</h2>
    <p>Homo sapiens v-Ha-ras Harvey rat sarcoma viral oncogene homolog mRNA, complete cds GenBank: BT019421.1</p>
    <div class="video-wrap">
    <div class="video-container">
    <iframe width="560" height="349" src="https://www.youtube.com/embed/1x5sVxAASMo?rel=0&autohide=1&showinfo=0" frameborder="0"> </iframe>
    </div>
    </div>
    <p>This sequence represents a gene coding sequence. At the beginning of the sequence all reading frames are audible. The first frame (piano), is the open reading frame, that contains no stop codons and is audible throughout. The ocurence of a stop codon immediatley in the second reading frame and another in the third frame resuls in a solo piano or piano accompanied by other instrument combinations. This is expected since a coding sequence is defined by a reading frame in which stop codons are absent. Additionally, an option was chosen to sonify Start and Stop codons as percussive instruments to further highlight their occurence. The Start codon (ATG) was additionally sonified with an electric snare and Stop codons with cymbals. </p>
  </div>
</div>
</div>

<?php
include("footer.php");?>
