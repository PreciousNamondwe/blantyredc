# How to Run and Access the Blantyre District Portal

This guide explains how the website is set up on this server and how you can make sure it stays available for everyone on your network.

---

## 🚀 1. How to access the website
Anyone connected to the same network as this server can see the website by typing this address into their web browser:

👉 **http://10.100.38.13:8080**

---

## 📁 2. Where are the website files?
To make sure the website runs correctly with the right permissions, we have placed the active files here:

**Folder:** `/home/blantyredc/blantyredc.gov.mw`

> **Important:** If you want to change the website (like updating text or images), you must make those changes in the folder above. Changes made in the old `/var/www/html` folder will **not** show up on the network.

---

## 🛠 3. What we did to make it work
*   **Used a Newer PHP Version:** The standard server was using an older version of PHP (7.4). This website requires a newer version, so we used the modern PHP 8.4 found in your "Herd" settings.
*   **Set up Port 8080:** Since the server was already using the standard port 80 for other things, we set this website to run on **8080**.
*   **Network Ready:** We updated the website's settings so it knows its own network address (10.100.38.13). This ensures that all images and links work for everyone.

---

## 🔄 4. What to do if the website goes down
If the server restarts or the website stops responding, you can bring it back up by following these steps:

1.  Open your terminal.
2.  Copy and paste the command below and press **Enter**:

```bash
cd /home/blantyredc/blantyredc.gov.mw && /home/blantyredc/.config/herd-lite/bin/php spark serve --host 0.0.0.0 --port 8080 > /dev/null 2>&1 &
```

This command starts the website in the background so it keeps running even after you close your terminal.

---

## 📝 Quick Facts
*   **Network Address:** `10.100.38.13`
*   **Port Number:** `8080`
*   **Active Project Folder:** `/home/blantyredc/blantyredc.gov.mw`

---
*Last Updated: February 25, 2026*
