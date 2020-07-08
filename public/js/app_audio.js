//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var recorder; 						//WebAudioRecorder object
var input; 							//MediaStreamAudioSourceNode  we'll be recording
var encodingType; 					//holds selected encoding for resulting audio (file)
var encodeAfterRecord = true;       // when to encode
var start_record = false;

// shim for AudioContext when it's not avb.
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext; //new audio context to help us record

var encodingTypeSelect = document.getElementById("encodingTypeSelect");
var recordButton = document.getElementById("recordButton");
var stopButton = document.getElementById("stopButton");
var stopButton2 = document.getElementById("stopButton2");

//add events to those 2 buttons
if(recordButton) recordButton.addEventListener("click", startRecording);
if(stopButton) stopButton.addEventListener("click", stopRecording);
if (stopButton2) stopButton2.addEventListener("click", stopRecording);


function startRecording() {
	console.log("startRecording() called");
	$('#recordButton').css('background-color', 'green');
	$('#recordButton').text('Recording...');

	start_record = true;

	$('#time_record').closest('p').show();

	startTimer(120, document.querySelector('#time_record'));
	// var i = 0;
	// setInterval(function() {
	// 	$('#time_record').text(i++);
	// }, 1000);
	/*
		Simple constraints object, for more advanced features see
		https://addpipe.com/blog/audio-constraints-getusermedia/
	*/

	var constraints = { audio: true, video:false }

	/*
		We're using the standard promise based getUserMedia()
		https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/
	navigator.mediaDevices.getUserMedia = navigator.mediaDevices.getUserMedia || navigator.mediaDevices.webkitGetUserMedia || navigator.mediaDevices.mozGetUserMedia;

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		__log("getUserMedia() success, stream created, initializing WebAudioRecorder...");

		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
			the sampleRate defaults to the one set in your OS for your playback device

		*/
		audioContext = new AudioContext();

		//update the format
		document.getElementById("formats").innerHTML="Format: 2 chanel wav @ "+audioContext.sampleRate/1000+"kHz"

		//assign to gumStream for later use
		gumStream = stream;

		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);

		//stop the input from playing back through the speakers
		//input.connect(audioContext.destination)

		//get the encoding
		encodingType = 'wav';

		//disable the encoding selector


		recorder = new WebAudioRecorder(input, {
			workerDir: "js/", // must end with slash
			encoding: encodingType,
			numChannels:2, //2 is the default, mp3 encoding supports only 2
			onEncoderLoading: function(recorder, encoding) {
				// show "loading encoder..." display
				__log("Loading "+encoding+" encoder...");
			},
			onEncoderLoaded: function(recorder, encoding) {
				// hide "loading encoder..." display
				__log(encoding+" encoder loaded");
			}
		});

		recorder.onComplete = function(recorder, blob) {
			__log("Encoding complete");
			createDownloadLink(blob,recorder.encoding);

		}

		recorder.setOptions({
			timeLimit:120,
			encodeAfterRecord:encodeAfterRecord,
			ogg: {quality: 0.5},
			mp3: {bitRate: 160}
		});

		//start the recording process
		recorder.startRecording();

		__log("Recording started");

	}).catch(function(err) {
		//enable the record button if getUSerMedia() fails
		recordButton.disabled = false;
		stopButton.disabled = true;

	});

	//disable the record button
	recordButton.disabled = true;
	stopButton.disabled = false;
}

function stopRecording() {
	console.log("stopRecording() called");

	if (!start_record) return false;

	//stop microphone access
	console.log(gumStream);
	gumStream.getAudioTracks()[0].stop();

	//disable the stop button
	stopButton.disabled = true;
	recordButton.disabled = false;

	//tell the recorder to finish the recording (stop recording + encode the recorded audio)
	recorder.finishRecording();

	__log('Recording stopped');
}

function createDownloadLink(blob,encoding) {

	var formData = new FormData();
	formData.append('fname', 'test.wav');
	formData.append('data', blob);
	formData.append('exam_lvl', $('[name="exam_lvl"]').val());

	$('#stopButton').hide();
	$('.course-tests__test-buttons p').show();

	var request = new XMLHttpRequest();
	request.open("POST", '/'+$('.header__lang-select').text().toLowerCase()+"/proccessing_exam/post_oral/send");
	request.setRequestHeader('X-CSRF-TOKEN', $('[name="_token"]').val());
	request.send(formData);
	request.onload = function() {
		console.log('Загружено:'+  request.status + ' - ' + request.response);
		window.location.replace(request.response);
	};


	// console.log(blob);
	// var url = URL.createObjectURL(blob);
	// var au = document.createElement('audio');
	// var li = document.createElement('li');
	// var link = document.createElement('a');


	//add controls to the <audio> element
	// au.controls = true;
	// au.src = url;
	//
	// //link the a element to the blob
	// link.href = url;
	// link.download = new Date().toISOString() + '.'+encoding;
	// link.innerHTML = link.download;
	//
	// //add the new audio and a elements to the li element
	// li.appendChild(au);
	// li.appendChild(link);
	//
	// //add the li element to the ordered list
	// recordingsList.appendChild(li);
}


//helper function
function __log(e, data) {
	log.innerHTML += "\n" + e + " " + (data || '');
}
