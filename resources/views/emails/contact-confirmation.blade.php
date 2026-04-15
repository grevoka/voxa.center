<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ __('Contact request confirmation') }}</title>
</head>
<body style="margin:0;padding:0;background-color:#f8fafc;font-family:'Plus Jakarta Sans',Helvetica,Arial,sans-serif;-webkit-font-smoothing:antialiased;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f8fafc;padding:40px 20px;">
  <tr>
    <td align="center">
      <table role="presentation" width="560" cellpadding="0" cellspacing="0" style="max-width:560px;width:100%;">
        {{-- Header --}}
        <tr>
          <td align="center" style="padding-bottom:32px;">
            <table role="presentation" cellpadding="0" cellspacing="0">
              <tr>
                <td style="background-color:#2563eb;width:40px;height:40px;border-radius:10px;text-align:center;vertical-align:middle;">
                  <span style="color:#ffffff;font-size:18px;font-weight:bold;">V</span>
                </td>
                <td style="padding-left:12px;font-size:22px;font-weight:800;color:#1e293b;letter-spacing:-0.03em;">
                  Voxa Center
                </td>
              </tr>
            </table>
          </td>
        </tr>

        {{-- Card --}}
        <tr>
          <td style="background-color:#ffffff;border-radius:16px;border:1px solid #e2e8f0;padding:40px 36px;box-shadow:0 4px 12px rgba(30,41,59,0.04);">
            <h1 style="margin:0 0 8px;font-size:22px;font-weight:800;color:#1e293b;letter-spacing:-0.02em;">{{ __('Request received') }}</h1>
            <p style="margin:0 0 24px;font-size:14px;color:#64748b;line-height:1.5;">{{ __('Hello') }} {{ $client->name }}, {{ __('we have received your contact request. Our team will get back to you shortly.') }}</p>

            {{-- Contact summary --}}
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f8fafc;border-radius:10px;border:1px solid #e2e8f0;margin-bottom:24px;">
              <tr>
                <td style="padding:20px 24px;">
                  <p style="margin:0 0 4px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#64748b;">{{ __('Request summary') }}</p>
                  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-top:12px;">
                    <tr>
                      <td style="padding:6px 0;font-size:13px;font-weight:600;color:#64748b;width:120px;vertical-align:top;">{{ __('Name') }}</td>
                      <td style="padding:6px 0;font-size:14px;color:#0f172a;">{{ $contact->name }}</td>
                    </tr>
                    @if($contact->company)
                    <tr>
                      <td style="padding:6px 0;font-size:13px;font-weight:600;color:#64748b;width:120px;vertical-align:top;">{{ __('Company') }}</td>
                      <td style="padding:6px 0;font-size:14px;color:#0f172a;">{{ $contact->company }}</td>
                    </tr>
                    @endif
                    <tr>
                      <td style="padding:6px 0;font-size:13px;font-weight:600;color:#64748b;width:120px;vertical-align:top;">{{ __('Email') }}</td>
                      <td style="padding:6px 0;font-size:14px;color:#0f172a;">{{ $contact->email }}</td>
                    </tr>
                    @if($contact->phone)
                    <tr>
                      <td style="padding:6px 0;font-size:13px;font-weight:600;color:#64748b;width:120px;vertical-align:top;">{{ __('Phone') }}</td>
                      <td style="padding:6px 0;font-size:14px;color:#0f172a;">{{ $contact->phone }}</td>
                    </tr>
                    @endif
                    @if($contact->interests && is_array($contact->interests))
                    <tr>
                      <td style="padding:6px 0;font-size:13px;font-weight:600;color:#64748b;width:120px;vertical-align:top;">{{ __('Interests') }}</td>
                      <td style="padding:6px 0;font-size:14px;color:#0f172a;">{{ implode(', ', $contact->interests) }}</td>
                    </tr>
                    @endif
                    @if($contact->preferred_date)
                    <tr>
                      <td style="padding:6px 0;font-size:13px;font-weight:600;color:#64748b;width:120px;vertical-align:top;">{{ __('Preferred date') }}</td>
                      <td style="padding:6px 0;font-size:14px;color:#0f172a;">{{ $contact->preferred_date->translatedFormat('d F Y') }} {{ $contact->preferred_time ? '- '.$contact->preferred_time : '' }}</td>
                    </tr>
                    @endif
                  </table>
                </td>
              </tr>
            </table>

            @if($contact->message)
            <div style="background-color:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:16px 20px;margin-bottom:24px;">
              <p style="margin:0 0 6px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#2563eb;">{{ __('Your message') }}</p>
              <p style="margin:0;font-size:14px;color:#1e293b;line-height:1.6;">{{ $contact->message }}</p>
            </div>
            @endif

            {{-- Setup CTA if not set up --}}
            @if(!$client->isSetup() && $client->setup_token)
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0fdf4;border:1px solid #a7f3d0;border-radius:10px;margin-bottom:24px;">
              <tr>
                <td style="padding:20px 24px;">
                  <p style="margin:0 0 8px;font-size:15px;font-weight:700;color:#065F46;">{{ __('Activate your client area') }}</p>
                  <p style="margin:0 0 16px;font-size:13px;color:#047857;line-height:1.5;">{{ __('Track your requests, exchange messages with our team and manage your appointments from your personal space.') }}</p>
                  <table role="presentation" cellpadding="0" cellspacing="0">
                    <tr>
                      <td style="background-color:#059669;border-radius:8px;">
                        <a href="{{ route('client.setup', $client->setup_token) }}" style="display:inline-block;padding:12px 28px;color:#ffffff;font-size:14px;font-weight:700;text-decoration:none;font-family:'Plus Jakarta Sans',Helvetica,Arial,sans-serif;">{{ __('Set up my account') }}</a>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            @elseif($client->isSetup())
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
              <tr>
                <td align="center">
                  <table role="presentation" cellpadding="0" cellspacing="0">
                    <tr>
                      <td style="background-color:#2563eb;border-radius:8px;">
                        <a href="{{ route('client.login') }}" style="display:inline-block;padding:12px 28px;color:#ffffff;font-size:14px;font-weight:700;text-decoration:none;font-family:'Plus Jakarta Sans',Helvetica,Arial,sans-serif;">{{ __('Access my client area') }}</a>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            @endif

            <p style="margin:0;font-size:13px;color:#94a3b8;line-height:1.5;">{{ __('If you did not submit this request, you can ignore this email.') }}</p>
          </td>
        </tr>

        {{-- Footer --}}
        <tr>
          <td align="center" style="padding-top:28px;">
            <p style="margin:0;font-size:12px;color:#94a3b8;">&copy; {{ date('Y') }} Voxa Center. {{ __('All rights reserved.') }}</p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
