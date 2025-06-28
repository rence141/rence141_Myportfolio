FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Copy all files
COPY . .

# Create messages directory
RUN mkdir -p messages

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod 777 messages

# List files for debugging
RUN ls -la /var/www/html/

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"] 