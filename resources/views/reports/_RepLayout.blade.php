<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ public_path('/template/dist/css/adminlte.min.css') }}"> --}}
    <title>Report</title>
    <style>
        #myTable {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        #myTable td, #myTable th {
          border: 1px solid #ddd;
          padding: 8px;
        }
        
        #myTable tr:nth-child(even){background-color: #f2f2f2;}
        
        #myTable tr:hover {background-color: #ddd;}
        
        #myTable th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #444461;
          color: white;
        }

        #myTable mt {
            margin-top: 1px;
        }

        #myTable mb {
            padding-bottom: 1px;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>