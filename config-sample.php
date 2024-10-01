<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - Online Appointment Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) Alex Tselegidis
 * @license     https://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        https://easyappointments.org
 * @since       v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Easy!Appointments Configuration File
 *
 * Set your installation BASE_URL * without the trailing slash * and the database
 * credentials in order to connect to the database. You can enable the DEBUG_MODE
 * while developing the application.
 *
 * Set the default language by changing the LANGUAGE constant. For a full list of
 * available languages look at the /application/config/config.php file.
 *
 * IMPORTANT:
 * If you are updating from version 1.0 you will have to create a new "config.php"
 * file because the old "configuration.php" is not used anymore.
 */
class Config
{
    // ------------------------------------------------------------------------
    // GENERAL SETTINGS
    // ------------------------------------------------------------------------

    const BASE_URL = 'https://easyappointments.herokuapp.com'; // Update this to your base URL
    const LANGUAGE = 'english';
    const DEBUG_MODE = false;

    // ------------------------------------------------------------------------
    // DATABASE SETTINGS
    // ------------------------------------------------------------------------

    // DATABASE SETTINGS
    const DB_HOST = 'HEROKU_DB_HOST'; // These placeholders will be replaced
    const DB_NAME = 'HEROKU_DB_NAME'; // with actual values from environment
    const DB_USERNAME = 'HEROKU_DB_USERNAME'; // variables when the app runs
    const DB_PASSWORD = 'HEROKU_DB_PASSWORD';

    // const DB_HOST = 'sql101.infinityfree.com'; // Change to your database host, e.g., 'localhost'
    // const DB_NAME = 'if0_37407902_easyappointments '; // Database name you created
    // const DB_USERNAME = 'if0_37407902'; // Your database username
    // const DB_PASSWORD = '2X3egefiQeMfZC'; // Your database password

    // ------------------------------------------------------------------------
    // GOOGLE CALENDAR SYNC
    // ------------------------------------------------------------------------

    const GOOGLE_SYNC_FEATURE = false; // Enter TRUE or FALSE
    const GOOGLE_CLIENT_ID = '';
    const GOOGLE_CLIENT_SECRET = '';
}

