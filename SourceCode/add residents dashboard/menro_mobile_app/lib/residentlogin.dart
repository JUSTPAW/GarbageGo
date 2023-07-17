import 'package:flutter/material.dart';
import 'package:menro_mobile_app/signup.dart';
import 'package:menro_mobile_app/forgotpassword.dart';
import 'package:menro_mobile_app/residentdashboard.dart';

void main() {
  runApp(MaterialApp(
    debugShowCheckedModeBanner: false,
    home: ResidentPage(),
  ));
}

class ResidentPage extends StatefulWidget {
  @override
  State<ResidentPage> createState() => _LogInState();
}

class _LogInState extends State<ResidentPage> {
  bool hide = true;
  bool rememberMe = false;
  TextEditingController _emailController = TextEditingController();
  TextEditingController _passwordController = TextEditingController();
  String driverName = 'RESIDENT';

  @override
  void dispose() {
    _emailController.dispose();
    _passwordController.dispose();
    super.dispose();
  }

  void signIn() {
    String email = _emailController.text.trim();
    String password = _passwordController.text.trim();

    if (email == 'LIAN RESIDENT' && password == '1234') {
      // Show alert: Login is successful
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: Text('Login Successful'),
            content: Text('Welcome, $driverName'),
            actions: [
              TextButton(
                onPressed: () {
                  Navigator.pop(context);
                  // Navigate to the Driver Dashboard
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => ResidentDashboard()),
                  );
                },
                child: Text('OK'),
              ),
            ],
          );
        },
      );
    } else {
      // Show alert: Wrong email or password
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: Text('Wrong Email or Password'),
            content: Text('Please enter the correct email and password.'),
            actions: [
              TextButton(
                onPressed: () {
                  Navigator.pop(context);
                },
                child: Text('OK'),
              ),
            ],
          );
        },
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: false,
      backgroundColor: Colors.green,
      body: Stack(
        children: [
          Container(
            margin: EdgeInsets.only(top: MediaQuery.of(context).size.height * 0.19),
            padding: EdgeInsets.symmetric(horizontal: 20.0, vertical: 2.0),
            height: 515.0,
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
                          'Welcome Resident',
                          style: TextStyle(
                            fontSize: 25.0,
                            color: Colors.black54,
                            fontWeight: FontWeight.w400,
                          ),
                        ),
                        Text(
                          'Please login to your Account',
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
                    controller: _emailController,
                    obscureText: false,
                    decoration: InputDecoration(
                      hintText: 'E-mail',
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
                    controller: _passwordController,
                    obscureText: hide,
                    decoration: InputDecoration(
                      hintText: 'Password',
                      suffixIcon: IconButton(
                        onPressed: () {
                          setState(() {
                            hide = !hide;
                          });
                        },
                        icon: hide ? Icon(Icons.visibility_off) : Icon(Icons.visibility),
                      ),
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(30.0),
                      ),
                    ),
                  ),
                ),
                Row(
                  children: [
                    Checkbox(
                      value: rememberMe,
                      onChanged: (value) {
                        setState(() {
                          rememberMe = value!;
                        });
                      },
                    ),
                    Text('Remember Me'),
                  ],
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
                    onPressed: signIn,
                    child: Text('Sign In'),
                  ),
                ),
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Text("Don't have an account?"),
                    TextButton(
                      onPressed: () {
                        Navigator.push(context, MaterialPageRoute(builder: (context) => SignUp()));
                      },
                      child: Text('Sign Up'),
                    ),
                  ],
                ),
                TextButton(
                  onPressed: () {
                    Navigator.push(context, MaterialPageRoute(builder: (context) => ForgotPasswordApp()));
                  },
                  child: Text("Forgot Password"),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}
