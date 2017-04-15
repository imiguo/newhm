Someone from IP {{ $ip }} has entered a password for your account "{{ $username }}" incorrectly {{ $max_tries }} times. System locked your accout until you activate it.

Click here to activate your account :

{{ $site_url }}?a=activate&code={{ $activation_code }}

Thank you.
{{ $site_name }}
