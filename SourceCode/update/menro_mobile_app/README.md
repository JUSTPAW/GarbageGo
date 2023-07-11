import 'package:flutter/material.dart';

void main() {
runApp(StatelessApp());
}

class StatelessApp extends StatelessWidget {
@override
Widget build(BuildContext context) {
return MaterialApp(
debugShowCheckedModeBanner: false,
home: MyStatelessWidget(),
routes: {
'/secondPage': (context) => SecondPage(), // Add the route for the second page
},
);
}
}

class MyStatelessWidget extends StatelessWidget {
void handleClick(BuildContext context) {
Navigator.pushNamed(context, '/secondPage'); // Navigate to the second page
}

@override
Widget build(BuildContext context) {
return Scaffold(
backgroundColor: Colors.green[700],
body: Center(
child: Column(
mainAxisAlignment: MainAxisAlignment.center,
children: <Widget>[
Image.asset(
'image/logo.png', // Update with the correct image path
width: 200,
height: 200,
),
SizedBox(height: 10.0), // Add some spacing between the image and the button
ElevatedButton(
onPressed: () => handleClick(context), // Pass the current context to the handleClick function
child: Text('Start'),
style: ElevatedButton.styleFrom(
primary: Colors.green, // Set the button color to green
),
),
],
),
),
);
}
}

class SecondPage extends StatelessWidget {
String selectedRole = ''; // Variable to store the selected role

@override
Widget build(BuildContext context) {
return Scaffold(
backgroundColor: Colors.green,
appBar: AppBar(
backgroundColor: Colors.green,
flexibleSpace: Row(
mainAxisAlignment: MainAxisAlignment.spaceAround,
children: [
Align(
alignment: Alignment.bottomLeft,
),
],
),
),
body: Padding(
padding: EdgeInsets.all(16.0),
child: Column(
crossAxisAlignment: CrossAxisAlignment.center,
children: <Widget>[
SizedBox(height: 70.0),
Image.asset(
'image/logo.png', // Update with the correct image path
width: 200,
height: 200,
), // Add some spacing between the image and the form fields
Container(
padding: EdgeInsets.all(30.0),
decoration: BoxDecoration(
color: Colors.white,
borderRadius: BorderRadius.circular(8.0),
),
child: Column(
children: [
Container(
decoration: BoxDecoration(
border: Border.all(
color: Colors.grey,
width: 1.0,
),
borderRadius: BorderRadius.circular(4.0),
),
child: ListTile(
title: const Text('Resident'),
leading: CircleAvatar(
backgroundImage: AssetImage('image/logo.png'), // Update with the correct image path for residents
),
),
),
SizedBox(height: 10.0),
Container(
decoration: BoxDecoration(
border: Border.all(
color: Colors.grey,
width: 1.0,
),
borderRadius: BorderRadius.circular(4.0),
),
child: ListTile(
title: const Text('Driver'),
leading: CircleAvatar(
backgroundImage: AssetImage('image/logo.png'), // Update with the correct image path for drivers
),
),
),
],
),
),
],
),
),
);
}
}


