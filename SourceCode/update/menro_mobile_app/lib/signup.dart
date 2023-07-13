import 'package:flutter/material.dart';
import 'package:menro_mobile_app/driver.dart';

class SignUpPage extends StatefulWidget {
  const SignUpPage({Key? key}) : super(key: key);

  @override
  State<SignUpPage> createState() => _SignUpPageState();
}

class _SignUpPageState extends State<SignUpPage> {
  bool hide = true;
  bool rememberMe = false;
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: false,
      backgroundColor: Colors.green,
      body: Stack(
        children: [
          Container(
            margin: EdgeInsets.only(top: MediaQuery.of(context).size.height * 0.15),
            padding: EdgeInsets.symmetric(horizontal: 20.0, vertical: 2.0),
            height: 650.0,
            width: double.infinity,
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.only(
                topLeft: Radius.circular(20.0),
                bottomLeft: Radius.circular(20.0),
                topRight: Radius.circular(20.0),
                bottomRight: Radius.circular(20.0),
              ),
            ),
            child: Column(
              children: [
                AppBar(
                  backgroundColor: Colors.transparent,
                  elevation: 0,
                  leading: Center(
                    child: Image.asset(
                      'image/logo.png',
                      width: 50.0,
                      height: 50.0,
                    ),
                  ),
                  title: Container(
                    alignment: Alignment.center,
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: [
                        Text(
                          'MENRO Lian Employee',
                          style: TextStyle(
                            fontSize: 20.0,
                            color: Colors.black54,
                            fontWeight: FontWeight.w400,
                          ),
                        ),
                        Text(
                          'Resgistration',
                          style: TextStyle(
                            fontSize: 20.0,
                            color: Colors.black54,
                            fontWeight: FontWeight.w400,
                          ),
                        ),
                        Text(
                          'Please create your Account',
                          style: TextStyle(
                            fontSize: 14.0,
                            color: Colors.black54,
                            fontWeight: FontWeight.w400,
                          ),
                        ),
                      ],
                    ),
                  ),
                  centerTitle: true,
                ),
                SizedBox(height: 40.0),
                Container(
                  padding: EdgeInsets.symmetric(horizontal: 10.0),
                  child: TextField(
                    obscureText: false,
                    decoration: InputDecoration(
                      hintText: 'First Name',
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(30.0),
                      ),
                    ),
                  ),
                ),
                SizedBox(height: 15.0),
                Container(
                  padding: EdgeInsets.symmetric(horizontal: 10.0),
                  child: TextField(
                    obscureText: false,
                    decoration: InputDecoration(
                      hintText: 'Middle Name',
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(30.0),
                      ),
                    ),
                  ),
                ),
                SizedBox(height: 15.0),
                Container(
                  padding: EdgeInsets.symmetric(horizontal: 10.0),
                  child: TextField(
                    obscureText: false,
                    decoration: InputDecoration(
                      hintText: 'Last Name',
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(30.0),
                      ),
                    ),
                  ),
                ),
                SizedBox(height: 15.0),
                Container(
                  padding: EdgeInsets.symmetric(horizontal: 10.0),
                  child: TextField(
                    obscureText: false,
                    decoration: InputDecoration(
                      hintText: 'Phone Number',
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(30.0),
                      ),
                    ),
                  ),
                ),
                SizedBox(height: 15.0),
                Container(
                  padding: EdgeInsets.symmetric(horizontal: 10.0),
                  child: TextField(
                    obscureText: false,
                    decoration: InputDecoration(
                      hintText: 'Email Address',
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(30.0),
                      ),
                    ),
                  ),
                ),

                Container(
                  width: double.infinity,
                  child: ElevatedButton(
                    style: ElevatedButton.styleFrom(
                      primary: Colors.green,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(30.0),
                      ),
                    ),
                    onPressed: () {
                      Navigator.push(context, MaterialPageRoute(builder: (context) => DriverPage()));
                    },
                    child: Text('Sign Up'),
                  ),
                ),
                SizedBox(height: 10.0),
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Text("Already have an account?"),
                    TextButton(
                      onPressed: () {
                        Navigator.push(context, MaterialPageRoute(builder: (context) => DriverPage()));
                      },
                      child: Text('Login'),
                    ),
                    SizedBox(width: 10.0),
                  ],
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}
