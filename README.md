# Vaccine Registration System

## Overview

A brief description of your project, its purpose, and features.

## Prerequisites

- Docker and Docker Compose installed on your machine.

## Installation Process

Follow these steps to set up and run the project:

1. **Clone the Repository**
   ```bash
   git clone https://github.com/limonbat/vaccine_registration_system.git

2. **Navigate to the Project Root Directory**
   ```bash
   cd vaccine_registration_system

3. **Build and Start the Docker Containers**
   ```bash
   docker-compose up --build -d

4. **Get the application Container ID To find the container ID, run:**
   ```bash
   docker ps

5. **Access the Running Container Replace <container_id> with the actual container ID or name.**
   ```bash
   docker exec -it <container_id> bash

6. **Install Project Dependencies Inside the container, run:**
   ```bash
   composer install

7. **Access the Application Open your web browser and navigate to:**
   ```bash
   http://localhost:8000
