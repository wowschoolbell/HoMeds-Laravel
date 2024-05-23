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

<h4>The store account is currently on {{strtolower($status)}}due to the following reason: {{$reason}}</h4>

<h4>If you have any questions or would like to activate your account, please contact our Renewal Team for assistance:</h4>
<h3>The HoMEds Team</h3>
<h3>Email: register@homeds.in</h3>
</body>
</html>


