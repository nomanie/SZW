<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Print Table</title>
        <meta charset="UTF-8">
        <meta name=description content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <style>
            body {margin: 20px}
        </style>
    </head>
    <body class="w-100">
            <div class="container w-100">
            @foreach($data as $row)
                @if ($loop->first)
                    <div class="row" style="background-color: #1a202c; color:white;">
                        @foreach($row as $key => $value)
                            <div class="col" style="font-size:18px;">{!! $key !!}</div>
                        @endforeach
                    </div>
                @endif
                <div class="row">
                    @foreach($row as $key => $value)
                        @if(is_string($value) || is_numeric($value))
                            <div class="col" style="text-align: center">{!! $value !!}</div>
                        @else
                            <div class="col"></div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </body>
</html>
