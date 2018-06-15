<?php include("header.php");
//include("help_menu.php");
?>

<div class="container boarderbox">
<h1>Algorithms</h1><hr>
  <div class="col-md-12">
  <div class="card card-body">
<h2>Reading frame codons</h2>

<ul class="fa-ul">
    <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Has inherent biological logic.
    </li>
    <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Codons (groups of three nucleotides) are mapped to 21 musical notes.
    </li>
    <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Mapping is degenerate (more than one codons can map to the same musical note).
    </li>
    <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Each of the 3 possible reading frames are mapped to 3 separate instruments.
    </li>
    <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Start codons are emphesised.
    </li>
    <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Stop codons are silenced.
    </li>
</ul>

<table class="box-table-a" summary="DNA reading frames">
    <tr>
        <th width="20%"></th>
        <th align="left" width="80%">Audio generated from <b>Random DNA sequence</b>
        </th>
    </tr>
    <tr>
        <th width="20%">RF 1</th>
        <td align="left">
            <p class="DNA_seq">ACT|CAC|CCT|GAA|GTT|CTC|AGG|ATC|CAC|GTG|CAG|CTT|GTC|ACA|GTG|CAG|CTC|ACT|CAG|TGT| </p></td>
    </tr>
    <tr>
        <th width="20%">Piano</th>
        <td align="left">
            <p class="DNA_seq">A#5|F.4|F.5|C.4|F.6|G.4|D#3|F#4|F.4|F.6|A#3|G.4|F.6|A#5|F.6|A#3|G.4|A#5|A#3|G.3| </p></td>
    </tr>
    <tr>
        <th width="20%">RF 2</th>
        <td align="left">
            <p class="DNA_seq">CTC|ACC|CTG|AAG|TTC|TCA|GGA|TCC|ACG|TGC|AGC|TTG|TCA|CAG|TGC|AGC|TCA|CTC|AGT| </p></td>
    </tr>
    <tr>
        <th width="20%">Guitar</th>
        <td align="left">
            <p class="DNA_seq">G.4|A#5|G.4|A#4|D#5|F#5|D#4|F#5|A#5|G.3|F#5|G.4|F#5|A#3|G.3|F#5|F#5|G.4|F#5| </p></td>
    </tr>
    <tr>
        <th width="20%">RF 3</th>
        <td align="left">
            <p class="DNA_seq">TCA|CCC|TGA|AGT|TCT|CAG|GAT|CCA|CGT|GCA|GCT|TGT|CAC|AGT|GCA|GCT|CAC|TCA|GTG| </p></td>
    </tr>
    <tr>
        <th width="20%">Organ</th>
        <td align="left">
            <p class="DNA_seq">F#5|F.5|G.5|F#5|F#5|A#3|F#3|F.5|D#3|C.3|C.3|G.3|F.4|F#5|C.3|C.3|F.4|F#5|F.6| </p></td>
    </tr>
    <tr>
        <th width="20%">All Notes</th>
        <td align="left">
            <p class="DNA_seq">AGF|FAF|FGG|CAF|FDF|GFA|DDF|FFF|FAD|FGC|AFC|GGG|FFF|AAF|FGC|AFC|GFF|AGF|AFF|G| </p></td>
    </tr>
</table>
<p>
    In this approach tri-nucleotides are processed in an analogous way to the biological rules of the genetic code (in which a codon consists of three consecutive bases coding for one of 20 amino acid building blocks of a protein). Each of 64 possible codons are mapped to one of 20 musical notes rather than amino acids, as is the STOP codon. Each of the three possible open reading frames is mapped to a separate instruments. In the absence of further DNA sequence annotation to indicate the actual reading frame of the sequence, each open reading frame (instrument) is voiced sequentially with equal bias. </p>

</div>
</div>

  <div class="col-md-12">
  <div class="card card-body">
    <h2>Protein sequence </h2>
    <ul class="fa-ul">
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Has inherent biological logic.
        </li>
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Codons (groups of three nucleotides) are mapped to 21 musical notes.
        </li>
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Mapping is degenerate (more than one codons can map to the same musical note).
        </li>
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Only the first reading frames is mapped to an instrument.
        </li>
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>DNA sequence is akin to a gene coding region with introns removed (cDNA).
        </li>
    </ul>
    <table class="box-table-a" summary="DNA reading frames">
        <tr>
            <th width="20%"></th>
            <th align="left" width="80%">Audio generated from <b>Random DNA sequence</b>
            </th>
        </tr>
        <tr>
            <th width="20%">DNA sequence</th>
            <td align="left">
                <p class="DNA_seq">ACT|CAC|CCT|GAA|GTT|CTC|AGG|ATC|CAC|GTG|CAG|CTT|GTC|ACA|GTG|CAG|CTC|ACT|CAG|TGT|</p></td>
    </tr>
    <tr>
            <th width="20%">"Protein (AA residues)"</th>
            <td align="left">
                <p class="DNA_seq">Thr|His|Pro|Glu|Val|Leu|Arg|Ile|His|Val|Gln|Leu|Val|Thr|Val|Gln|Leu|Thr|Gln|Cys|</p></td>
    </tr>
    <tr>
            <th width="20%">Piano</th>
            <td align="left">
                <p class="DNA_seq">A#4|F.3|F.4|C.3|F.5|G.3|D#2|F#3|F.3|F.5|A#2|G.3|F.5|A#4|F.5|A#2|G.3|A#4|A#2|G.2|</p></td>
    </tr>
    </table>
    </div>
</div>

  <div class="col-md-12">
  <div class="card card-body">
    <h2>Tri-nucleotides</h2>
    <ul class="fa-ul">
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Has no inherent biological logic.
        </li>
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Each of 64 codons (groups of three nucleotides) are mapped to distinct musical notes.
        </li>
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Only the first reading frames is mapped to an instrument.
        </li>
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>DNA sequence is akin to a gene coding region with introns removed (cDNA).
        </li>
    </ul>
    <table class="box-table-a" summary="DNA reading frames">
        <tr>
            <th width="20%"></th>
            <th align="left" width="80%">Audio generated from <b>Random DNA sequence</b>
            </th>
        </tr>
        <tr>
            <th width="20%">DNA sequence</th>
            <td align="left">
                <p class="DNA_seq">ACT|CAC|CCT|GAA|GTT|CTC|AGG|ATC|CAC|GTG|CAG|CTT|GTC|ACA|GTG|CAG|CTC|ACT|CAG|TGT|</p></td>
    </tr>
    <tr>
            <th width="20%">Piano</th>
            <td align="left">
                <p class="DNA_seq">G#6|C.4|G.5|F#3|D#7|F#4|F.2|D#4|C.4|D.7|F.3|G#4|C#7|F.6|D.7|F.3|F#4|G#6|F.3|D#3| </p></td>
    </tr>
    </table>
    </div>
</div>

  <div class="col-md-12">
  <div class="card card-body">
    <h2>Di-nucleotides</h2>
    <ul class="fa-ul">
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Has no inherent biological logic
        </li>
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Groups of 16 possible two nucleotides pairs are mapped to distinct musical notes
        </li>
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Only the first reading frames is mapped to an instrument
        </li>
    </ul>
    <table class="box-table-a" summary="DNA reading frames">
        <tr>
            <th width="20%"></th>
            <th align="left" width="80%">Audio generated from <b>Random DNA sequence</b>
            </th>
        </tr>
        <tr>
            <th width="20%">DNA sequence</th>
            <td align="left">
                <p class="DNA_seq">AC|TC|AC|CC|TG|AA|GT|TC|TC|AG|GA|TC|CA|CG|TG|CA|GC|TT|GT|CA|CA|GT|GC|AG|CT|CA|CT|CA|GT|GT|</p></td>
    </tr>
    <tr>
            <th width="20%">Piano</th>
            <td align="left">
                <p class="DNA_seq">D#|A#|D#|F#|F.|A#|F.|A#|A#|G.|D#|A#|D#|C.|F.|D#|F#|G.|F.|D#|D#|F.|F#|G.|F.|D#|F.|D#|F.|F.|</p></td>
    </tr>
    </table>

</div>
</div>

  <div class="col-md-12">
  <div class="card card-body">
    <h2>Di-nucleotide pairs</h2>
    <ul class="fa-ul">
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Has no inherent biological logic
        </li>
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Groups of 16 possible two nucleotides pairs are mapped to distinct musical notes
        </li>
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Each of the 2 possible reading frames are mapped to 2 separate instruments
        </li>
    </ul>
    <table class="box-table-a" summary="DNA reading frames">
        <tr>
            <th width="20%"></th>
            <th align="left" width="80%">Audio generated from <b>Random DNA sequence</b>
            </th>
        </tr>
        <tr>
            <th width="20%">Two base-pairs 1</th>
            <td align="left">
                <p class="DNA_seq">AC|TC|AC|CC|TG|AA|GT|TC|TC|AG|GA|TC|CA|CG|TG|CA|GC|TT|GT|CA|CA|GT|GC|AG|CT|CA|CT|CA|GT|GT|</p></td>
    </tr>
    <tr>
            <th width="20%">Piano</th>
            <td align="left">
                <p class="DNA_seq">D#|A#|D#|F#|F.|A#|F.|A#|A#|G.|D#|A#|D#|C.|F.|D#|F#|G.|F.|D#|D#|F.|F#|G.|F.|D#|F.|D#|F.|F.|</p></td>
    </tr>
    <tr>
            <th width="20%">Two-base pairs 2</th>
            <td align="left">
                <p class="DNA_seq">CT|CA|CC|CT|GA|AG|TT|CT|CA|GG|AT|CC|AC|GT|GC|AG|CT|TG|TC|AC|AG|TG|CA|GC|TC|AC|TC|AG|TG|</p></td>
    </tr>
    <tr>
            <th width="20%">Guitar</th>
            <td align="left">
                <p class="DNA_seq">F.|D#|F#|F.|D#|G.|G.|F.|D#|C.|C.|F#|D#|F.|F#|G.|F.|F.|A#|D#|G.|F.|D#|F#|A#|D#|A#|G.|F.|</p></td>
    </tr>
    <tr>
            <th width="20%">All Notes</th>
            <td align="left">
                <p class="DNA_seq">DF|AD|DF|FF|FD|AG|FG|AF|AD|GC|DC|AF|DD|CF|FF|DG|FF|GF|FA|DD|DG|FF|FD|GF|FA|DD|FA|DG|FF|F| </p></td>
    </tr>
    </table>

</div>
</div>

  <div class="col-md-12">
  <div class="card card-body">
    <h2>Mono-nucleotides </h2>
    <ul class="fa-ul">
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Has no inherent biological logic
        </li>
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Each of the 4 possible nucleotides pairs are mapped to 4 distinct musical notes
        </li>
        <li><span class="fa-li"><i class="fas fa-check-square red fa-sm"></i></span>Only one reading frames can be created mapping to a single instrument
        </li>
    </ul>
    <table class="box-table-a" summary="DNA reading frames">
        <tr>
            <th width="20%"></th>
            <th align="left" width="80%">Audio generated from <b>Random DNA sequence</b>
            </th>
        </tr>
        <tr>
            <th width="20%">DNA sequence</th>
            <td align="left">
                <p class="DNA_seq">A&#xa0;|C&#xa0;|T&#xa0;|C&#xa0;|A&#xa0;|C&#xa0;|C&#xa0;|C&#xa0;|T&#xa0;|G&#xa0;|A&#xa0;|A&#xa0;|G&#xa0;|T&#xa0;|T&#xa0;|C&#xa0;|T&#xa0;|C&#xa0;|A&#xa0;|G&#xa0;|G&#xa0;|A&#xa0;|T&#xa0;|C&#xa0;|C&#xa0;|A&#xa0;|C&#xa0;|G&#xa0;|T&#xa0;|G&#xa0;|C&#xa0;|A&#xa0;|G&#xa0;|C&#xa0;|T&#xa0;|T&#xa0;|G&#xa0;|T&#xa0;|C&#xa0;|A&#xa0;|C&#xa0;|A&#xa0;|G&#xa0;|T&#xa0;|G&#xa0;|C&#xa0;|A&#xa0;|G&#xa0;|C&#xa0;|T&#xa0;|C&#xa0;|A&#xa0;|C&#xa0;|T&#xa0;|C&#xa0;|A&#xa0;|G&#xa0;|T&#xa0;|G&#xa0;|T&#xa0;|</td>
        </tr>
        </p>
        <tr>
            <th width="20%">Piano</th>
            <td align="left">
                <p class="DNA_seq">D#|F#|F.|F#|D#|F#|F#|F#|F.|C.|D#|D#|C.|F.|F.|F#|F.|F#|D#|C.|C.|D#|F.|F#|F#|D#|F#|C.|F.|C.|F#|D#|C.|F#|F.|F.|C.|F.|F#|D#|F#|D#|C.|F.|C.|F#|D#|C.|F#|F.|F#|D#|F#|F.|F#|D#|C.|F.|C.|F.|</p></td>
    </tr>
    </table>
</div>
</div>
</div>

<?php include("footer.php");?>
