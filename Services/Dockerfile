# Use an official PHP image as the base image
FROM php:8.1-cli

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    python3 \
    python3-pip \
    python3-venv \
    libjpeg-dev \
    libfreetype6-dev \
    libpng-dev \
    libmysqlclient-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Create a Python virtual environment in the working directory
RUN python3 -m venv /var/www/html/venv

# Install Python dependencies inside the virtual environment
RUN /var/www/html/venv/bin/pip install --no-cache-dir pandas matplotlib fpdf

# Copy PHP and Python code into the container
COPY . /var/www/html

# Expose port 8000 for the PHP server
EXPOSE 8000

# Command to start the PHP server
CMD ["php", "-S", "0.0.0.0:8000", "index.php"]
