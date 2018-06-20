<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title></title>
    <!-- <style> -->
</head>
<body>
    <p>Richiesta da: {{ $data['name'] }}</p>
    <p>Telefono: {{ $data['phone'] }}</p>
    <p>Email: {{ $data['email'] }}</p>
    <p>Soggetto: {{ $data['subject'] }}</p>
    <p>Messaggio:</p>
    <p></p>{{ $data['message'] }}</p>
</body>
</html>