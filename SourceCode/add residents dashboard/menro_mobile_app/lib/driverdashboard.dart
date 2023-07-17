import 'package:flutter/material.dart';
import 'main.dart';// Import the SecondPage() widget

class DriverDashboard extends StatefulWidget {
  @override
  _DriverDashboardState createState() => _DriverDashboardState();
}

class _DriverDashboardState extends State<DriverDashboard> {
  String currentWeather = 'Fetching...';
  String driverName = 'MENRO DRIVER';

  @override
  void initState() {
    super.initState();
    fetchWeatherData(); // Fetch weather data when the widget initializes
  }

  void fetchWeatherData() {
    // Use weather API to fetch current weather based on driver's location
    // Update the value of currentWeather with the fetched data

    // Example: Mocked weather data
    Future.delayed(Duration(seconds: 2), () {
      setState(() {
        currentWeather = 'Sunny'; // Replace with the fetched weather data
      });
    });
  }

  void logout() {
    // Perform logout logic here
    // Example: Clear user session and navigate to the SecondPage()
    Navigator.pushReplacement(
      context,
      MaterialPageRoute(builder: (context) => SecondPage()),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.green,
        title: Text('Driver Dashboard'),
      ),
      drawer: Drawer(
        child: ListView(
          padding: EdgeInsets.zero,
          children: [
            DrawerHeader(
              decoration: BoxDecoration(
                color: Colors.green,
              ),
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  CircleAvatar(
                    radius: 50,
                    backgroundColor: Colors.green,
                    backgroundImage: AssetImage('image/logo.png'), // Add your profile image path here
                  ),
                  SizedBox(height: 8),
                  Text(
                    '$driverName',
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 24,
                    ),
                  ),
                ],
              ),
            ),
            ListTile(
              leading: Icon(Icons.home),
              title: Text('Home'),
              onTap: () {
                // Add functionality to navigate to home
              },
            ),
            ListTile(
              leading: Icon(Icons.settings),
              title: Text('Settings'),
              onTap: () {
                // Add functionality to navigate to settings
              },
            ),
            ListTile(
              leading: Icon(Icons.person),
              title: Text('Profile'),
              onTap: () {
                // Add functionality to navigate to profile
              },
            ),
            ListTile(
              leading: Icon(Icons.logout),
              title: Text('Logout'),
              onTap: logout, // Call the logout function when the "Logout" ListTile is tapped
            ),
          ],
        ),
      ),
      body: Container(
        padding: EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              'Welcome, $driverName',
              style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
            ),
            SizedBox(height: 20),
            Container(
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(12.0),
              ),
              padding: EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    'Gas Consumption',
                    style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
                  ),
                  Card(
                    elevation: 3,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(12.0),
                    ),
                    child: ListTile(
                      leading: Icon(Icons.local_gas_station),
                      title: Text('Total Gas Consumption'),
                      subtitle: Text('45 gallons'),
                    ),
                  ),
                ],
              ),
            ),
            SizedBox(height: 20),
            Container(
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(12.0),
              ),
              padding: EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    'Schedule',
                    style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
                  ),
                  Card(
                    elevation: 3,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(12.0),
                    ),
                    child: ListTile(
                      leading: Icon(Icons.calendar_today),
                      title: Text('Next Pickup'),
                      subtitle: Text('Monday, July 19, 2023'),
                    ),
                  ),
                ],
              ),
            ),
            SizedBox(height: 20),
            Container(
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(12.0),
              ),
              padding: EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    'Location',
                    style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
                  ),
                  Card(
                    elevation: 3,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(12.0),
                    ),
                    child: ListTile(
                      leading: Icon(Icons.location_on),
                      title: Text('Current Location'),
                      subtitle: Text('123 Main Street, City, State'),
                    ),
                  ),
                ],
              ),
            ),
            SizedBox(height: 20),
            Container(
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(12.0),
              ),
              padding: EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    'Weather Condition',
                    style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
                  ),
                  Card(
                    elevation: 3,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(12.0),
                    ),
                    child: ListTile(
                      leading: Icon(Icons.cloud),
                      title: Text('Current Weather'),
                      subtitle: Text(currentWeather),
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
