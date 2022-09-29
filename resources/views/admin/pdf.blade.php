<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Order PDF</title>
</head>
<body>

	<h1>Order Details PDF</h1>

	Customer Name: <h3>{{ $order->name }}</h3>
	Customer Email: <h3>{{ $order->email }}</h3>
	Customer Address: <h3>{{ $order->address }}</h3>
	Customer Id: <h3>{{ $order->user_id }}</h3>
	Product Name: <h3>{{ $order->title }}</h3>
	Product Quantity: <h3>{{ $order->quantity }}</h3>
	Product Price: <h3>{{ $order->price }}</h3>
	Product Payment Status: <h3>{{ $order->payment_status }}</h3>

	<br><br>
	<img width="300" height="200" src="product/{{ $order->image }}">
	
	

</body>
</html>