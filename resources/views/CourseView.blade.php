{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Courses</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <Style>
        hr {background-color: rgb(158, 207, 205); height: 50px; border: 2; }
    </Style>
</head>
<body>
    <div class="container">
        <div style="height:100px; margin-top: 20px" align="Right">
     @if(session()->has('user'))
      <h3> {{ Session::get('user') }}  </h3>
      <a href='/Logout'>Logout</a>
@endif
</div> --}}

@extends('SHome')
@section('header')
    <script src="https://download.affectiva.com/js/3.2.1/affdex.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="./css/bootstrap-theme.min.css"></script> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


@endsection
@section('Content')
    @foreach ($CourseNAme as $CourseNAme )
        <h2> {{$CourseNAme->Name}}</h2>
    @endforeach
    <div style="height:20px">

    </div>
    <h4>Course Materials</h4>
    <div style="height:20px"></div>


    <!-- ../storage/PDF/ -->

    <iframe class="youtube-video" width="560" height="315"
            src="https://www.youtube.com/embed/mhhgh84ZDmE?enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0"
            allowfullscreen></iframe>
    <div>
        <a href="#" onclick="onStart()" class="play-video">Play Video</a>&nbsp &nbsp
        <a href="#" class="pause-video">Pause Video</a> &nbsp
        <a href="#" onclick="showQuestions()" class="stop-video">Stop Video</a> &nbsp &nbsp
        <a href="#" onclick="answerQuestions()" class="">Submit Answers</a> &nbsp
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8" id="affdex_elements" style="width:680px;height:480px; visibility:hidden;"></div>
            <div class="col-md-4">
                <div style="height:25em;">
                    <strong>EMOTION TRACKING RESULTS</strong>
                    <div id="results" style="word-wrap:break-word;"></div>
                </div>
                <div>
                    <strong>DETECTOR LOG MSGS</strong>
                </div>
                <div id="logs"></div>
            </div>
        </div>
        <!-- <div>
            <button id="start" onclick="onStart()">Start</button>
            <button id="stop" onclick="onStop()">Stop and Submit</button>
            <button id="reset" onclick="onReset()">Reset</button>
            <h2 id="score"></h2>
        </div> -->
    </div>



    @foreach ($CourseMaterials as $CourseMaterials )
        {{-- <hr> --}}
        <div style="background-color: rgb(158, 207, 205); height: 50px; border: 2;">
            <h4> {{$CourseMaterials->WEEK}}</h4>
        </div>
        <div style="height:20px">
        <!-- <embed src="../storage/PDF/{{$CourseMaterials->Name}}" width="800px" height="2100px" /> -->
            <a href="../storage/PDF/{{$CourseMaterials->Name}}" download="{{$CourseMaterials->Name}}">
                <p>{{$CourseMaterials->Name}}</p></a>

            <div id="list"></div>
            @endforeach
            @endsection
            @section('scripts')
                <script>
                    var q = []
                    var marks = 0.0;
                    var promises = []
                    var faceDetection = 0;
                    var bodyLang = 0;
                    var faceProb = 0;
                    var bodyProb = 75;
                    var finalQuestionMarks = 0;

                    function showQuestions() {
                        this.onStop();
                        this.stopAndSubmit();
                        $.ajax({
                            url: '/api/v1/get-questions',
                            type: 'GET',
                            contentType: 'application/json; charset=utf-8',
                            success: function (data) {
                                console.log(data);
                                // questionsAll = data
                                //  alert(JSON.stringify(data))
                                //   $('#question').html(data[0].question);
                                let a = data.data
                                q = data.data
                                $(document).ready(function () {
                                    var list = ''
                                    for (i = 0; i < a.length; i++) {
                                        // list += "<li>" + data[i].question + "</li>";
                                        if (a[i].type == 1) {
                                            list += '<label name="que" value="' + i + '" >' + a[i].question + '</label><div id="' + a[i].id + '"><input type="radio" id="yes" value="YES"><label>YES</label><input type="radio" id="no"  value="NO"><label>NO</label></div><br>'
                                        } else {
                                            list += '<label name="que" value="' + i + '" >' + a[i].question + '</label><div id="' + a[i].id + '"><input type="text"></div><br>'
                                        }
                                        // list += '<label name="que" value="' + i + '" >'+ a[i].question + '</label><div id="'+a[i].id+'">';
                                        // list += a[i].type == 1 ? '<input type="radio" value="YES"><label>YES</label><input type="radio"  value="NO"><label>NO</label>' : '<input type="text">';
                                        // list += '</div><br>';
                                    }
                                    $("#list").append(list);
                                });
                            },


                        });
                    }

                    function answerQuestions() {
                        let answers = [];
                        console.log( JSON.stringify({
                                    "m1_val": faceDetection,
                                    "m1_cert": faceProb,
                                    "m2_val": bodyLang,
                                    "m2_cert": bodyProb,
                                    "m3_val": finalQuestionMarks
                                }))
                                console.log(faceDetection, faceProb, bodyLang)
                        q.forEach(function (val, key) {
                            let id = "#" + val.id;

                            if (val.type == 1) {
                                let answer = $(id).find(":checked").val();
                                answers.push(answer);
                                if (val.answer == answer) {
                                    marks += 1;
                                }
                            } else if (val.type == 2 || val.type == 3) {
                                let writtenAnswer = $(id).find("input").val();
                                let isFinal = false;
                                if ((q.length - 1) - key) {
                                    isFinal = true;
                                }

                                this.getAnswersScore(val.answer, writtenAnswer, isFinal)
                                // console.log('this.getAnswersScore(val.answer,writtenAnswer )')
                                // console.log(res.responseJSON)
                                // $.ajax({
                                //     url: 'http://localhost:8001/answers',
                                //     type: 'post',
                                //     data:JSON.stringify({marking_answer: val.answer, student_answer: writtenAnswer}),
                                //     dataType:"json",
                                //     contentType: 'application/json',
                                //     success: function (data) {
                                //         marks += data.score;

                                //         console.log(data);
                                //         // alert(JSON.stringify(data))
                                //         // console.log('JSON.stringify(data)')
                                //         // console.log(JSON.stringify(data))
                                //     },
                                // })
                            }


                        });
                        // .then(function (e) {
                        //     console.log(answers.length)
                        //     console.log(marks)
                        //     let total =  (marks / q.length) * 100
                        //     alert('Your marks - ' + total + '%');
                        // })
                        // console.log(q.length)
                        //     console.log(marks)
                        //     let total =  (marks / q.length) * 100
                        // alert('Your marks - ' + total + '%');
                        let self = this;
                        $.when.apply(null, promises).done(function () {
                            finalQuestionMarks = Math.round((marks / q.length) * 100);
                            console.log('Shahsiii>>>>>>>  ' + Math.round((marks / q.length) * 100))
                            self.getFinalResult();
                        })
                    }

                    function getFinalResult(){
                        $.ajax({
                                // url: 'https://1f51e8ac6773.ngrok.io/getprediction?m1_val=' + faceDetection +'&m1_cert='+ faceProb +'&m2_val='+ bodyLang +'&m2_cert='+ bodyProb +'&m3_val='+ finalQuestionMarks,
                                url: '/api/v1/get-final',
                                type: 'POST',
                                data: JSON.stringify({
                                    "url" : 'https://1f51e8ac6773.ngrok.io/getprediction?m1_val=' + faceDetection +'&m1_cert='+ faceProb +'&m2_val='+ bodyLang +'&m2_cert='+ bodyProb +'&m3_val='+ finalQuestionMarks
                                }),
                                contentType: 'application/json; charset=utf-8',
                                success: function (data) {
                                    console.log(data.body.final_value);
                                    alert('Final Output - ' + data.body.final_value)
                                   
                                },
                            })
                    }

                    function getAnswersScore(marking_answer, matching_answer, isFinal) {
                        // return new Promise((resolve, reject) => {
                        let request = $.ajax({
                            url: 'http://3.131.76.24:8000/answers',
                            type: 'post',
                            data: JSON.stringify({marking_answer: marking_answer, student_answer: matching_answer}),
                            dataType: "json",
                            contentType: 'application/json',
                            success: function (data) {
                                // console.log(data);
                                // // alert(JSON.stringify(data))
                                // console.log('JSON.stringify(data)')
                                // console.log(JSON.stringify(data))
                                marks += data.score;
                                // let total1 =  (marks / q.length) * 100
                                // alert('Your marks - ' + total1.toFixed(2) + '%');
                                // if(isFinal) {
                               //     let total1 =  (marks / q.length) * 100;
                                //     alert('You have got -' + total1);
                                // }
                                // resolve(data);
                            },
                            // })
                        });
                        promises.push(request);
                        // let result = await promise;
                        // console.log('result')
                        // console.log(result)
                        // return result;
                    }
                </script>

            @section('scripts')
                <script>
                    var detector = null;
                    let faceParams = []
                    $(document).ready(function () {
                        console.log('ran')
                        // SDK Needs to create video and canvas nodes in the DOM in order to function
                        // Here we are adding those nodes a predefined div.
                        var divRoot = $("#affdex_elements")[0];
                        // var divRoot = Document.getElementById('#affdex_elements')
                        var width = 0;
                        var height = 0;
                        var faceMode = affdex.FaceDetectorMode.LARGE_FACES;
                        //Construct a CameraDetector and specify the image width / height and face detector mode.
                        detector = new affdex.CameraDetector(divRoot, width, height, faceMode);

                        //Enable detection of all Expressions, Emotions and Emojis classifiers.
                        detector.detectAllEmotions();
                        detector.detectAllExpressions();
                        detector.detectAllEmojis();
                        detector.detectAllAppearance();

                        //Add a callback to notify when the detector is initialized and ready for runing.
                        detector.addEventListener("onInitializeSuccess", function () {
                            log('#logs', "The detector reports initialized");
                            //Display canvas instead of video feed because we want to draw the feature points on it
                            $("#face_video_canvas").css("display", "block");
                            $("#face_video").css("display", "none");
                        });

                        //Add a callback to notify when camera access is allowed
                        detector.addEventListener("onWebcamConnectSuccess", function () {
                            log('#logs', "Webcam access allowed");
                        });

                        //Add a callback to notify when camera access is denied
                        detector.addEventListener("onWebcamConnectFailure", function () {
                            log('#logs', "webcam denied");
                            console.log("Webcam access denied");
                            console.log(detector)
                            // detector = new affdex.CameraDetector(divRoot, width, height, faceMode);
                        });

                        //Add a callback to notify when detector is stopped
                        detector.addEventListener("onStopSuccess", function () {
                            log('#logs', "The detector reports stopped");
                            $("#results").html("");
                        });

                        //Add a callback to receive the results from processing an image.
                        //The faces object contains the list of the faces detected in an image.
                        //Faces object contains probabilities for all the different expressions, emotions and appearance metrics
                        detector.addEventListener("onImageResultsSuccess", function (faces, image, timestamp) {
                            $('#results').html("");
                            log('#results', "Timestamp: " + timestamp.toFixed(2));
                            log('#results', "Number of faces found: " + faces.length);
                            if (faces.length > 0) {
                                let face = {
                                    ...(faces[0].expressions),
                                    ...(faces[0].emotions)
                                }
                                faceParams.push(face);
                                log('#results', "Appearance: " + JSON.stringify(faces[0].appearance));
                                log('#results', "Emotions: " + JSON.stringify(faces[0].emotions, function (key, val) {
                                    return val.toFixed ? Number(val.toFixed(0)) : val;
                                }));
                                log('#results', "Expressions: " + JSON.stringify(faces[0].expressions, function (key, val) {
                                    return val.toFixed ? Number(val.toFixed(0)) : val;
                                }));
                                log('#results', "Emoji: " + faces[0].emojis.dominantEmoji);
                                drawFeaturePoints(image, faces[0].featurePoints);
                            }
                        });

                        //Draw the detected facial feature points on the image
                        function drawFeaturePoints(img, featurePoints) {
                            var contxt = $('#face_video_canvas')[0].getContext('2d');

                            var hRatio = contxt.canvas.width / img.width;
                            var vRatio = contxt.canvas.height / img.height;
                            var ratio = Math.min(hRatio, vRatio);

                            contxt.strokeStyle = "#FFFFFF";
                            for (var id in featurePoints) {
                                contxt.beginPath();
                                contxt.arc(featurePoints[id].x,
                                    featurePoints[id].y, 2, 0, 2 * Math.PI);
                                contxt.stroke();

                            }
                        }

                    });

                    function log(node_name, msg) {
                        $(node_name).append("<span>" + msg + "</span><br />")
                    }

                    //function executes when Start button is pushed.
                    function onStart() {
                        this.startTakingPhotos();
                        if (detector && !detector.isRunning) {
                            $("#logs").html("");
                            detector.start();
                        }
                        // log('#logs', "Clicked the start button");
                    }

                    //function executes when the Stop button is pushed.
                    function onStop() {
                        // log('#logs', "Clicked the stop button");
                        if (detector && detector.isRunning) {
                            detector.removeEventListener();
                            detector.stop();
                            // $.post('http://localhost:5000/api/v1/regression',
                            //     {
                            //         faceParams: faceParams
                            //     },
                            //     function (data, status) {
                            //         alert("Data: " + data + "\nStatus: " + status);
                            //     });
                            let request = $.ajax({
                                url: 'https://6761cc95f658.ngrok.io/api/v1/regression',
                                type: 'POST',
                                data: JSON.stringify({
                                    faceParams: faceParams
                                }),
                                contentType: 'application/json; charset=utf-8',
                                success: function (data) {
                                    console.log(data);
                                    // alert(JSON.stringify(data))
                                    
                                    // $('#score').html(data.mean)
                                    faceDetection = Math.round(data.mean * 10);
                                    faceProb = Math.round(data.probability * 100)
                                },
                            })

                            // promises.push(request);
                        }
                    }

                    //function executes when the Reset button is pushed.
                    function onReset() {
                        log('#logs', "Clicked the reset button");
                        if (detector && detector.isRunning) {
                            detector.reset();

                            $('#results').html("");
                        }
                    }
                    $('a.play-video').click(function () {
                        // alert("Privacy issue");
                        $('.youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'playVideo' + '","args":""}', '*');
                    });

                    $('a.stop-video').click(function () {
                        $('.youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
                    });

                    $('a.pause-video').click(function () {
                        $('.youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
                    });










                    // The width and height of the captured photo. We will set the
                    // width to the value defined here, but the height will be
                    // calculated based on the aspect ratio of the input stream.

                    var width = 320;    // We will scale the photo width to this
                    var height = 0;     // This will be computed based on the input stream

                    // |streaming| indicates whether or not we're currently streaming
                    // video from the camera. Obviously, we start at false.

                    var streaming = false;

                    // The various HTML elements we need to configure or control. These
                    // will be set by the startup() function.

                    var video = null;
                    var canvas = null;
                    var photo = null;
                    var startbutton = null;
                    var images = []
                    function startup() {
                        video = document.getElementById('video');
                        canvas = document.getElementById('canvas');
                        photo = document.getElementById('photo');
                        startbutton = document.getElementById('startbutton');
                        endButton = document.getElementById('endCapturing');

                        navigator.mediaDevices.getUserMedia({video: true, audio: false})
                            .then(function(stream) {
                                video.srcObject = stream;
                                video.play();
                            })
                            .catch(function(err) {
                                console.log("An error occurred: " + err);
                            });

                        video.addEventListener('canplay', function(ev){
                            if (!streaming) {
                                height = video.videoHeight / (video.videoWidth/width);

                                // Firefox currently has a bug where the height can't be read from
                                // the video, so we will make assumptions if this happens.

                                if (isNaN(height)) {
                                    height = width / (4/3);
                                }

                                video.setAttribute('width', width);
                                video.setAttribute('height', height);
                                canvas.setAttribute('width', width);
                                canvas.setAttribute('height', height);
                                streaming = true;
                            }
                        }, false);

                        startbutton.addEventListener('click', function(ev){
                            startTakingPhotos();
                            ev.preventDefault();
                        }, false);
                        endButton.addEventListener('click', (ev) => {
                            stopAndSubmit();
                            ev.preventDefault()
                        }, false)
                        clearphoto();
                    }

                    // Fill the photo with an indication that none has been
                    // captured.

                    function clearphoto() {
                        var context = canvas.getContext('2d');
                        context.fillStyle = "#AAA";
                        context.fillRect(0, 0, canvas.width, canvas.height);

                        var data = canvas.toDataURL('image/png');
                        photo.setAttribute('src', data);
                    }

                    function stopAndSubmit(){
                        clearInterval(capture);
                        let request = $.ajax({
                            url: 'https://6761cc95f658.ngrok.io/api/v1/bodyLang',
                            type: 'POST',
                            data: JSON.stringify({
                                images: images
                            }),
                            contentType: 'application/json; charset=utf-8',
                            success: function (data) {
                                // console.log('came here')
                                console.log(data);
                                // alert(JSON.stringify(data))
                                
                                bodyLang = Math.round(data.status * 10);
                                // this.clearphoto();
                                // $('#score').html(data.mean)
                            },
                        })
                        // promises.push(request);
                    }

                    // Capture a photo by fetching the current contents of the video
                    // and drawing it into a canvas, then converting that to a PNG
                    // format data URL. By drawing it on an offscreen canvas and then
                    // drawing that to the screen, we can change its size and/or apply
                    // other changes before drawing it.
                    var capture = null;
                    function startTakingPhotos(){
                        capture = setInterval(() => {
                            takepicture()
                        }, 1000)
                    }
                    function takepicture() {
                        var context = canvas.getContext('2d');
                        if (width && height) {
                            canvas.width = width;
                            canvas.height = height;
                            context.drawImage(video, 0, 0, width, height);

                            var data = canvas.toDataURL('image/png');
                            images.push(data)
                            // console.log(data);
                            photo.setAttribute('src', data);
                        } else {
                            clearphoto();
                        }
                    }

                    // Set up our event listener to run the startup process
                    // once loading is complete.
                    window.addEventListener('load', startup, false);
                </script>

@endsection
{{-- </div>


</body>
</h4> --}}
