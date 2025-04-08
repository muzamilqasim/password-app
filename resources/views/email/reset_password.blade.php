<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $formData['subject'] }}</title>
</head>
<body style="font-family: Arial, Halvetica, sans-serif; font-size:16px;">
   <div style="min-width:1000px;overflow:auto;">
  <div style="margin:50px auto;width:70%;">
    <div style="border-bottom:1px solid #eee">
      <a href="#" style="font-size:1.4em;color: goldenrod;text-decoration:none;font-weight:600">{{ $formData['site_title'] }}</a>
    </div>
    <p style="font-size:1.1em">Hi,</p>
    <a href="#" style="background: goldenrod;font-size:1.4em;color: #000;padding: 5px;border: 1px solid goldenrod; border-radius: 5px;text-decoration:none;font-weight:600">{{ $formData['code'] }}</a>
  </div>
</div>
</body>
</html>