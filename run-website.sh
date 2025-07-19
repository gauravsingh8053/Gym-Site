#!/bin/bash

# Step 1: Build the Docker image
echo "Building Docker image..."
docker build -t my-website-image .

# Step 2: Stop and remove any old container
echo "Stopping existing container (if any)..."
docker stop my-website-container 2>/dev/null
docker rm my-website-container 2>/dev/null

# Step 3: Run the container
echo "Starting new container..."
docker run -d --name my-website-container -p 8080:80 my-website-image

echo "Website is running at http://localhost:8080"

