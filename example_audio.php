<?php
include("header.php");
include("./functions.php");
include("sonify.java");
?>
<!-- <div class="container-fluid"> -->
<div class="container">
  <div class="boarderbox col-md-12">
  <h1>Audio examples</h1><hr>
    <h2>
    G Sequence</h2>
    <p>An artificial test DNA sequence that consists (GGG)n: </p>

    <table class="box-table-a" summary="DNA sequence">
        <tr>
            <td>
                <p class="DNA_seq">
                    GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
                </p>
            </td>
        </tr>
    </table><div class="card card-body">

    <h3>G sequence<br>(default settings)</h3>
    <audio controls>
        <source src="./example_mp3/01 G Sequence (default).mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio></div>

    <p>This simple mononucleotide sequence is useful to understanding the sonification output and highlights the characteristic triplet note phrasing which is the basis of the subsequent auditory displays. Since the same codon motif occurs in each reading frame the same note is played on each of three instruments giving rise to a highly repetitive pattern. Additionally, no disruption to either instrument occurs which highlights that the sequence contains no start or stop codons. </p>
  </div>
  <div class="boarderbox col-md-12">
    <h2>
    Mutated G Sequence</h2>
    <p>Test DNA sequence (GGG)n with a G->T point mutation: </p>

    <table class="box-table-a" summary="DNA sequence">
        <tr>
            <td>
                <p class="DNA_seq">
                    GGGGGGGGGGGGGGG<b>T</b>GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
                </p>
            </td>
        </tr>
    </table><div class="card card-body">
    <h3>

    Mutated G Sequence<br>(default settings)</h3>

    <audio controls>
        <source src="./example_mp3/Mutated G Sequence.mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio></div>
    <p>The introduction of a point mutation into the 'G Sequence' causes only a transient change of one note of each reading frame/instrument (i.e. a change of up to three notes in one triplet, allowing for degeneracy in the genetic code). This is exemplified by a pronounced change in the auditory display of the ‘Mutated G Sequence’ at approx. 3 seconds from the start, no further change is evident. The mutation in this simple sequence is clearly heard through sonification. </p>
  </div>
  <div class="boarderbox col-md-12">
    <h2>
    G Sequence with STOP in the 1st Reading Frame</h2>
    <p>The sequence is similar to the (GGG)n except for the stop codon: </p>

    <table class="box-table-a" summary="DNA sequence">
        <tr>
            <td>
                <p class="DNA_seq">
                    GGGGGGGGGGGGGGG<b>TAA</b>GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
                </p>
            </td>
        </tr>
    </table><div class="card card-body">

    <h3>
    STOP in the 1st reading frame<br>(default settings)</h3>

    <audio controls>
        <source src="./example_mp3/02 STOP in 1st Reading Frame (default).mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio></div>
    <p>This sounds the same as the 'G Sequence' until the stop codon is played (at about 3 seconds from the beginning).This stop codon occurs in the first reading frame which maps to instrument 1 (piano) and therefor it becomes silent for the remainder of the sonification. Following the stop codon the characteristic triplet note phrasing is replaced by a two note phrasing for the remainder of the auditory display (remember that its now missing the piano) with a rest beat in place of the absent audio. <br>The stop codon itself (TAA) is silent in frame one (as is the remainder of that frame) whereas in frames two and three it overlaps two bases into AAG and one base into AGG, respectively (remember we are moving along the sequence one base at a time) and gives rise to two distinct notes before the reoccurrence of GGG. </p>
  </div>
  <div class="boarderbox col-md-12">
    <h2>
    G Sequence with STOP in all Reading Frames</h2>
    <p>Again similar to the (GGG)n but with stop codons in all frames: </p>
    <table class="box-table-a" summary="DNA sequence">
        <tr>
            <td>
                <p class="DNA_seq">
                    GGGGGGGGGGGGGGG<b>TAA</b>G<b>TAA</b>G<b>TAA</b>GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
                </p>
            </td>
        </tr>
    </table><div class="card card-body">
    <h3>

    STOP in  all reading frames<br>(default settings)</h3>

    <audio controls>
        <source src="./example_mp3/03a STOP in All Reading Frames (default).mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio>
    <h3>(Restart after 10 codons)</h3>
    <audio controls>
        <source src="./example_mp3/03b STOP in All Reading Frames (Restart after 10 codons).mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio></div></div>
    <p>Same as above until the stop codons are parsed, beyond this point (approx. 4 seconds) the audio streams from all reading frames becomes silent for the remainder of the sonification. In the second sonification of this sequence, the 'Restart after 10 codons' option was selected which forces the audio to restart in all frames after a short period of silence (10 codons) even in the absence of an ATG start codon.
    </p>
  </div>
  <div class="boarderbox col-md-12">
    <h2>
    STOP in All, START in 1st RF</h2>
    <p>Repetitive G sequences with stop codons in all three reading frames followed by a start codon in the 1st frame.</p>
    <table class="box-table-a" summary="DNA sequence">
        <tr>
            <td>
                <p class="DNA_seq">
                    GGGGGGGGGGGGGGG<b>TAA</b>G<b>TAA</b>G<b>TAA</b>GGGGGGGGGG<b>ATG</b>GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
                </p>
            </td>
        </tr>
    </table><div class="card card-body">
    <h3>
    STOP in all reading frames START in 1st RF<br>(default settings)</h3>
    <audio controls>
        <source src="./example_mp3/04 STOP in All, START in 1st RF (default).mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio></div>
    <p>Same as 'STOP in all reading frames' above through to the point where all reading frames becomes silent, however the presence of a start codon in reading frame 1 causes instrument 1 to restart at approx. 7 seconds, whilst the others frames remain silent. Audio notes from the isolated instrument are staggered with two rests beats between each note due to the two silent frames.</p>
  </div>
  <div class="boarderbox col-md-12">
    <h2>
    AT only DNA</h2>
    <p>AT rich DNA (absence of GC bases) </p>
    <table class="box-table-a" summary="DNA sequence">
        <tr>
            <td>
                <p class="DNA_seq">
                    AAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATTAAATTATT
                </p>
            </td>
        </tr>
    </table><div class="card card-body">
    <h3>
    AT rich DNA<br>(default settings)</h3>
    <audio controls>
        <source src="./example_mp3/05 AT only DNA (default).mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio>

    <h3>AT rich DNA<br>(Ignore Start/Stop)</h3>

    <audio controls>
        <source src="./example_mp3/05b AT only DNA (Ignore Start Stop).mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio></div>
    <p>Audio plays with characteristic triplet pattern (three instruments) however due to the high chance of an TAA stop codons in each reading frame the audio becomes silent after only 4 seconds and remains so for the remaining 39 seconds. The absence of G precludes the occurrence of an ATG start codon to restart the audio. Selecting the 'Restart after 10 codons' causes no change compared to the default settings due to the re-occurrence of TAA's (stop codons) within the passage of 10 codons. In contrast the 'Ignore Start/Stop' option results in sonification of the entire sequence. It may not be obvious but he audio phrasing repeats every 8 triplets due to the repetitive nature of the artificial DNA sequence. </p>
  </div>

  <div class="boarderbox col-md-12">
    <h2>
    GC only DNA</h2>
    <p>GC rich DNA (absence of AT bases)</p>
    <table class="box-table-a" summary="DNA sequence">
        <tr>
            <td>
                <p class="DNA_seq">
                    GGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCCGGGCCGCC
                </p>
            </td>
        </tr>
    </table><div class="card card-body">
    <h3>
    GC rich DNA<br>(default settings)</h3>
    <audio controls>
        <source src="./example_mp3/06 GC only DNA (default).mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio></div>
    <p>Audio plays with characteristic triplet pattern (three instruments) for the duration of the sequence (approx. 43 seconds) with the default settings. There are no interruptions in the auditory display because all start and stop codons require A and T bases which are absence. This is in stark contrast to the display of the AT rich DNA using the same default settings. </p>
  </div>

  <div class="boarderbox col-md-12">
    <h2>
    Human Telomeric DNA </h2>
    <p>Human DNA sequence that consists of tandem arrays of the hexanucleotide sequence (TTAGGG)n, for example:
    </p>
    <table class="box-table-a" summary="DNA sequence">
        <tr>
            <td>
                <p class="DNA_seq">
                    TTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGAGTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTTAGGGTGTTAGGGTTAGGGTTAGGG
                </p>
            </td>
        </tr>
    </table><div class="card card-body">
    <h3>Human Telomeric DNA<br>(Ignore Start Stop)</h3>
    <audio controls>
        <source src="./example_mp3/Human Telomeric DNA (Ignore Start Stop).mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio></div>
    <p>The audio from this sequence is highly repetitive and repeats approximately every 6 bases. This sequence was sonified using the "reading frame algorithm" that reads groups of three (3) bases at a time (as triplets) hence after TWO sets of triplets the notes repeat. Notice the change in the repetitive sound that occurs at approx. 13 sec that reflects a subtle change in the DNA sequence at bp 79 (insertion of <b>AG</b> in place of <b>T</b>) in addition to a change at 41 sec (due to the insertion of TG). This is clearly apparent in the sonification but not so apparent by visual inspection of the sequence</p>
    <p>Sequence data published by:
    <br>Moyzis, R. K., J. M. Buckingham, et al. (1988). "A highly conserved repetitive DNA sequence, (TTAGGG)n, present at the telomeres of human chromosomes." PNAS. 85, 6622-6626.</p>
  </div>
  <div class="boarderbox col-md-12">
    <h2>
    Alphoid Repetitive DNA </h2>
    <p>Human DNA sequence that consists of tandem arrays of the pentanucleotide sequence (CCATT)n, for example:
    </p>
    <table class="box-table-a" summary="DNA sequence">
        <tr>
            <td>
                <p class="DNA_seq">
                    CCATTCCATTCCATTCCATTCCATTCCATTCCATTCCATTCCATTCCATTCCATTCCATTCCATTCCATTCCATTCCATTCCATTCCATTCCATTCCATTATAGTCCATTCCATTCCATTCCATTCCATTCAATTCCATTCCATTACAATTCGTTCCATTCCATTCTATTCCGTACCATTCGATTCCATTCCATACCATCCATTCCATTCCATTCCATTCATTCCATTCCGTTCCATTCCGTTCATTCATTCATTCCATTCTATTCGGATTAATTCCAATCTATTCCATTCATTGCATTCTATTCCATTCCATTGCAATCGAGTTGAATACATTGCATTCTATTCATTCATTCATTCCATTCCATTCCGGAAGATTA
                </p>
            </td>
        </tr>
    </table><div class="card card-body">
    <h3>
    Human alphoid repetitive sequence<br>(Ignore Start Stop)</h3>
    <audio controls>
        <source src="./example_mp3/Human alphoid repetitive sequence (Ignore Start Stop).mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio>
    <h3>Human alphoid repetitive sequence (Restart on ATG)</h3>
    <audio controls>
        <source src="./example_mp3/Human alphoid repetitive sequence (Restart on ATG).mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio></div>
    <p>The audio from this sequence is clearly repetitive but notice that the audio sound is more complex than the previous telomeric DNA sequence. This is because the sequence repeats approximately every 5 bases whereas the "reading frame algorithm" reads groups of three bases at a time, hence the melody repeats every 15 bases, that is FIVE sets of triplets occur before the notes repeat. The first 17 sec (100 bp) is a synthetic alphoid sequence that is purely repetitive with no sequence variation. Following this an actual alphoid repetitive sequence in that contains sequence variations that are clearly audible</p>
  </div>
  <div class="boarderbox col-md-12">
    <h2>
    Ras coding sequence (cDNA) </h2>
    <p>This sequence represents the first exon of the Human <i>Ras DNA</i> sequence,an important gene in cell signalling and human disease:
    </p>
    <table class="box-table-a" summary="DNA sequence">
        <tr>
            <td>
                <p class="DNA_seq">
                    ATGACGGAATATAAGCTGGTGGTGGTGGGCGCCGGCGGTGTGGGCAAGAGTGCGCTGACCATCCAGCTGATCCAGAACCATTTTGTGGACGAATACGACCCCACTATAGAGGATTCCTACCGGAAGCAGGTGGTCATTGATGGGGAGACGTGCCTGTTGGACATCCTGGATACCGCCGGCCAGGAGGAGTACAGCGCCATGCGGGACCAGTACATGCGCACCGGGGAGGGCTTCCTGTGTGTGTTTGCCATCAACAACACCAAGTCTTTTGAGGACATCCACCAGTACAGGGAGCAGATCAAACGGGTGAAGGACTCGGATGACGTGCCCATGGTGCTGGTGGGGAACAAGTGTGACCTGGCTGCACGCACTGTGGAATCTCGGCAGGCTCAGGACCTCGCCCGAAGCTACGGCATCCCCTACATCGAGACCTCGGCCAAGACCCGGCAGGGAGTGGAGGATGCCTTCTACACGTTGGTGCGTGAGATCCGGCAGCACAAGCTGCGGAAGCTGAACCCTCCTGATGAGAGTGGCCCCGGCTGCATGAGCTGCAAGTGTGTGCTCTCCTGA
                </p>
            </td>
        </tr>
    </table><div class="card card-body">
    <h3>Human H-Ras cDNA<br>(Silent until ATG)</h3>
    <audio controls>
        <source src="./example_mp3/Human H-Ras cDNA (Silent until ATG).mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio>
    <h3>Human H-Ras cDNA<br>(Highlight STOP START)</h3>
    <audio controls>
        <source src="./example_mp3/Human H-Ras cDNA (Highlight STOP START).mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio></div>
    <p>This sequence was sonified using the "reading frame algorithm" in which a different instrument is used to sonify each reading frame, in this example a bright piano, electric bass (pick) and timpani were used to sound each frame. In addition the "use Start/Stop codons" option was selected, so that whenever a stop codon is detected in either reading frame the instrument is silenced as are the following 10 codons (notes). Notice how the bright piano plays throughout (i.e. the Ras open reading frame) whereas both the bass and timpani cut out repeatedly as stop codons occur in these respective reading frames. This leads to sections of audio with solo piano (e.g. at 3 sec and 1:30 min), piano and timpani (e.g. 9 to 17 sec) or piano and bass duets (predominantly from 45 sec to 1:00 min) plus the full trio ensemble (e.g. from 30 sec and 1:05 mins).
    <p>Sequence data taken from:
            <br>Homo sapiens chromosome 11 genomic contig, GRCh37.p5 Primary Assembly, NCBI Reference Sequence: NT_009237.18 (beginning at position 189)</p>
          </div>
  <div class="boarderbox col-md-12">
    <h2>
    15S rRNA sequence </h2>
    <p>Yeast mitochondrial DNA sequence that codes for the 15S ribosomal RNA
    </p>
    <table class="box-table-a" summary="DNA sequence">
        <tr>
            <td>
                <p class="DNA_seq">
                    GTAAAAAATTTATAAGAATATGATGTTGGTTCAGATTAAGCGCTAAATAAGGACATGACACATGCGAATCATACGTTTATTATTGATAAGATAATAAATATGTGGTGTAAACGTGAGTAATTTTATTAGGAATTAATGAACTATAGAATAAGCTAAATACTTAATATATTATTATATAAAAATAATTTATATAATAAAAAGGATATATATATAATATATATTTATCTATAGTCAAGCCAATAATGGTTTAGGTAGTAGGTTTATTAAGAGTTAAACCTAGCCAACGATCCATAATCGATAATGAAAGTTAGAACGATCACGTTGACTCTGAAATATAGTCAATATCTATAAGATACAGCAGTGAGGAATATTGGACAATGATCGAAAGATTGATCCAGTTACTTATTAGGATGATATATAAAAATATTTTATTTTATTTATAAATATTAAATATTTATAATAATAATAATAATAATATATATATATAAATTGATTAAAAATAAAATCCATAAATAATTAAAATAATGATATTAATTACCATATATATTTTTATATGGATATATATATTAATAATAATATTAATTTTATTATTATTAATAATATATTTTAATAGTCCTGACTAATATTTGTGCCAGCAGTCGCGGTAACACAAAGAGGGCGAGCGTTAATCATAATGGTTTAAAGGATCCGTAGAATGAATTATATATTATAATTTAGAGTTAATAAAATATAATTAAAGAATTATAATAGTAAAGATGAAATAATAATAATAATTATAAGACTAATATATGTGAAAATATTAATTAAATATTAACTGACATTGAGGGATTAAAACTAGAGTAGCGAAACGGATTCGATACCCGTGTAGTTCTAGTAGTAAACTATGAATACAATTATTTATAATATATATTATATATAAATAATAAATGAAAATGAAAGTATTCCACCTGAAGAGTACGTTAGCAATAATGAAACTCAAAACAATAGACGGTTACAGACTTAAGCAGTGGAGCATGTTATTTAATTCGATAATCCACGACTAACCTTACCATATTTTGAATATTATAATAATTATTATAATTATTATATTACAGGCGTTACATTGTTGTCTTTAGTTCGTGCTGCAAAGTTTTAGATTAAGTTCATAAACGAACAAAACTCCATATATATAATTTTAATTATATATAATTTTATATTATTTATTAATATAAAGAAAGGAATTAAGACAAATCATAATGATCCTTATAATATGGGTAATAGACGTGCTATAATAAAATGATAATAAAATTATATAAAATATATTTAATTATATTTAATTAATAATATAAAACATTTTAATTTTTAATATATTTTTTTATTATATATTAATATGAATTATAATCTGAAATTCGATTATATGAAAAAAGAATTGCTAGTAATACGTAAATTAGTATGTTACGGTGAATATTCTAACTGTTTCGCACTAATCACTCATCACGCGTTGAAACATATTATTATCTTATTATTTATATAATATTTTTTAATAAATATTAATAATTATTAATTTATATTTATTTATATCAGAAATAATATGAATTAATGCGAAGTTGAAATACAGTTACCGTAGGGGAACCTGCGGTGGGCTTATAAATATCTTAAATATTCTTACA
                </p>
            </td>
        </tr>
    </table><div class="card card-body">
    <h3>15S_rRNA non-coding RNA<br>(Silent until ATG).</h3>
    <audio controls>
        <source src="./example_mp3/15S_rRNA non-coding RNA (Restart on ATG).mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio>
    <h3>15S_rRNA non-coding RNA<br>(Highlight STOP START).</h3>
    <audio controls>
        <source src="./example_mp3/15S_rRNA non-coding RNA (Highlight STOP START).mp3" type="audio/mp3"> Your browser does not support the audio element.
    </audio></div>
    <p>This sequence was process in the same way as the ras sequence above and likewise has no discernable melodic patterns such as those used to detect tandem repeats in repetitive DNA, however, the audio is still highly recognisable. This audio is characterised by the complete absence of any "triplet" note passages and the presence of repeated sections of silence. All passages are either single notes or pairs of notes with in each triplet (deriving from each of three reading frames). This is because of repeated stop codons occurring in all reading frames (including TGA). The rRNA is not translated and therefore stop codons have no effect (or act to inhibit translation if it were to occur). Clearly the "reading frame algorithm" combined with the "Start/Stop codons" option is effective in sonifying the rRNA into a distinctive audio stream.</p>
    <p>The second example is the same sequence with the Highlight STOP START option to sonify the occurence of these motifs with purcussion sounds even when the audio from the respective instrument/reading frame is silent.</p>
    <p>Sequence data taken from:<br>15S_rRNA 15S_RRNA SGDID:S000007287, Chr Mito from 6546-8194</p>
  </div>
</div>
</div>

<?php
include("footer.php");?>
