<?php
// index.php

// Get the user agent string
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// Your target URL (where you want to send users if Chrome is available)
$targetUrl = "http://rakibdepu.github.io/"; // <-- change this to your real URL

// Check if request comes from Android WebView (including Facebook in-app browser)
if (stripos($userAgent, 'Android') !== false &&
    (stripos($userAgent, 'wv') !== false || stripos($userAgent, 'Version/') !== false || stripos($userAgent, 'FBAV') !== false)) {
    
    // Build Chrome intent URL with fallback to Play Store
    $encodedUrl = urlencode($targetUrl);
    $intent = "intent://$encodedUrl#Intent;scheme=https;package=com.android.chrome;S.browser_fallback_url=https%3A%2F%2Fplay.google.com%2Fstore%2Fapps%2Fdetails%3Fid%3Dcom.android.chrome;end;";
    
    // Show debug info
    echo "<h3>📱 Android WebView detected (including Facebook in-app browser)</h3>";
    echo "<p><b>User Agent:</b> " . htmlspecialchars($userAgent) . "</p>";
    echo "<p>Redirecting to Chrome (or Play Store if Chrome not installed)...</p>";
    
    // Delay a little so you can see debug info before redirect
    header("Refresh: 2; URL=$intent");
    exit;
}

// If not WebView, show details only
echo "<h3>✅ No WebView detected</h3>";
echo "<p><b>User Agent:</b> " . htmlspecialchars($userAgent) . "</p>";
?>
