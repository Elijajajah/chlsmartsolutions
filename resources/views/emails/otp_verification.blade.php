<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px;">
        <h2 style="color: #5AA526;">OTP Verification</h2>
        <p>Hi,</p>
        <p>Thank you for signing up! Please use the OTP below to verify your email address:</p>

        <div style="text-align: center; margin: 20px 0;">
            <span style="font-size: 24px; font-weight: bold; letter-spacing: 4px; color: #5AA526;">
                {{ $otp }}
            </span>
        </div>

        <p>This OTP is valid for the next 3 minutes. Do not share it with anyone.</p>

        <p>Regards,<br>CHL SmartSolutions</p>
    </div>
</body>

</html>
