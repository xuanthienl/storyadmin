
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
    
</head>
<body>
    <h3>Hello {{ $username }} ! The account has been successfully updated.</h3>
    <p>- Your username is: {{ $username }}</p>
    <p>- Your email is: {{ $email }}</p>
    <p>- Your password is: {{ $password }}</p>
    <p>- Your email old: 
        @if($email == $mail) {!! "<i>" . 'Chưa thay đổi.' . "</i>" !!}
        @else {{ $mail }}
        @endif
    </p>
    <b><i>Thank you !</i></b>
</body>
</html>