<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <h1 class="text-center">We are sending mobile sms</h1>
  <div class="container">
      <div class="row">
          <div class="text-center">
                 @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4 style="margin-bottom: 0"> {{Session('success')}}</h4>
                    </div>
                @endif

                <form action="{{ url('sms') }}" method="post">
                    @csrf
                    <input type="text" name="mobile" class="form-control" placeholder="Enter number">
                    <input type="submit" class="btn btn-success" value="Send">
                </form>
                <p>01764908494</p>
          </div>
      </div>
  </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>