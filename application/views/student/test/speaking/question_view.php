<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"><button onclick="window.location = '<?php echo base_url(); ?>teacher/test/speaking_student/<?php echo $this->uri->segment(4); ?>'" class="btn btn-light d-none d-lg-block m-l-15"><i class="fa fa-arrow-left"></i> Back</button></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->

<div class="row">
    <div class="col-12">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <b>Questions</b>
            </div>
            
            <div class="card-body">
                
                <div class="row">
                    <div class="col-12">
                        <!-- Block Question 1 -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Question</th>
                                        <th>Answer Student</th>
                                    </tr>
                                </thead>
                                <?php $no = 1; ?>
                                <?php foreach( $qw_speaking_sub_test->result() as $row ): ?>
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <?php echo ( $row->speaking_sub_test_intro == null )? '' : $row->speaking_sub_test_intro; ?>
                                                
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td>
                                            <audio controls>
                                              <source src="<?php echo $row->speaking_sub_test_answer; ?>" type="audio/mpeg">
                                              Your browser does not support the audio element.
                                            </audio>
                                        </td>
                                        <td>
                                            <?php 

                                                $ans = $this->db->get_where('speaking_answer', ['speaking_test_id' => $this->uri->segment(4), 'student_id' => $this->session->userdata('__ci_studentid') ,'speaking_sub_test_id' => $row->speaking_sub_test_id])->row();

                                                if ( $ans->speaking_answer_choose == null ) { ?>

                                                    <a href="#record" data-toggle="modal" data-id="<?php echo $ans->speaking_answer_id; ?>" class="record btn btn-primary">Record</a>

                                                <?php } else { ?>

                                                    <audio controls>
                                                      <source src="<?php echo $ans->speaking_answer_choose; ?>" type="audio/mpeg">
                                                      Your browser does not support the audio element.
                                                    </audio>
                                                    <br>
                                                    <a href="<?php echo base_url(); ?>student/test/speaking_student_answer_del/<?php echo $ans->speaking_answer_id; ?>" class="ml-3"><i class="ti-trash"></i> delete</a>

                                            <?php }


                                             ?>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Modal Create -->
<div id="record" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Record </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body text-center pl-5 pr-5">
                <h1 class="display-1"><i class="ti-microphone"></i></h1>
                <input id="answer_id" type="hidden" value="">
                <button id="recordButton" class="btn btn-primary">Record</button>
                <button id="pauseButton" disabled class="btn btn-warning">Pause</button>
                <button id="stopButton" disabled class="btn btn-danger">Stop</button>

                <div id="recordingsList" class="mt-4"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script>

    const el = $('.record');
    const answer_id = $('#answer_id');

    el.on("click", function(){
        answer_id.val($(this).data("id"));
    })
    //webkitURL is deprecated but nevertheless
    URL = window.URL || window.webkitURL;

    var gumStream;                      //stream from getUserMedia()
    var rec;                            //Recorder.js object
    var input;                          //MediaStreamAudioSourceNode we'll be recording

    // shim for AudioContext when it's not avb. 
    var AudioContext = window.AudioContext || window.webkitAudioContext;
    var audioContext //audio context to help us record

    var recordButton = document.getElementById("recordButton");
    var stopButton = document.getElementById("stopButton");
    var pauseButton = document.getElementById("pauseButton");
    var recordingsList = document.getElementById("recordingsList");

    //add events to those 2 buttons
    recordButton.addEventListener("click", startRecording);
    stopButton.addEventListener("click", stopRecording);
    pauseButton.addEventListener("click", pauseRecording);


    function startRecording() {
        console.log("recordButton clicked");

        recordingsList.innerHTML = "";

        /*
            Simple constraints object, for more advanced audio features see
            https://addpipe.com/blob/audio-constraints-getusermedia/
        */
        
        var constraints = { audio: true, video:false }

        /*
            Disable the record button until we get a success or fail from getUserMedia() 
        */

        recordButton.disabled = true;
        stopButton.disabled = false;
        pauseButton.disabled = false

        /*
            We're using the standard promise based getUserMedia() 
            https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
        */

        navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
            console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

            /*
                create an audio context after getUserMedia is called
                sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
                the sampleRate defaults to the one set in your OS for your playback device

            */
            audioContext = new AudioContext();

            //update the format 
            // document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"

            /*  assign to gumStream for later use  */
            gumStream = stream;
            
            /* use the stream */
            input = audioContext.createMediaStreamSource(stream);

            /* 
                Create the Recorder object and configure to record mono sound (1 channel)
                Recording 2 channels  will double the file size
            */
            rec = new Recorder(input,{numChannels:1})

            //start the recording process
            rec.record()

            console.log("Recording started");

        }).catch(function(err) {
            //enable the record button if getUserMedia() fails
            recordButton.disabled = false;
            stopButton.disabled = true;
            pauseButton.disabled = true
        });
    }

    function pauseRecording(){
        console.log("pauseButton clicked rec.recording=",rec.recording );
        if (rec.recording){
            //pause
            rec.stop();
            pauseButton.innerHTML="Resume";
        }else{
            //resume
            rec.record()
            pauseButton.innerHTML="Pause";

        }
    }

    function stopRecording() {
        console.log("stopButton clicked");

        //disable the stop button, enable the record too allow for new recordings
        stopButton.disabled = true;
        recordButton.disabled = false;
        pauseButton.disabled = true;

        //reset button just in case the recording is stopped while paused
        pauseButton.innerHTML="Pause";
        
        //tell the recorder to stop the recording
        rec.stop();

        //stop microphone access
        gumStream.getAudioTracks()[0].stop();

        //create the wav blob and pass it on to createDownloadLink
        rec.exportWAV(createDownloadLink);
    }

    function createDownloadLink(blob) {
        
        var url = URL.createObjectURL(blob);
        var au = document.createElement('audio');
        var li = document.createElement('div');
        var link = document.createElement('div');

        //name of .wav file to use during upload and download (without extendion)
        var filename = new Date().toISOString();

        //add controls to the <audio> element
        au.controls = true;
        au.src = url;
        au.style.display = "block";
        au.style.width = "100%";


        link.innerHTML = "<a class='btn btn-primary mt-4 mb-4' href='"+url+"' download='"+filename+".mp3'>Download</a><br>";

        //add the new audio element to li
        li.appendChild(au);
        
        //add the filename to the li
        // li.appendChild("<br>");

        //add the save to disk link to li
        li.appendChild(link);
        
        //upload link
        var upload = document.createElement('a');
        upload.href="#";
        upload.innerHTML = "Upload";
        upload.addEventListener("click", function(event){
              var xhr=new XMLHttpRequest();
              xhr.onload=function(e) {
                  if(this.readyState === 4) {
                      if(e.target.responseText == 'success') {
                        window.location.reload();
                      } else {
                        alert( "Error message : "+ e.target.responseText + "" );
                      }
                  }
              };
              var fd=new FormData();
              fd.append("fname",filename);
              fd.append("audio_data",blob);
              xhr.open("POST","<?php echo base_url(); ?>student/test/speaking_student_answer/"+answer_id.val()+"",true);
              xhr.send(fd);
        })

        li.appendChild(document.createTextNode (" "))//add a space in between
        li.appendChild(upload)//add the upload link to li

        //add the li element to the ol
        recordingsList.appendChild(li);
    }
</script>