<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liên hệ</title>
</head>

<body>
    <h4>Thư liên hệ từ người xem:</h4>
    <p>Họ và Tên: {{ $data['name'] ?? '' }} </p>
    <p>Email: {{ $data['email'] ?? '' }}</p>
    <p>Số điện thoại: {{ $data['phone'] ?? '' }}</p>
    <div>Nội dung:<br />
        {{ $data['message'] ?? ''}}
    </div>
</body>

</html>
