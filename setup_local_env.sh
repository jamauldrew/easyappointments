#!/bin/bash

# Fetch Heroku database URL
JAWSDB_URL=$(heroku config:get JAWSDB_URL)

# Parse the database URL
DB_HOST=$(echo $JAWSDB_URL | awk -F[@//] '{print $4}')
DB_NAME=$(echo $JAWSDB_URL | awk -F[/] '{print $4}')
DB_USERNAME=$(echo $JAWSDB_URL | awk -F[:@] '{print $2}')
DB_PASSWORD=$(echo $JAWSDB_URL | awk -F[:@] '{print $3}')

# Create .env file
cat <<EOF >.env
APP_ENV=development
BASE_URL=http://localhost:8000

# Database Configuration
DB_HOST=$DB_HOST
DB_NAME=$DB_NAME
DB_USERNAME=$DB_USERNAME
DB_PASSWORD=$DB_PASSWORD

# Application Settings
DEBUG_MODE=true
DEFAULT_LANGUAGE=english

# Google Calendar Sync
GOOGLE_SYNC_FEATURE=false
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
EOF

echo ".env file created with Heroku database information."

# Clone Heroku database schema to local
echo "Cloning Heroku database schema to local..."
heroku pg:pull DATABASE_URL $DB_NAME --app easyappointments

echo "Local environment setup complete."
