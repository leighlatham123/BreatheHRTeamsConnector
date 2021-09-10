# Vanilla PHP Breathe HR Teams Connector
A PHP integration between Breathe HR and Microsoft Teams.

#### OOP PHP
#### PSR-12 standard
#### Supports PHP 5.6+
 
## Objective
The objective of this project is to create a script/library that can be run without any third party packages or tools (besides PHP) for connectvity between Breathe HR API and a Microsoft Teams solution.
The aim is to integrate the absence events for employees whether that is sicknesses, holidays or other and send them to a Microsoft teams channel. Though this could just as easily be reconfigured by a developer to point to Slack or any other chat client with an API that accepts markdown messages.

### Installation
Simply add your deployments API keys and Webhooks to the environment file and run any of the commands provided below on a schedule such as a cron job or manually.

### Environment Setup

```
# Microsoft Teams channel
TEAMS_ABSENCES_WEBHOOK={ Your Microsoft Teams connector webhook }

# Breathe HR
BREATHE_API_KEY={ Your Breathe HR API Key }
BREATHE_API_HOST={ Your Breathe HR API URL }
```

### Supported Commands

#### Retrieve all events (all absences API values, all sicknesses API values)
*Optional flags {-s} and {-e} to specify date string format {YYYY-MM-DD}*
```
php {../PATH_TO_PROJECT}/src/php/Console.php events
```
#### Retrieve all events (all upcoming absences API values)
*Optional flags {-t} and {-f} to specify date string format {YYYY-MM-DD}*
```
php {../PATH_TO_PROJECT}/src/php/Console.php upcoming
```
#### Retrieve all holiday events (all absences API values)
*Optional flags {-s} and {-e} to specify date string format {YYYY-MM-DD}*
```
php {../PATH_TO_PROJECT}/src/php/Console.php holidays
```
#### Retrieve all sicknesses events (all sicknesses API values)
*Optional flags {-s} and {-e} to specify date string format {YYYY-MM-DD}*
```
php {../PATH_TO_PROJECT}/src/php/Console.php sicknesses
```
#### Retrieve all employees (all employees API values)
```
php {../PATH_TO_PROJECT}/src/php/Console.php employees
```
#### Retrieve employee by id (employee API value)
*Required flag {-i} to specify a valid Employee ID.*
```
php {../PATH_TO_PROJECT}/src/php/Console.php employee -i {EMPLOYEE_ID}
```

### Scheduling

Once you are satisfied with your required commands list and have set up the environment file, just add the command to a scheduling assisting service such as a cron job.
```
0 0 * * * {../path/to/php} {../PATH_TO_PROJECT}/src/php/Console.php events 2>&1
```
