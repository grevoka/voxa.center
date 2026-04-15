<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ __('Appointment rescheduled') }}</title>
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
            <h1 style="margin:0 0 8px;font-size:22px;font-weight:800;color:#1e293b;letter-spacing:-0.02em;">{{ __('Appointment rescheduled') }}</h1>
            <p style="margin:0 0 24px;font-size:14px;color:#64748b;line-height:1.5;">
              {{ __('The appointment for your request has been modified') }}
              @if($changedBy === 'client')
                {{ __('at your request') }}.
              @else
                {{ __('by our team') }}.
              @endif
            </p>

            {{-- Old date (struck through) --}}
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#fef2f2;border:1px solid #fecaca;border-radius:10px;margin-bottom:12px;">
              <tr>
                <td style="padding:16px 24px;">
                  <p style="margin:0 0 4px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#dc2626;">{{ __('Previous appointment') }}</p>
                  <p style="margin:0;font-size:16px;color:#991b1b;text-decoration:line-through;">
                    {{ $oldDate->translatedFormat('l d F Y') }} &mdash; {{ $oldSlot }}
                  </p>
                </td>
              </tr>
            </table>

            {{-- New date --}}
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0fdf4;border:1px solid #a7f3d0;border-radius:10px;margin-bottom:24px;">
              <tr>
                <td style="padding:16px 24px;">
                  <p style="margin:0 0 4px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#059669;">{{ __('New appointment') }}</p>
                  <p style="margin:0;font-size:16px;font-weight:700;color:#065f46;">
                    {{ $contact->appointment->date->translatedFormat('l d F Y') }} &mdash; {{ $contact->appointment->time_slot }}
                  </p>
                </td>
              </tr>
            </table>

            {{-- Request reference --}}
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f8fafc;border-radius:10px;border:1px solid #e2e8f0;margin-bottom:24px;">
              <tr>
                <td style="padding:16px 24px;">
                  <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                      <td style="padding:4px 0;font-size:13px;font-weight:600;color:#64748b;width:120px;">{{ __('Request') }}</td>
                      <td style="padding:4px 0;font-size:14px;color:#0f172a;">#{{ $contact->id }} &mdash; {{ $contact->name }}</td>
                    </tr>
                    @if($contact->company)
                    <tr>
                      <td style="padding:4px 0;font-size:13px;font-weight:600;color:#64748b;width:120px;">{{ __('Company') }}</td>
                      <td style="padding:4px 0;font-size:14px;color:#0f172a;">{{ $contact->company }}</td>
                    </tr>
                    @endif
                  </table>
                </td>
              </tr>
            </table>

            {{-- CTA --}}
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
              <tr>
                <td align="center">
                  <table role="presentation" cellpadding="0" cellspacing="0">
                    <tr>
                      <td style="background-color:#2563eb;border-radius:8px;">
                        <a href="{{ route('client.contact.show', $contact) }}" style="display:inline-block;padding:12px 28px;color:#ffffff;font-size:14px;font-weight:700;text-decoration:none;font-family:'Plus Jakarta Sans',Helvetica,Arial,sans-serif;">{{ __('View my request') }}</a>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>

            <p style="margin:0;font-size:13px;color:#94a3b8;line-height:1.5;">{{ __('If you have any questions, you can reply directly from your client area.') }}</p>
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
