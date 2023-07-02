<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Get Value from Textarea in jQuery</title>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
    $(document).ready(function(){
        $("button").click(function(){
            alert("Success");
            $("textarea").select();
            document.execCommand('copy');
        });
        
    });
</script>
</head>
<body>
    <textarea id="comment" rows="5" cols="50"></textarea>
    <p><button type="button">Get Value</button></p>
    <p><strong>Note:</strong> Type something in the textarea and click the button to see the result.</p>
</body>
</html>    -->

<!-- <!DOCTYPE html>
<html>
<head>
<style>
.grey{
background-color:grey;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<input id="item_price" class="grey" value="100.00" disabled="disabled" />
<br>
<br>
<input type="button" id="Button" value="disable/enable" />
<script>
$(document).ready(function(){
$("#Button").click(function() {
$("#item_price").attr('disabled', !$("#item_price").attr('disabled'));
$("#item_price").removeClass("grey");
});
});
</script>
</body>
</html>
         -->



<!-- <!Doctype html>
<html>
<body>
    <head>
        <style>
            #frmCheckPassword {
                border-top: #F0F0F0 2px solid;
                background: #808080;
                padding: 10px;
            }

            .demoInputBox {
                padding: 7px;
                border: #F0F0F0 1px solid;
                border-radius: 4px;
            }

            #password-strength-status {
                padding: 5px 10px;
                color: #FFFFFF;
                border-radius: 4px;
                margin-top: 5px;
            }

            .medium-password {
                background-color: #b7d60a;
                border: #BBB418 1px solid;
            }

            .weak-password {
                background-color: #ce1d14;
                border: #AA4502 1px solid;
            }

            .strong-password {
                background-color: #12CC1A;
                border: #0FA015 1px solid;
            }
        </style>
    </head>
    <div name="frmCheckPassword" id="frmCheckPassword">
        <label>Password:</label>
        <input type="password" name="password" id="password" class="demoInputBox" onKeyUp="checkPasswordStrength();" />
        <div id="password-strength-status"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function checkPasswordStrength() {
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            if ($('#password').val().length < 6) {
                $('#password-strength-status').removeClass();
                $('#password-strength-status').addClass('weak-password');
                $('#password-strength-status').html("Weak (should be atleast 6 characters.)");
            } else {
                if ($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters)) {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('strong-password');
                    $('#password-strength-status').html("Strong");
                } else {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('medium-password');
                    $('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
                }
            }
        }
    </script>
</body>
</html> -->


