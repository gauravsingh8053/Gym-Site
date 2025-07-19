# Use official PHP + Apache image
FROM php:8.1-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy website files to web server root
COPY . /var/www/html/

# Set proper file permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 for the web server
EXPOSE 80

