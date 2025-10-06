# Phishing Website Awareness — README.md

## Purpose
Educational phishing-awareness demo for controlled lab use only. This repository shows how a cloned login page can capture credentials for teaching defenders how to spot and mitigate phishing attacks. **Do not use this project against real users, networks, or services without explicit written consent.**

## Overview

This repository contains a small, self-contained phishing-awareness demonstration. It includes a cloned Instagram login page (frontend), a simple backend logger (`store.php`) that appends username:password lines to `creds.txt`, and an automation/monitor script (`app.py`) used only for demonstration in a lab environment.

**This project is strictly for training, awareness, and defensive research — not for real-world exploitation.**

## ⚠️ WARNING — Legal & Ethical Notice

- This project is for **education and lab testing only**.
- Unauthorized interception of network traffic, credential harvesting, or impersonation is **illegal** in most jurisdictions and may lead to criminal charges.
- Always obtain **explicit written consent** from any participants and run tests only on isolated, controlled networks (virtual machines, isolated VLANs, or air-gapped labs).
- The README intentionally avoids describing how to intercept or manipulate other people's network traffic (ARP/DNS spoofing, MITM). If you are running a university/course lab, coordinate with legal/compliance and network admins.

## Repository Layout

```
README.md
index.html          # Main fake login page
ind.html            # Alternative login page
style.css           # Styling for the fake pages
store.php           # Backend logger (appends to creds.txt)
login.php           # Alternative backend handler
app.py              # Python automation/monitor (reads creds.txt for demo)
dns_spoof.py        # DNS spoofing demonstration (lab use only)
creds.txt           # Credential log (created at runtime; keep empty before demo)
log.txt             # Additional logging
venv/               # Python virtual environment
assets/             # Images, icons, CSS, etc.
├── insta_logo.png
├── insta_photo.jpeg
├── facebook_icon.png
├── set.jpeg
└── logo.jpeg
```

## What This Project Demonstrates

1. **Visual Deception**: A visual clone of Instagram's login page and how easily users can be deceived by look-alike UI.
2. **Credential Logging**: How an attacker-side logger would record username:password entries (for training).
3. **Automation Risks**: How automation can be used to demonstrate credential re-use risks (only in lab).
4. **Defensive Lessons**: TLS/certificate checks, domain validation, MFA, user education, and monitoring.

## Safe Local Setup (Recommended)

### 1. Clone and Setup
```bash
# Clone repo and change into folder
git clone https://github.com/<your-username>/phishing-awareness.git
cd fake_insta
```

### 2. Python Environment Setup
```bash
# Create a Python virtual environment and install required packages
python3 -m venv venv
source venv/bin/activate  # On Windows: venv\Scripts\activate
pip install selenium flask
```

### 3. Prepare Credential Log
```bash
# Ensure creds.txt exists and is empty
touch creds.txt  # On Windows: New-Item -Path "creds.txt" -ItemType File
# Clear the file
> creds.txt  # On Windows: Clear-Content creds.txt
# Keep file permissions restrictive (Unix/Linux)
chmod 600 creds.txt
```

### 4. Local Web Server
```bash
# Serve the demo site locally using Python's simple HTTP server
python3 -m http.server 8000
# Open http://localhost:8000/index.html in a browser on the same machine
```

### 5. PHP Backend (Optional)
Use `store.php` only if you have a PHP-capable local web server (like XAMPP, WAMP, or local Apache/PHP stack). For safer local-only demo, consider adapting to use a Flask route.

### 6. Verify Demo Functionality
```bash
# After a demo submission, confirm creds.txt has entries
cat creds.txt  # On Windows: Get-Content creds.txt
# Example line: demouser:demopass
```

### 7. Run Automation (Lab Only)
```bash
# Run the automation/monitor script only after confirming demo entry
python3 app.py
```

**Important**: Never use real account credentials during any demo. Use throwaway/demo accounts only.

## Recommended Safe Enhancements (For Training)

1. **Training Banner**: Add a clearly visible 'TRAINING MODE' banner on the fake login page so participants always know they're in a demo.
2. **Consent Page**: Implement a consent/acknowledgement page before the demo page.
3. **Awareness Dashboard**: Build a dashboard (Flask or static) that displays only non-sensitive metadata (timestamps, demo user IDs, instructional tips).
4. **Automated Cleanup**: Add automated cleanup that clears `creds.txt` after each session and removes temporary browser profiles.

## Troubleshooting

- **app.py crashes**: If the script crashes trying to parse `creds.txt`, open the file and confirm each non-empty line contains a colon (username:password). Remove malformed lines before relaunching.
- **store.php not writing**: Verify the file path is correct (e.g., `/var/www/html/creds.txt` if using Apache) and file permissions allow the web server to append.
- **Certificate warnings**: If the demo shows certificate/warning errors in a browser, this is expected if you're experimenting with non-HTTPS content — do not bypass or instruct real users to bypass browser security prompts.

## Defensive Lessons & Guidance

### Quick Security Checklist:
- ✅ Always check the domain (not just visual appearance)
- ✅ Look for HTTPS + valid certificate
- ✅ Never click through certificate warnings
- ✅ Enable multi-factor authentication (MFA)
- ✅ Use a password manager (it won't autofill on wrong domains)
- ✅ Train users with regular phishing simulation drills
- ✅ Implement clear post-simulation reporting

### Red Flags to Teach Users:
- URL doesn't match expected domain
- Missing HTTPS lock icon
- Certificate warnings or errors
- Urgent language or threats
- Requests for sensitive information via email/text
- Poor grammar or spelling in official communications

## Cleanup After Demo

```bash
# Securely delete or truncate creds.txt
> creds.txt  # Clear file content
# Or completely remove (be careful)
# rm creds.txt

# Remove temporary browser profiles
rm -rf /home/kali/.config/fake_chrome_profile/

# Clear any logs
> log.txt
```

## Technical Components

### Frontend (`index.html`)
- Pixel-perfect Instagram login page replica
- Responsive design for mobile and desktop
- Form submission to PHP backend

### Backend (`store.php`)
- Simple credential logging mechanism
- Redirects to real Instagram after capture
- Minimal PHP for demonstration purposes

### Automation (`app.py`)
- Selenium-based browser automation
- Monitors credential file for new entries
- Demonstrates post-compromise activities (educational only)

### Network (`dns_spoof.py`)
- DNS spoofing demonstration script
- Uses dnschef for domain redirection
- **Requires isolated network environment**

## License

MIT License — for educational use only. Attribution appreciated. **This project must not be used for malicious purposes.**

## Contact / Attribution

If you adapt this repository for classroom or internal training:
- Include a clear ethical/legal notice
- Provide attribution back to this repository
- Ensure proper institutional approval
- Coordinate with legal/compliance teams

## Disclaimer

This tool is provided for educational purposes only. The authors are not responsible for any misuse or illegal activities conducted with this software. Users must comply with all applicable laws and regulations in their jurisdiction.

**Remember**: The goal is to educate and protect, not to exploit or harm.
