#!/bin/bash

# Storage Link Commands for Ubuntu Production Server
# Yayasan Al-Munawwar Laravel Application
# 
# This script creates symbolic links for all storage directories used by upload features
# Run this script on your Ubuntu production server after deployment

set -e  # Exit on any error

echo "🚀 Creating storage links for Yayasan Al-Munawwar application on Ubuntu..."

# Check if we're running as root or with sudo
if [[ $EUID -eq 0 ]]; then
    echo "⚠️  Running as root. Make sure to set proper ownership after completion."
fi

# Create the main storage link (Laravel default)
echo "📁 Creating main storage link..."
php artisan storage:link

# Create specific directories in storage/app/public if they don't exist
echo "📂 Creating storage directories..."

directories=(
    "storage/app/public/media"
    "storage/app/public/programs/brochures"
    "storage/app/public/programs/banners"
    "storage/app/public/programs/photos"
    "storage/app/public/explores"
    "storage/app/public/explores/images"
    "storage/app/public/settings"
    "storage/app/public/banners"
    "storage/app/public/history/banners"
    "storage/app/public/history/images"
    "storage/app/public/news"
    "storage/app/public/transfer-proofs"
    "storage/app/public/homepage/photos"
    "storage/app/public/events"
    "storage/app/public/organizational-structure/banners"
    "storage/app/public/organizational-structure/images"
    "storage/app/public/vision-mission/banners"
    "storage/app/public/vision-mission/images"
)

for dir in "${directories[@]}"; do
    if [ ! -d "$dir" ]; then
        mkdir -p "$dir"
        echo "✅ Created: $dir"
    else
        echo "📁 Already exists: $dir"
    fi
done

# Set proper permissions for Ubuntu/Apache2 or Nginx
echo "🔐 Setting proper permissions for Ubuntu..."

# For Apache2 (www-data user)
if command -v apache2 &> /dev/null; then
    echo "🌐 Apache2 detected, setting www-data ownership..."
    sudo chown -R www-data:www-data storage/app/public/
    sudo chown -R www-data:www-data public/storage/
    WEB_USER="www-data"
elif command -v nginx &> /dev/null; then
    echo "🌐 Nginx detected, setting www-data ownership..."
    sudo chown -R www-data:www-data storage/app/public/
    sudo chown -R www-data:www-data public/storage/
    WEB_USER="www-data"
else
    echo "⚠️  Web server not detected. Please set ownership manually:"
    echo "   sudo chown -R [web-user]:[web-group] storage/app/public/"
    echo "   sudo chown -R [web-user]:[web-group] public/storage/"
    WEB_USER="[web-user]"
fi

# Set directory permissions
sudo chmod -R 755 storage/app/public/
sudo chmod -R 755 public/storage/

# Set file permissions (if any files exist)
find storage/app/public/ -type f -exec sudo chmod 644 {} \; 2>/dev/null || true
find public/storage/ -type f -exec sudo chmod 644 {} \; 2>/dev/null || true

echo ""
echo "✅ Storage links created successfully for Ubuntu!"
echo ""
echo "📋 Summary:"
echo "   - Main storage link: ✅ Created"
echo "   - Storage directories: ✅ Created (${#directories[@]} directories)"
echo "   - Permissions: ✅ Set (755 for directories, 644 for files)"
echo "   - Owner: $WEB_USER"
echo ""
echo "🎯 Upload features ready for:"
echo "   • Media files (images, videos, PDFs)"
echo "   • Program brochures, banners, and photos"
echo "   • Explore section images"
echo "   • Site settings (logo, favicon)"
echo "   • Banner management"
echo "   • History section (banners and images)"
echo "   • News articles images"
echo "   • Student registration transfer proofs"
echo "   • Homepage photos"
echo "   • Events banner images"
echo "   • Organizational structure (banners and images)"
echo "   • Vision & Mission (banners and images)"
echo ""
echo "🔍 To verify installation:"
echo "   ls -la public/storage"
echo "   ls -la storage/app/public/"
echo ""
echo "🚀 Your Laravel application is now ready for production on Ubuntu!"