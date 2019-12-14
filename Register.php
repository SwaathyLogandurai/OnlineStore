<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="Assets/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="Assets/LoginRegister.js"></script>


</head>
<body class="reg">
<form name="registerForm" id="regForm" method="post">
<h3>Create Account - Shoppers Shop</h3>
<input type="text" name="uname" id="uname" placeholder="Enter your Name "/>
<input type="password" name="upass" id="upass" placeholder="Enter your Password "/>
<select name="urole" id="urole" onChange="displayStore();">
<option value="Select" >Select your Role</option>
<option value="Admin">Admin</option>
<option value="Customer">Customer</option>
<option value="Seller">Seller</option>
</select>
<input type="text" name="ustore" id="ustore" placeholder="Enter your Store Name " />
<input type="text" name="uloc" id="uloc" placeholder="Enter your Location " />
<input type="email" name="uemail" id="uemail" placeholder="Enter your Email "/>
<input type="tel" name="umobile" id="umobile" placeholder="Enter your Mobile number "/>
<input type="button" value="REGISTER" name="register" id="regbtn"/>
<p class="rmsg"></p>
<p class="loginLink" > <a href="index.php">Click </a> here to Login </p>

</form>
</body>
</html>