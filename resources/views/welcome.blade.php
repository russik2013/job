<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>

    </head>
    <body>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="{{asset('comparisonText/js/index.js')}}"></script>


    <button onclick="sendText()">Text Input</button>
    <button onclick="uploadFile()">File Upload</button>
    <button onclick="getURLs()">URLs</button>
    <div id="input">
        <form method="post" action="javascript:void(null);" onsubmit="doMagic()" id="formText">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <p>
                <textarea rows="10" cols="45" name="text"></textarea>
                <textarea rows="10" cols="45" name="text2"></textarea>
            </p>
            <input name="submit" class="button" type="submit" value="Отправить" />
        </form>
    </div>
    <div id="upload">
        <form method="post" action="{{ url('/chekFile') }}" onsubmit="doMagic()" id="formFile" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
             <p>
                 <label for="img" class="control-label col-md-2 ">Загрузка файлов</label>
                 <input type="file" name="img" id="img">
                 <input type="file" name="img2" id="img2">
             </p>
            <input name="submit" class="button" type="submit" value="Отправить" />
        </form>
    </div>
    <div id="urls">
        <form method="post" action="javascript:void(null);" onsubmit="doMagic()" id="formURLs">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">

            <p>
                <p> <input type="text"></p>
                <p> <input type="text"></p>
            </p>
            <input name="submit" class="button" type="submit" value="Отправить" />
        </form>
    </div>

    <div id="answer">

        @if(isset($answer))

            {{dd($answer)}}
        @endif
    </div>

    <script>

        function doMagic() {
            if ($( "#input" ).is(':visible')) {
                var msg   = $('#formText').serialize();
                $.ajax({
                    type: 'POST',
                    url: '{{ url('/chekText') }}',
                    data: msg,
                    success: function(data) {
                        $('#answer').text(data);

                        console.log(data);
                    },
                    error:  function(xhr, str){
                        console.log('Не успех');
                        //  alert('Возникла ошибка: ' + xhr.responseCode);
                    }
                });
              //  console.log('input viden');
            }
            if ($( "#upload" ).is(':visible')) {
                var file   = $('#formFile').serialize();
                $.ajax({
                    type: 'POST',
                    url: '{{ url('/chekFile') }}',
                    data: file,
                    success: function(data) {
                      //  $('#answer').text(data);

                     //   console.log(data);
                    },
                    error:  function(xhr, str){
                        console.log('Не успех');
                        //  alert('Возникла ошибка: ' + xhr.responseCode);
                    }
                });
                console.log('upload viden');
            }
            if ($( "#urls" ).is(':visible')) {
                console.log('urls viden');
            }

        }


    </script>
    </body>
</html>
