<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Mail</title>
</head>
<body>
    <h1>Title: {{ $details['title']}}</h1>
    <p>Client Name: {{$details['firstname']}}, {{$details['lastname']}}</p>
    <p>Email Address: {{$details['email_address']}}</p>
    <p>Bus Name: {{$details['bus_name']}}</p>
    <p>Start Date: {{$details['start_date']}}</p>
    <p>End Date: {{$details['end_date']}}</p>
    <p>Price: {{$details['price']}}</p>
    <p>Payment: {{$details['payment']}}</p>
    <p>Status: {{$details['status']}}</p>

    <p>Thank You!!</p>
</body>
</html>