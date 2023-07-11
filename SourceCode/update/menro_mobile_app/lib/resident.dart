import 'package:flutter/material.dart';
import 'package:menro_mobile_app/resident.dart';

class ResidentPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.green,
      appBar: AppBar(
        backgroundColor: Colors.green,
        title: Text('Resident Page'),
      ),
      body: Center(
        child: Text(
          'This is the Resident Page',
          style: TextStyle(color: Colors.white, fontSize: 24),
        ),
      ),
    );
  }
}