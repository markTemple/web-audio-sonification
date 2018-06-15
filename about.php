<?php
include("header.php");
?>

<div class="container">
  <div class="row">
    <div class="boarderbox col-md-12">

    <h1>Sonification</h1><hr>

    <p> This site is based on the BMC Bioinformatics journal
    <a href="https://bmcbioinformatics.biomedcentral.com/articles/10.1186/s12859-017-1632-x">
    article</a> "An auditory display tool for DNA sequence analysis" <br>BMC Bioinformatics 2017 18:221
    </p>

    </div>
  </div>
</div>

<div class="container boarderbox">
<h1>Introduction</h1><hr>

  <div class="row">
  <div class="col-md-6">

<p>
DNA Sonification refers to the use of audio to convey the information content of DNA sequence data. It provides an interesting adjunct to standard visualization of DNA sequence data. To achieve this the 4 bases (namely G, A, T and C) that make up the DNA sequence are processed from left to right in a linear fashion. To achieve this a dynamic web tool has been created in which DNA sequences are processed to produce audio output.</p>

<p>Recently these has been much interest in DNA sonification in light of recent advancements in DNA sequencing technology and the benefits thereof. Gene coding regions of the genome are essentially highly ordered sequences of DNA where by the genetic code relates the coding sequence of DNA to an amino acid residues of a protein. However, much of the information content of DNA, outside of gene coding regions has a lower sequence complexity according to our current knowledge base. </p>

<p>Two vastly different approaches have previously been taken to sonify DNA to achieve outcomes pertinent to either the art or science disciplines. One approach essentially treats DNA as a random sequence for the purpose of generative music synthesis whereas the other assumes non-random sequence and therefore takes into account basic chemical or biological properties during sonifcation. We have focused on the latter approach in this work. </p>

<p>From a scientific perspective the basic challenge of DNA sonification is to use audio cues to distinguish between a DNA sequence that is a highly ordered gene coding regions from that of low complexity. Towards achieving this, various algorithms have been established to map the nucleotide bases (motifs) to musical notes. In the most rudimentary algorithm, each of the 4 individual nucleotide base (G, A, T, or C) is considered to be a motif and is mapped to one of four musical notes however given the complexity of DNA sequences this mapping is ineffectual and included only for the sake of completeness. </p>

<p>The consideration of pairs of nucleotides as motifs provides for 16 notes and again does not give justice to the complexity of most DNA sequences. The most useful approach is to mirror the genetic code and treat each of three nucleotide bases as a motif to map to a note. In theory a total of 64 codons exist however in the realm of biology typically these give rise to only 20 of amino acid residues of proteins. This approach of note assignment could clearly be extended to map larger groupings of nucleotides to an ever increasing range of notes, for instance 4 or 5 nucleotide motifs could theoretically be mapped to 256 or 1024 notes, respectively. Whilst this has no basis in biology it is an interesting proposition for generative music aficionados. Given a typical hearing range and the number of discrete notes on musical instruments, this provides for more notes than can be sounded. One solution could be to map these motifs to micro-tonal scales using intervals smaller than semi-tones, however this approach was not pursued at this stage. </p>


<table class="box-table-a" summary="DNA sequence detail" >
<tr>
	<th><div align="center">Motif</div></th>
	<th><div align="center">Number of motifs </div></th>
	<th><div align="center">Motif identifier (Motif ID) </div></th>
</tr>

<tr>
<td><div align="center">1 bp</div></td>
<td>  <p align="center">4 <br>(4 x 1)</p></td>
<td><div align="center"><b>G</b>= #1<br><b>A</b>= #2<br><b>T</b>= #3<br><b>C</b>= #4</div></td>
</tr>

<tr>
<td><div align="center">2 bp</div></td>
<td><div align="center">16 <br>
  (4 x 4)</div></td>
<td><div align="center"><b>GG</b>= #1<br><b>GA</b>= #2<br><b>GT</b>= #3<br><b>GC</b>= #4<br><b>AG</b>= #5<br><b>AA</b>= #6<br><b>AT</b> = #7<br>etc...</div></td>
</tr>

<tr>
<td><div align="center">3 bp<br>(Codon)</div></td>
<td><div align="center">64 <br>
  (4 x 16)</div></td>
<td><div align="center"><b>GGG</b>= #1<br><b>GGA</b>= #2<br><b>GGT</b>= #3<br><b>GGC</b>= #4<br><b>GAG</b>= #5<br><b>GTG</b>= #6<br><b>GCT</b> = #7<br>etc...</div></td>
</tr>
</table>

</div>
<div class="col-md-6">

<p><a href="help_algorithms.php">Six DNA sonification algorithms</a> have been scripted to associate a DNA motif to a specific motif identifier. Each of these are further processed to produce a distinct mix of instrument and note identifiers to be assigned to musical notes. The motif identifiers are  numbered from 1-4, 1-16 or 1-64 depending on the  algorithm. These motif identifiers are further processed using additional parameters to establish a musical key, notes intervals, note length, note timing and tempo. These are then assigned to an octave suitable for the selected instrument. All audio is generated dynamically and the audio output is streamed in real time. </p>

<p>Irrespective of the algorithm used, in each case  Motif ID 1 is assigned to the root note of a musical key and the octave is set by the lower pitch range of the assigned musical instrument. These assignments are made using MIDI note numbers. For each instrument there are 128 MIDI note numbers representing a 10 octave note range. The interval between notes is governed by the scale used to sonify the motifs. For instance the repeating semitone intervals of the natural minor scale (2, 1, 2, 2, 1, 2, 2) or the blues scale (3, 2, 1, 1, 3, 2) are used to assign sequential motif numbers to musical notes. Clearly the choice of key and scale determine the actual notes used in DNA sequence sonification. </p>

<p>Whilst each of the algorithms produces an audio output with interesting  characteristics, the most useful algorithm for DNA sequence analyses using codons (motifs of three nucleotides)  mapped to 21 musical notes.
In this approach tri-nucleotides are processed in an analogous way to the biological rules of the genetic code (in which a codon consists of three consecutive bases coding for one of 20 amino acid building blocks of a protein). Each of 64 possible codons are mapped to one of 20 musical notes rather than amino acids, as is the STOP codon. Each of the three possible open reading frames is mapped to a separate instruments. In the absence of further DNA sequence annotation to indicate the actual reading frame of the sequence, each open reading frame (instrument) is voiced sequentially with equal bias. </p>

<p>The information content of the DNA sequence was further sonified using two unique approaches. Firstly, Start or Stop codons were assigned to a loud or quiet volumes, respectively. This volume manipulation not only effects the specific codon but the following notes for a period of time. This effectively silences a reading frame if a Stop codon occurs or makes the  reading frame containing a Start codon louder for a period of time. Secondly, unique sequences of DNA are used to trigger percussion instruments upon their detection in the sequence, this is applied to transcription factor binding motifs, promoter elements and to Start and (silences) Stop codons. These methods are  effective at distinguishing cDNA sequences from random DNA sequences or AT rich DNA from GC rich DNA.</p>

<h3>The human genome consists of approx. 600 billion base pairs</h3>

<table class="box-table-a" summary="DNA sequence">
<tr>
	<th>Consider approx. 1000 base pairs of DNA sequence:</th>
</tr>
<tr>
<td><p class="DNA_seq">
actcaccctgaagttctcaggatccacgtgcagcttgtcacagtgcagctcactcagtgtggcaaaggtgcccttgaggttgtccaggtgagccaggccatcactaaaggcaccgagcactttcttgccatgagccttcaccttagggttgcccataacagcatcaggagtggacagatccccaaaggactcaaagaacctctgggtccaagggtagaccaccagcagcctaagggtgggaaaatagaccaataggcagagagagtcagtgcctatcagaaacccaagagtcttctctgtctccacatgcccagtttctattggtctccttaaacctgtcttgtaaccttgataccaacctgcccagggcctcaccaccaacttcatccacgttcaccttgccccacagggcagtaacggcagacttctcctcaggagtcagatgcaccatggtgtctgtttgaggttgctagtgaacacagttgtgtcagaagcaaatgtaagcaatagatggctctgccctgacttttatgcccagccctggctcctgccctccctgctcctgggagtagattggccaaccctagggtgtggctccacagggtgaggtctaagtgatgacagccgtacctgtccttggctcttctggcactggcttaggagttggacttcaaaccctcagccctccctctaagatatatctcttggccccataccatcagtacaaattgctactaaaaacatcctcctttgcaagtgtatttacgtaatatttggaatcacagcttggtaagcatattgaagatcgttttcccaattttcttattacacaaataagaagttgatgcactaaaagtggaagagttttgtctaccataattcagctttgggatatgtagatggatctcttcctgcgtctccagaatatgcaaaatacttacaggacagaatggatgaaaa
</p></td>
</tr>
</table>

<p>This above sequence contains a segment of the promoter region
and coding region of the beta globin gene.</p>

</div>
</div>
</div>



<div class="container boarderbox">
  <div class="row">

<div class="col-md-6">


<table class="box-table-a" summary="DNA sequence detail">
<tr>
	<th>Consider the beginning of this sequence:</th>
</tr>
<tr>
	<td><p class="DNA_seq">
actcaccctgaagttctcaggatccacgtgcagcttgtcacagtgcagctcactcagtgt</p>
</td>
</tr>
</table>
<p>In a biological context, the information content of this can be read in one of three reading frames according to the rules of the genetic code, whereby three nucleotide bases code for a specific amino acid residue in a protein.
So this single sequence can be written and processed in three ways.</p>

<p> Frame 1: <span class="DNA_seqBIG red">act<b>-</b>cac<b>-</b>cct<b>-</b>gaa<b>-</b>gtt<b>-</b>ctc<b>-</b>agg...<span></p>
<p> Frame 2: <span class="DNA_seqBIG dark">a<b>-</b>ctc<b>-</b>acc<b>-</b>ctg<b>-</b>aag<b>-</b>ttc<b>-</b>tca<b>-</b>gga...<span></p>
<p> Frame 3: <span class="DNA_seqBIG blue">ac<b>-</b>tca<b>-</b>ccc<b>-</b>tga<b>-</b>agt<b>-</b>tct<b>-</b>cag<b>-</b>gat...<span></p>

<p>Sonifiying the first frame would read:<br> 
<span class="DNA_seqBIG red">act<b>-</b>cac<b>-</b>cct<b>-</b>gaa<b>-</b>gtt<b>-</b>ctc...<span></p>

<p>However Sonifiying all frames  would read act: <br>
<span class="DNA_seqBIG red">act<span><b>-</b><span class="DNA_seqBIG dark">ctc<span><b>-</b><span class="DNA_seqBIG blue">tca<span><b>-</b><span class="DNA_seqBIG red">cac<span><b>-</b><span class="DNA_seqBIG dark">acc<span><b>-</b><span class="DNA_seqBIG blue">ccc<span>...<span></p>

<p>Only one of these reading frames is processed by the cell to make a protein, this is determined by recognition of landmarks or motifs in the sequence such as an inframe "atg" start codon or other codons, such as "tga" that determine the end of a gene. In addition other motifs such as 5'-tataaa-3' determine protein binding sites approximately 25 base pairs upstream of transcription start.<p>

<p>A biological relationship <em>(referred to as the genetic code)</em> exists to convert each of the 64 codons to a specific amino acid residue (through the biological process of transcription and translation). Also included is a arbitrary association to a number to be used to reference a musical note in the MIDI file.
<p>

  <h3>Table to convert number to midi note (C scale)</h3>

  <table class="box-table-a" summary="Codon reference number to MIDI note number" width="600px" >


  <tr><th>codon to number</th><th>three octaves</th><th>midi note numbers</th></tr>
  <tr><td>1</td><td>A</td><td>57</td></tr>
  <tr><td>2</td><td>B</td><td>59</td></tr>
  <tr><td>3</td><td>C</td><td>60</td></tr>
  <tr><td>4</td><td>D</td><td>62</td></tr>
  <tr><td>5</td><td>E</td><td>64</td></tr>
  <tr><td>6</td><td>F</td><td>65</td></tr>
  <tr><td>7</td><td>G</td><td>67</td></tr>
  <tr><td>8</td><td>A</td><td>69</td></tr>
  <tr><td>9</td><td>B</td><td>71</td></tr>
  <tr><td>10</td><td>C</td><td>72</td></tr>
  <tr><td>11</td><td>D</td><td>74</td></tr>
  <tr><td>12</td><td>E</td><td>76</td></tr>
  <tr><td>13</td><td>F</td><td>77</td></tr>
  <tr><td>14</td><td>G</td><td>79</td></tr>
  <tr><td>15</td><td>A</td><td>81</td></tr>
  <tr><td>16</td><td>B</td><td>83</td></tr>
  <tr><td>17</td><td>C</td><td>84</td></tr>
  <tr><td>18</td><td>D</td><td>86</td></tr>
  <tr><td>19</td><td>E</td><td>88</td></tr>
  <tr><td>20</td><td>F</td><td>89</td></tr>
  <tr><td>21</td><td>G</td><td>91</td></tr>
  </table>

  <h3>Midi note numbers</h3>
  <p>The following table lists the numbers corresponding to notes for use in note on and note off commands in the MIDI file.</p>

  <table class="box-table-a" summary="MIDI note numbers">
  <tr>
  <th></th><th>C</th><th>C#</th><th>D</th><th>D#</th><th>E</th><th>F</th><th>F#</th><th>G</th><th>G#</th><th>A</th><th>A#</th><th>B</th>
  </tr>
  <tr><th>0</th><td>0</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td></tr>
  <tr><th>1</th><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td></tr>
  <tr><th>2</th><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td><td>29</td><td>30</td><td>31</td><td>32</td><td>33</td><td>34</td><td>35</td></tr>
  <tr><th>3</th></th><td>36</td><td>37</td><td>38</td><td>39</td><td>40</td><td>41</td><td>42</td><td>43</td><td>44</td><td>45</td><td>46</td><td>47</td></tr>
  <tr><th>4</th><td>48</td><td>49</td><td>50</td><td>51</td><td>52</td><td>53</td><td>54</td><td>55</td><td>56</td><td>57</td><td>58</td><td>59</td></tr>
  <tr><th>5</th><td>60</td><td>61</td><td>62</td><td>63</td><td>64</td><td>65</td><td>66</td><td>67</td><td>68</td><td>69</td><td>70</td><td>71</td></tr>
  <tr><th>6</th><td>72</td><td>73</td><td>74</td><td>75</td><td>76</td><td>77</td><td>78</td><td>79</td><td>80</td><td>81</td><td>82</td><td>83</td></tr>
  <tr><th>7</th><td>84</td><td>85</td><td>86</td><td>87</td><td>88</td><td>89</td><td>90</td><td>91</td><td>92</td><td>93</td><td>94</td><td>95</td></tr>
  <tr><th>8</th><td>96</td><td>97</td><td>98</td><td>99</td><td>100</td><td>101</td><td>102</td><td>103</td><td>104</td><td>105</td><td>106</td><td>107</td></tr>
  <tr><th>9</th><td>108</td><td>109</td><td>110</td><td>111</td><td>112</td><td>113</td><td>114</td><td>115</td><td>116</td><td>117</td><td>118</td><td>119</td></tr>
  <tr><th>10</th><td>120</td><td>121</td><td>122</td><td>123</td><td>124</td><td>125</td><td>126</td><td>127</td></td><td></td><td></td><td></td><td></tr>
</span>
  </table>
</div>
<div class="col-md-6">

<h3>Codons usage table</h3>
<table class="box-table-a" summary="MIDI note numbers" width="600px" >

  <tr>
    <th>Codon number</th>
    <th>Codon</th>
    <th>Amino acid</th>
    <th>Note number</th>
  </tr>
<?php $codon_table=Make_codon2noteArray_scale();
foreach($codon_table as $v){?>
<tr>
<td class="2"><?php echo $v['0'];?></td>
<td class="2"><?php echo $v['1'];?></td>
<td class="2"><?php echo $v['2'];?></td>
<td class="2"><?php echo $v['3'];?></td>
</tr>
<?php
}
?>
</table>

</div>
</div>
</div>


<?php include("footer.php");?>

