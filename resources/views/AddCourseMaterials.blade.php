{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/custom.css">
</head>
<body>
        <div class="container"> --}}
@extends('AHome')
@section('Content')
    <h2>Add Course Materials form</h2>
    {{-- <form class="form-horizontal" action="{{URL::to('/store')}}" enctype="multipart/form-data" method="Post"> --}}
    @csrf
    <div class="form-group">
        <label class="control-label col-sm-2" for="Pnum">Select Course Name</label>
        <div class="col-sm-10">

            <select name="C_ID" class="form-control inputstl">
                @foreach ($courses as $courses )
                    <option value="{{$courses->C_ID}}">{{$courses->Name}}</option>
                @endforeach
            </select>
        </div>
    </div>



    <div class="form-group">
        <label class="control-label col-sm-2" for="Pnum">Select Week</label>
        <div class="col-sm-10">
            <select class="form-control selcls" name="Week">
                <option value="Week1">Week1</option>
                <option value="Week2">Week2</option>
                <option value="Week3">Week3</option>
                <option value="Week4">Week4</option>
            </select>
        </div>
    </div>
    <div class="form-group">

        {{-- <div class="col-sm-10">
          <input type="file"  class="inputfile" id="file"  name="pdf">
        </div>
        <label for="pdf">Choose a file</label> --}}

        <label class="btn btn-info col-sm-2 btn-file">
            Select the file here <input type="file" hidden id="file" name="pdf">
        </label>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button onclick="submit11()" class="btn btn-primary">Submit</button>
            <button onclick="onStartt()" class="btn btn-primary">Yes/No Questions</button>
            <button onclick="onGapFill()" class="btn btn-primary">Gap fill questions</button>
            <button onclick="onWhQuestions()" class="btn btn-primary">WH questions</button>
            <h2 id="score"></h2>
        </div>
    </div>
    </form>

    <div>
        <ul id="question">

        </ul>
    </div>


@endsection
@section('scripts')
    <script>
        var reArrangeArryaList = []

        function onStartt() {
            let currentIndex = reArrangeArryaList.length;
            questionsAll = []
            $.ajax({
                url: 'http://localhost:5000/binary',
                type: 'GET',
                contentType: 'application/json; charset=utf-8',
                success: function (data) {
                    console.log(data);
                    questionsAll = data


                    questionsAll.forEach(function (value) {
                        let q = {
                            'question': value.question,
                            'answer': value.answer,
                            'type': 1,
                        }
                        reArrangeArryaList.push(q);
                    })

                    console.log(reArrangeArryaList)
                    $(document).ready(function () {
                        var list = '';
                        list += '<h2>Binary Questions</h2>'
                        for (i = currentIndex; i < reArrangeArryaList.length; i++) {
                            // list += "<li>" + data[i].question + "</li>";
                            list += '<input type="checkbox" name="que" value="' + i + '" ><input hidden type="text" name="type" value="1" ><label>' + reArrangeArryaList[i].question + '</label><span> Answer is : ' + reArrangeArryaList[i].answer + '</span><br><br>';
                        }
                        $("#question").append(list);
                    });
                },
            });
        }

        function onGapFill() {
            questionsAll = []
            let currentIndex = reArrangeArryaList.length;
            $.ajax({
                url: 'http://localhost:5000',
                type: 'GET',
                contentType: 'application/json; charset=utf-8',
                success: function (data) {
                    //    console.log(data);
                    questionsAll = data

                    data.forEach(function (value) {
                        let q = {
                            'question': value.question,
                            'answer': value.answer,
                            'type': 2,
                        }
                        reArrangeArryaList.push(q);
                    })
                    //  alert(JSON.stringify(data))
                    //   $('#question').html(data[0].question);
                    $(document).ready(function () {
                        var list = '';
                        list += '<br><h2>Gap Filling Questions</h2>'
                        for (i = currentIndex; i < reArrangeArryaList.length; i++) {
                            // list += "<li>" + data[i].question + "</li>";
                            list += '<input type="checkbox" name="que" value="' + i + '" ><label>' + reArrangeArryaList[i].question + '</label><span> Answer is : ' + reArrangeArryaList[i].answer + '</span><br><br>';
                        }
                        $("#question").append(list);
                    });
                },
            });
        }

        function onWhQuestions() {
            questionsAll = []
            let currentIndex = reArrangeArryaList.length;
            $.ajax({
                url: '//3.131.76.24:8000/questions',
                type: 'POST',
                contentType: 'application/json; charset=utf-8',
                data: JSON.stringify({
                    "document": ["Software engineering is a branch of computer science which includes the development and building of computer systems software and applications software. Computer systems software is composed of programs that include computing utilities and operations systems. Applications software consists of User focused programs that include web browsers, database programs."]
                }),
                success: function (data) {
                    console.log('data');
                    console.log(data);
                    questionsAll = data

                    data.forEach(function (value) {
                        if (value.questions && value.answer) {
                            value.questions.forEach(function (value2) {
                                let q = {
                                    'question': value2,
                                    'answer': value.answer,
                                    'type': 3,
                                }
                                reArrangeArryaList.push(q);
                            })
                        }

                    })
                    //  alert(JSON.stringify(data))
                    //   $('#question').html(data[0].question);
                    $(document).ready(function () {
                        var list = '';
                        list += '<br><h2>WH Questions</h2>'
                        for (i = currentIndex; i < reArrangeArryaList.length; i++) {
                            // list += "<li>" + data[i].question + "</li>";
                            list += '<input type="checkbox" name="que" value="' + i + '" ><label>' + reArrangeArryaList[i].question + '</label><span> Answer is : ' + reArrangeArryaList[i].answer + '</span><br><br>';
                        }
                        $("#question").append(list);
                    });
                },
            });
        }

        function submit11() {
            var questions = [];
            var questionsSelected = [];
            $.each($("input[name='que']:checked"), function () {
                questions.push($(this).val());
            });

            questions.forEach(function (element) {
                questionsSelected.push(reArrangeArryaList[element])
            })
            console.log(JSON.stringify(questionsSelected))
            let val = JSON.stringify(questionsSelected);
            $.ajax({
                url: '/api/v1/save/data',
                type: 'POST',
                contentType: 'application/json',
                data: val,
                success: function (data) {
                    console.log(data);
                    location.reload();
                    //    appIndex
                    // questionsAll = data
                    // //  alert(JSON.stringify(data))
                    // //   $('#question').html(data[0].question);
                    // $(document).ready(function () {
                    //     var list = ''
                    //     for (i = 0; i < data.length; i++) {
                    //         // list += "<li>" + data[i].question + "</li>";
                    //         list += '<input type="checkbox" name="que" value="' + i + '" ><label>' + data[i].question + '<label><br>';
                    //     }
                    //     $("#question").append(list);
                    // });
                },
            });
        }

        function getAnswersScore(marking_answer, matching_answer) {
            $.ajax({
                url: 'http://localhost:8001/answers',
                type: 'post',
                data: JSON.stringify({marking_answer: marking_answer, student_answer: matching_answer}),
                dataType: "json",
                contentType: 'application/json',
                success: function (data) {
                    console.log(data);
                    alert(JSON.stringify(data))
                    console.log(JSON.stringify(data))
                },
            })
        }

    </script>
