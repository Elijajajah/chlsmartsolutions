<div
    style="max-width:600px;margin:auto;background:#ffffff;padding:20px;border-radius:10px;font-family:Arial, sans-serif;">

    <h2 style="color:#5AA526;margin-top:0;">Your Service Request Is Complete!</h2>

    <p style="margin:8px 0;">
        Hi {{ $task->user->name }},
    </p>

    <p style="margin:8px 0;">
        Thank you for choosing <strong>CHL SmartSolutions</strong>.
        We’re pleased to let you know that your service request has been successfully completed.
    </p>

    <p style="margin:6px 0;">
        <strong>Service:</strong> {{ $task->service ? $task->service->service : 'N/A' }}
    </p>

    <p style="margin:6px 0;">
        If you have any additional concerns or questions, feel free to contact us anytime.
    </p>

    <hr style="border:none;border-top:1px solid #CCCCCC;margin:16px 0;">

    <p style="margin:6px 0 0 0;"><strong>Pickup / Contact Information:</strong></p>

    <p style="margin:4px 0 0 0;">
        2nd Flr. Vanessa Olga Building,<br>
        Malusak, Boac,<br>
        Marinduque
    </p>

    <p style="margin:4px 0 0 0;">
        Contact: (+63) 9992264818<br>
        Email: chldisty888@gmail.com
    </p>

    <p style="margin:12px 0 0 0;">
        Thank you!<br>
        <strong>CHL SmartSolutions</strong>
    </p>
</div>
