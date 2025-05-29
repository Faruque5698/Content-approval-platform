<!DOCTYPE html>
<html>
<head>
    <title>Post Status Update</title>
</head>
<body style="margin:0; padding:20px; background:#f4f4f4; font-family: Arial, sans-serif;">
<table role="presentation" style="max-width:600px; margin: 0 auto; background:#fff; border-radius:8px; padding:20px; border:1px solid #ddd; text-align: center;">
    <tr>
        <td>
            <h1 style="margin-top:0; color:#333;">Hello {{ $user->name }},</h1>

            <p style="font-size:16px; color:#555;">
                Your post titled <strong>"{{ $post->title }}"</strong> has been <strong>{{ ucfirst($post->status) }}</strong>.
            </p>

            <p>
                <a href="{{ url('/posts/' . $post->id) }}"
                   style="background:#3490dc; color:#fff; padding:10px 15px; text-decoration:none; border-radius:5px; font-weight:bold;">
                    View Post
                </a>
            </p>

            <p style="color:#777; font-size:14px;">
                Thanks,<br>{{ config('app.name') }}
            </p>
        </td>
    </tr>
</table>
</body>
</html>
