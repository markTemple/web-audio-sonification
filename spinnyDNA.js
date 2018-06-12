let AudioContext = window.AudioContext || window.webkitAudioContext;
let DNAaudioContext = new AudioContext();
var canvas = document.getElementById('dnapaper');
var c = canvas.getContext('2d');

function preDraw () {
  let x1 = 90 + 160 * 0;
  let x2 = 90 + 160 * 1;
  let x3 = 90 + 160 * 2;
  c.fillStyle = '#F2F0E6';
  c.fillRect(0, 0, canvas.width, canvas.height);
  
  c.beginPath();
  c.arc(x1, 80, 70, 0, 2 * Math.PI);
  c.arc(x2, 80, 70, 0, 2 * Math.PI);
  c.arc(x3, 80, 70, 0, 2 * Math.PI);
  c.fillStyle = '#E7DBBD';
  c.fill();
}
preDraw();

async function playDnaAudio () {
  const animationQueue = [];

  /* eslint-disable no-undef camelcase */
  let PHP_vars = {
    dnaString: dna_php || 'gacagacagctatcatacgg',
    dnaArray:
      dna_php.toLowerCase().split('') ||
      'gacagacagctatcatacgg'.toLowerCase().split(''),
    frameNum: frameNum || '3',
    motif_len: algorithmOptions(frameNum)[0] || 3,
    RF_numb: algorithmOptions(frameNum)[1] || 1,
    stopstart: stopstart || 'no',
    sonify_motif: sonify_motif || 'no'
  };
  /* eslint-enable no-undef */

  function folders () {
    const folders = [
      './acoustic_grand_piano-mp3/',
      './electric_guitar_muted-mp3/',
      './tubular_bells-mp3/'
      // ,'../WebAudio/SonificationAudio/startstop_mp3/'
    ];
    const instruments = [
      'Grand Piano',
      'Muted Guitar ',
      'Tubular Bells'
      // ,'../WebAudio/SonificationAudio/startstop_mp3/'
    ];
    return { f: folders, inst: instruments };
  }

  function algorithmOptions (a) {
    let mapping = {
      // var  to : [window_size, slide]slide is number of arrays to make
      '3': [3, 1], // Reading frame codons
      '1': [3, 3], // Protein sequence
      '3bp': [3, 3], // Tri-nucleotides
      '2bpx2': [2, 1], // Di-nucleotide pairs
      '2bp': [2, 2], // Di-nucleotides
      '1bp': [1, 1] // Mono-nucleotides
    };
    return mapping[a];
  }

  function bp3ToNoteNumber (motif) {
    let mapping = {
      GCA: 0,
      GCC: 1,
      GCG: 2,
      GCT: 3,
      AGA: 4,
      AGG: 5,
      CGA: 6,
      CGC: 7,
      CGG: 8,
      CGT: 9,
      AAC: 10,
      AAT: 11,
      GAC: 12,
      GAT: 13,
      TGC: 14,
      TGT: 15,
      CAA: 16,
      CAG: 17,
      GAA: 18,
      GAG: 19,
      GGA: 20,
      GGC: 21,
      GGG: 22,
      GGT: 23,
      CAC: 24,
      CAT: 25,
      ATA: 26,
      ATC: 27,
      ATT: 28,
      CTA: 29,
      CTC: 30,
      CTG: 31,
      CTT: 32,
      TTA: 33,
      TTG: 34,
      AAA: 35,
      AAG: 36,
      ATG: 37,
      TTC: 38,
      TTT: 39,
      CCA: 40,
      CCC: 41,
      CCG: 42,
      CCT: 43,
      AGC: 44,
      AGT: 45,
      TCA: 46,
      TCC: 47,
      TCG: 48,
      TCT: 49,
      TAA: 50,
      TAG: 51,
      TGA: 52,
      ACA: 53,
      ACC: 54,
      ACG: 55,
      ACT: 56,
      TGG: 57,
      TAC: 58,
      TAT: 59,
      GTA: 60,
      GTC: 61,
      GTG: 62,
      GTT: 63
    };
    return mapping[motif];
  }

  function codonToNoteNumber (motif) {
    let mapping = {
      ' . ': '',
      GCA: 0,
      GCC: 0,
      GCG: 0,
      GCT: 0,
      AGA: 1,
      AGG: 1,
      CGA: 1,
      CGC: 1,
      CGG: 1,
      CGT: 1,
      AAC: 2,
      AAT: 2,
      GAC: 3,
      GAT: 3,
      TGC: 4,
      TGT: 4,
      CAA: 5,
      CAG: 5,
      GAA: 6,
      GAG: 6,
      GGA: 7,
      GGC: 7,
      GGG: 7,
      GGT: 7,
      CAC: 8,
      CAT: 8,
      ATA: 9,
      ATC: 9,
      ATT: 9,
      CTA: 10,
      CTC: 10,
      CTG: 10,
      CTT: 10,
      TTA: 10,
      TTG: 10,
      AAA: 11,
      AAG: 11,
      ATG: 12,
      TTC: 13,
      TTT: 13,
      CCA: 14,
      CCC: 14,
      CCG: 14,
      CCT: 14,
      AGC: 15,
      AGT: 15,
      TCA: 15,
      TCC: 15,
      TCG: 15,
      TCT: 15,
      TAA: 16,
      TAG: 16,
      TGA: 16,
      ACA: 17,
      ACC: 17,
      ACG: 17,
      ACT: 17,
      TGG: 18,
      TAC: 19,
      TAT: 19,
      GTA: 20,
      GTC: 20,
      GTG: 20,
      GTT: 20,
      stop: 21,
      start: 22
    };
    return mapping[motif];
  }

  function bp2ToNoteNumber (motif) {
    let mapping = {
      GG: 0,
      GA: 1,
      GT: 2,
      GC: 3,
      AG: 4,
      AA: 5,
      AT: 6,
      AC: 7,
      TG: 8,
      TA: 9,
      TT: 10,
      TC: 11,
      CG: 12,
      CA: 13,
      CT: 14,
      CC: 15
    };
    return mapping[motif];
  }

  function bp1ToNoteNumber (motif) {
    let mapping = {
      G: 0,
      A: 1,
      T: 2,
      C: 3
    };
    return mapping[motif];
  }

  // function motifToSynthDrums (motif) {
  //     let mapping = {
  //         ATG: 0,
  //         TGA: 1,
  //         TAA: 2,
  //         TAG: 3
  //     };
  //     return mapping[motif];
  // }

  // returns one array of DNA motifs eg, G or AT or GCA
  function motifArr (Str, j) {
    rfcount = 0;
    let len = PHP_vars.motif_len;
    let Arr = [];
    for (i = 0; i < Str.length; i = i + len) {
      // Ah ha!! here we set troublesome key
      rfcount = j + i;
      // console.log(rfcount);
      Arr[rfcount] = Str.slice(i, i + len); // chop string to motifs
    }
    // console.log('Arr', Arr);
    return Arr;
  }
  // var oneMotifArr = motifArr(PHP_vars.dnaString);
  // console.log('oneMotifArr', oneMotifArr);

  // returne array of reading frames i.e. 1 or 2 or 3 eg Array [ 0, 1, 2 ]
  function RFArr () {
    let slide = PHP_vars.RF_numb;
    let len = PHP_vars.motif_len;
    Arr = [];
    if (slide < len) {
      for (i = 0; i < len; i++) {
        Arr[i] = i;
      }
    } else if (slide === len) {
      Arr[0] = 0;
    }
    return Arr;
  }

  // returns a multidimensional array, i.e. the motifs for each reading frame
  function makeRFMotifArr () {
    let rf = RFArr();
    let Str = PHP_vars.dnaString;
    let ArrB = [];
    let slicerNumber = 0;
    // console.log('rf', rf, 'rf.length', rf.length)
    let rfcount = rf.length;
    for (let j = 0; j < rfcount; j++) {
      if (j > 0) {
        slicerNumber = 1;
      }
      Str = Str.slice(slicerNumber); // chop first character
      // console.log('j', j, Str);

      ArrB[j] = motifArr(Str, j);
    }
    return ArrB;
  }

  function sortArrkeys (Arr) {
    Arr = Arr.filter(function () {
      return true;
    }); // reset key to actual
    // console.log(Arr);
    return Arr;
  }

  // return an Object, eg. ATG returns Object { stp: false, srt: true }
  function silent (motif) {
    // console.log(motif)
    if (motif === 'TGA' || motif === 'TAG' || motif === 'TAA') {
      return {
        stp: true,
        srt: false
      };
    } else if (motif === 'ATG') {
      return {
        stp: false,
        srt: true
      };
    } else {
      return {
        stp: undefined,
        srt: undefined
      };
    }
  }

  function getLength () {
    return PHP_vars.dnaString.length;
  }

  function RFMotifArr_STOPS (AllMotifArr, RFMotifArr) {
    var stopstart = PHP_vars.stopstart;
    var ArrRF = [];
    var rfcount = 0;

    AllMotifArr.forEach(function (rf) {
      var motifToFreq = [];
      var count = 0;
      var stopUntil = 0;
      // RFMotifArr[rf] = sortArrkeys(RFMotifArr[rf]);
      var RFArrLen = RFMotifArr[rf].length;
      // console.log(RFArrLen);// strange key in threes!!!

      if (stopstart === 'silent') {
        stopUntil = RFArrLen;
      }

      RFMotifArr[rf].forEach(function (motif, key) {
        if (silent(motif)['srt'] === true) {
          if (PHP_vars.sonify_motif === 'yes') {
            motif = 'start';
          }
          stopUntil = 0;
        }

        if (silent(motif)['stp'] === true) {
          if (PHP_vars.sonify_motif === 'yes') {
            var stopMotif = 'stop';
          }
          stopUntil = RFArrLen;
          if (stopstart === 'yes') {
            stopUntil = count + 30;
          }
        }

        if (key < stopUntil && motif.length === 3) {
          motif = ' . ';
        }
        if (stopMotif === 'stop') {
          motif = stopMotif; // overwrite xxx on actual stop codon
        }
        // console.log('key', key, 'count', count, 'stopUntil', stopUntil, 'motif', motif)
        count = count + 3;
        motifToFreq[key] = motif;
      });

      ArrRF[rfcount] = motifToFreq;
      rfcount++;
    });
    // console.log(ArrRF)
    return ArrRF;
  }

  // Toggle options from php pages eg frameNum 3
  // if 3 then modify motifs to include stops or keep original;
  function stopStartOptions () {
    // console.log('frameNum', frameNum);
    if (PHP_vars.frameNum === '3') {
      var stopstart = PHP_vars.stopstart;
      if (stopstart !== 'no') {
        return RFMotifArr_STOPS(AllMotifArr, RFMotifArr);
      }
    }
    return RFMotifArr;
  }

  function multiToSingle_array (datablip) {
    let sortedArr = [];
    datablip.forEach(function (val, key) {
      val.forEach(function (val2, key2) {
        // sortedArr.push({key2, val2});
        // it is sorted but not by me??? BECAUSE I set the keys earlier
        sortedArr[key2] = val2;
      });
    });
    sortArrkeys(sortedArr);
    return sortedArr;
  }

  function toMP3 (Arr) {
    let timeNoteNumber = [];
    let time = 0;
    let noteNumber = '';
    let rfcount = RFArr().length;
    let Unique_notes = [];
    // let count = 0;

    Arr.forEach(function (dnaMotif, key) {
      let rf = key % PHP_vars.motif_len;
      time = key * 0.16;
      // if(dnaMotif.length !== PHP_vars.motif_len){return} // FUCK

      if (PHP_vars.frameNum === '3') {
        noteNumber = codonToNoteNumber(dnaMotif);
        Unique_notes = [
          'C4.mp3',
          'Eb4.mp3',
          'F4.mp3',
          'Gb4.mp3',
          'G4.mp3',
          'Bb4.mp3',
          'C5.mp3',
          'Eb5.mp3',
          'F5.mp3',
          'Gb5.mp3',
          'G5.mp3',
          'Bb5.mp3',
          'C6.mp3',
          'Eb6.mp3',
          'F6.mp3',
          'Gb6.mp3',
          'G6.mp3',
          'Bb6.mp3',
          'C7.mp3',
          'Eb7.mp3',
          'F7.mp3',
          'stop.mp3',
          'start.mp3'
        ];
      } else if (PHP_vars.frameNum === '1') {
        noteNumber = codonToNoteNumber(dnaMotif);
        Unique_notes = [
          'C2.mp3',
          'Eb2.mp3',
          'F2.mp3',
          'Gb2.mp3',
          'G2.mp3',
          'Bb2.mp3',
          'C3.mp3',
          'Eb3.mp3',
          'F3.mp3',
          'Gb3.mp3',
          'G3.mp3',
          'Bb3.mp3',
          'C4.mp3',
          'Eb4.mp3',
          'F4.mp3',
          'Gb4.mp3',
          'G4.mp3',
          'Bb4.mp3',
          'C5.mp3',
          'Eb5.mp3',
          'F5.mp3',
          'stop.mp3',
          'start.mp3'
        ];
      } else if (PHP_vars.frameNum === '3bp') {
        noteNumber = bp3ToNoteNumber(dnaMotif);
        Unique_notes = [
          'C2.mp3',
          'Db2.mp3',
          'D2.mp3',
          'Eb2.mp3',
          'E2.mp3',
          'F2.mp3',
          'Gb2.mp3',
          'G2.mp3',
          'Ab3.mp3',
          'A3.mp3',
          'Bb3.mp3',
          'B3.mp3',
          'C3.mp3',
          'Db3.mp3',
          'D3.mp3',
          'Eb3.mp3',
          'E3.mp3',
          'F3.mp3',
          'Gb3.mp3',
          'G3.mp3',
          'Ab4.mp3',
          'A4.mp3',
          'Bb4.mp3',
          'B4.mp3',
          'C4.mp3',
          'Db4.mp3',
          'D4.mp3',
          'Eb4.mp3',
          'E4.mp3',
          'F4.mp3',
          'Gb4.mp3',
          'G4.mp3',
          'Ab5.mp3',
          'A5.mp3',
          'Bb5.mp3',
          'B5.mp3',
          'C5.mp3',
          'Db5.mp3',
          'D5.mp3',
          'Eb5.mp3',
          'E5.mp3',
          'F5.mp3',
          'Gb5.mp3',
          'G5.mp3',
          'Ab6.mp3',
          'A6.mp3',
          'Bb6.mp3',
          'B6.mp3',
          'C6.mp3',
          'Db6.mp3',
          'D6.mp3',
          'Eb6.mp3',
          'E6.mp3',
          'F6.mp3',
          'Gb6.mp3',
          'G6.mp3',
          'Ab7.mp3',
          'A7.mp3',
          'Bb7.mp3',
          'B7.mp3',
          'C7.mp3',
          'Db7.mp3',
          'D7.mp3',
          'Eb7.mp3',
          'E7.mp3',
          'F7.mp3',
          'Gb7.mp3',
          'G7.mp3'
        ];
      } else if (PHP_vars.frameNum === '2bp' || PHP_vars.frameNum === '2bpx2') {
        noteNumber = bp2ToNoteNumber(dnaMotif);
        Unique_notes = [
          'C3.mp3',
          'Eb3.mp3',
          'F3.mp3',
          'Gb3.mp3',
          'G3.mp3',
          'Bb3.mp3',
          'C4.mp3',
          'Eb4.mp3',
          'F4.mp3',
          'Gb4.mp3',
          'G4.mp3',
          'Bb4.mp3',
          'C5.mp3',
          'Eb5.mp3',
          'F5.mp3',
          'Gb5.mp3'
        ];
      } else if (PHP_vars.frameNum === '1bp') {
        noteNumber = bp1ToNoteNumber(dnaMotif);
        Unique_notes = ['C3.mp3', 'Eb4.mp3', 'F5.mp3', 'Gb6.mp3'];
      }
      // console.log(noteNumber !== undefined);

      let mp3Name;
      if (noteNumber !== '' && noteNumber !== undefined) {
        // console.log(Unique_notes[noteNumber])
        mp3Name = Unique_notes[noteNumber].slice(0, -4);
        timeNoteNumber[key] = [time, noteNumber, rf, mp3Name];
        // console.log(mp3Name);
      } else {
        mp3Name = ' ';
        timeNoteNumber[key] = [time, noteNumber, rf, mp3Name];
        // console.log(mp3Name);
      }

      // console.log('rf', rf, 'dnaMotif',dnaMotif, 'PHP_vars.motif_len', PHP_vars.motif_len)
      if (dnaMotif.length >= PHP_vars.motif_len) {
        animationQueue.push({
          time: time,
          dnaMotif: dnaMotif,
          rf: rf,
          key: key,
          mp3Name: mp3Name
        });
      }
    });
    timeNoteNumber = timeNoteNumber.filter(function () {
      return true;
    }); // reset key to actual
    // console.log(timeNoteNumber)
    return { timeNoteNumber, Unique_notes };
  }

  async function makeMP3notes (Unique_notes, folder) {
    const decodeAudioData = arrayBuffer =>
      new Promise((resolve, reject) => {
        DNAaudioContext.decodeAudioData(arrayBuffer, resolve, reject);
      });

    function loadAudioFile (filename) {
      filename = folder + filename;
      // console.log('fetch these to make buffers',filename)
      return fetch(filename)
        .then(response => response.arrayBuffer())
        .then(decodeAudioData);
    }
    loadedAudioFiles = await Promise.all(Unique_notes.map(loadAudioFile));
    return loadedAudioFiles; // make array of buffers 0 1 2 ?? based on RFArr()
  }

  async function callmakeMP3notes (ObjFromtoMP3) {
    // startstop folder index 3??
    const loadedAudioFiles = [];

    for (const RF of RFArr()) {
      const audioBuffer = await makeMP3notes(
        ObjFromtoMP3.Unique_notes,
        folders().f[RF],
        RF
      );
      loadedAudioFiles.push(audioBuffer);
    }
    return loadedAudioFiles;
  }

  async function playMP3notes (ObjFromtoMP3) {
    var startOfDNA_audio = '';
    loadedAudioFiles = await callmakeMP3notes(ObjFromtoMP3);
    var key = 0;
    // console.log('loadedAudioFiles', loadedAudioFiles)
    // ObjFromtoMP3.timeNoteNumber.forEach(function(time_note , key) {
    for (const time_note of ObjFromtoMP3.timeNoteNumber) {
      key++;
      let time = time_note[0];
      let note = time_note[1];
      let rf = time_note[2];

      let source = DNAaudioContext.createBufferSource();
      source.buffer = loadedAudioFiles[rf][note];
      source.connect(DNAaudioContext.destination);
      source.start(DNAaudioContext.currentTime + time);
      if (time === 0) {
        startOfDNA_audio = DNAaudioContext.currentTime + time;
      }
    }
    if (key === ObjFromtoMP3.timeNoteNumber.length) {
      return startOfDNA_audio;
    }
  }

  function redGreen (rf, col) {
    c.beginPath();
    c.arc(90 + 160 * rf, 80, 70, 0, 2 * Math.PI, false);
    c.fillStyle = col;
    c.fill();
  }

  function syncThis () {
    const items = animationQueue.filter(x => {
      // .log(DNAaudioContext.currentTime);
      return DNAaudioContext.currentTime >= x.time + audio;
    });
    animationQueue.splice(0, items.length);
    for (const item of items) {
      // console.log(item)
      let x1 = 90 + 160 * 0;
      let x2 = 90 + 160 * 1;
      let x3 = 90 + 160 * 2;
      // let x1 = 80+150*item.rf;
      // let x1 = 80+150*item.rf;
      c.clearRect(0, 0, canvas.width, canvas.height);
      c.fillStyle = '#F2F0E6';
      c.fillRect(0, 0, canvas.width, canvas.height);

      c.beginPath();
      c.arc(x1, 80, 70, 0, 2 * Math.PI);
      c.arc(x2, 80, 70, 0, 2 * Math.PI);
      c.arc(x3, 80, 70, 0, 2 * Math.PI);
      c.fillStyle = '#E7DBBD';
      c.fill();

      c.textAlign = 'center';
      c.font = '2em Roboto Mono';
      c.fillStyle = '#F2F0E6';
      // console.log(RFArr());
      if (RFArr().length === 1) {
        c.fillText('Frame 1', x1, 190);
      }
      if (RFArr().length === 2) {
        c.fillText('Frame 1', x1, 190);
        c.fillText('Frame 2', x2, 190);
      }
      if (RFArr().length === 3) {
        c.fillText('Frame 1', x1, 190);
        c.fillText('Frame 2', x2, 190);
        c.fillText('Frame 3', x3, 190);
      }
      // c.fillText('RF2', 90, 16);
      // c.fillText('RF3', 180, 16);
      if (item.dnaMotif === 'stop') {
        redGreen(item.rf, '#C64521');
      } else if (item.dnaMotif === 'start') {
        redGreen(item.rf, 'green');
      } else if (item.dnaMotif === ' . ') {
        c.fillStyle = '#C64521';
        c.fillText(item.dnaMotif, 90 + 160 * item.rf, 80);
      } else {
        c.fillStyle = '#C64521';
        c.fillText(item.dnaMotif, 90 + 160 * item.rf, 80);
      }
      c.fillStyle = '#525552';
      c.font = '1.2em Verdana';

      if (RFArr().length === 1) {
        c.fillText(folders().inst[0], x1, 175);
      }
      if (RFArr().length === 2) {
        c.fillText(folders().inst[0], x1, 175);
        c.fillText(folders().inst[1], x2, 175);
      }
      if (RFArr().length === 3) {
        c.fillText(folders().inst[0], x1, 175);
        c.fillText(folders().inst[1], x2, 175);
        c.fillText(folders().inst[2], x3, 175);
      }

      c.fillStyle = '#5588AA';
      c.fillText(item.mp3Name, 90 + 160 * item.rf, 130);
      c.font = '0.9em Verdana';

      // c.textAlign = 'right';
      // c.fillText('Base Pair#', 100, 75);
      c.fillStyle = '#C64521';
      c.fillText(item.key + 1, 475, 192);
      // stop recursive calls to syncThis - check this is the case...
      if (animationQueue.length === 0) {
        // return DNAaudioContext.close()
        return setTimeout(function()  {
          DNAaudioContext.close();
        }, 3000); // fadeout
      }
    }
    // console.log('call syncThis')
    window.requestAnimationFrame(() => syncThis());
    // console.log('requestAnimationFrame')
    // window.setInterval(() => syncThis())
  }

  var AllMotifArr = RFArr();
  // console.log('AllMotifArr', AllMotifArr)
  var RFMotifArr = makeRFMotifArr();
  // console.log('RFMotifArr', RFMotifArr);
  var data = stopStartOptions();
  // console.log(data);
  var motifsForAudio = multiToSingle_array(data);
  // console.log('motifsForAudio', motifsForAudio);
  var Mp3_OrderToPlayArr = toMP3(motifsForAudio);
  // console.dir(Mp3_OrderToPlayArr);
  var audio = await playMP3notes(Mp3_OrderToPlayArr);
  // console.log(audio);
  // console.log(PHP_vars.sonify_motif)
  // console.log('RFMotifArr', RFMotifArr)

  syncThis();

}; // end window.onload

// window.addEventListener('error', (...args) => {
//   console.log(args);
// });
function playUnlockNote () {
  let oscillator = DNAaudioContext.createOscillator();
  let DNAgain = DNAaudioContext.createGain();
  DNAgain.gain.setValueAtTime(0.0001, 0);
  oscillator.frequency.setValueAtTime(440, 0.01);

  oscillator.connect(DNAgain);
  DNAgain.connect(DNAaudioContext.destination);
  oscillator.start(DNAaudioContext.currentTime);
  oscillator.stop(DNAaudioContext.currentTime + 0.01);
}

window.addEventListener('load', () => {
  var suspendBtn = document.getElementById('suspend');
  var playBtn = document.getElementById('play');
  /* run the functions on  clicking button */
  suspendBtn.addEventListener('click', suspendContext);
  playBtn.addEventListener('click', playAudio);

  disableButtons(suspendBtn);
  enableButtons(playBtn);

  function playAudio () {
    disableButtons(playBtn);
    enableButtons(suspendBtn);
    playBtn.removeEventListener('click', playAudio);
    playBtn.addEventListener('click', resumeContext);
    playBtn.innerHTML = playBtn.innerHTML.replace('Play', 'Resume');
    
    playUnlockNote();

    playDnaAudio();
  }
  function suspendContext () {
    DNAaudioContext.suspend();
    disableButtons(suspendBtn);
    enableButtons(playBtn);
  }
  function resumeContext () {
    DNAaudioContext.resume();
    disableButtons(playBtn);
    enableButtons(suspendBtn);
  }
  function enableButtons () {
    setMultipleStatus(arguments, true);
  }
  function disableButtons () {
    setMultipleStatus(arguments, false);
  }
  function setMultipleStatus (items, enabled) {
    Array.from(items).forEach(b => (b.disabled = !enabled));
  }
});
