<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid blue;
  padding: 8px;
}



#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #000;
  color: yellow;
  font-size:20px;
} 

.TableRow{
 color: #000;
 background-color:yellow;
 font-weight:bold;
}
.TableCol{
font-weight:bold;
}
</style>
</head>
<body>

<img src={{$domain.'/public/images/logo1.png'}} /> <h4 style={{"color:blue"}}>HoMEds</h4></img>


<h3>Dear {{$name}}</h3>

<h4>Thank you for registering With {{$plan_name}} plan with YHWH Corporation.  This email will help you get started with using your Account. </h4>


<h4 style={{"color:blue"}}>To activate your account, please click on the following url:
{{$link}} </h4>



<h3 tyle={{"color:blue"}}>Your {{$plan_name}} Package details </h3>

<h4>Plan: {{$benefits}}
</h4>
<h4>Login URL:  <a href={$domain."/public/login"} >{{$domain.'/public/login'}}</a>
</h4>
<h4>Username: {{$email}}
</h4>
<h4>Plan Type: {{$benefits_plan}}
</h4>
<h4>Plan Expiry Date :   {{$expire_date}}
</h4>

<h2>The HoMEds Team</h2>
<h2>Email: register@homeds.in</h2>
</body>
</html>


