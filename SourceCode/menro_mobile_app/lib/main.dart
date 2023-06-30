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
      // routes: {
      //   '/secondPage': (context) => SecondPage(), // Add the route for the second page
      // },
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



