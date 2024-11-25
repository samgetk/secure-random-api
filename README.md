# Assignment for Mereb Technologies PHP Developer Position: Secure Random API

This project provides an API that generates secure random numbers using the `getSecureRandom` method from `utils.php`. It also includes test cases to validate the functionality and performance tests for evaluation.

---

## Requirements
- PHP 8.2 or higher
- Composer (for dependency management)
- cURL (for testing the API)

---

## Setup Instructions

### 1. Install Composer
Make sure you have Composer installed. If not, you can install it by following the instructions [here](https://getcomposer.org/download/).

After installing Composer, run the following command to install the project dependencies:

```bash
composer install
```

Running the Project
### 2. Generate Secure Random Numbers via the API
Use cURL to send a GET request to the API for generating secure random numbers. 

```bash
curl --location 'http://localhost/assignment/api/SecureRandomController.php?min=25&max=45415'
```
Replace min and max with your desired range.

### 3. Run Unit Tests
To validate the functionality of the getSecureRandom method, execute the PHPUnit tests with the following command:

```bash
php vendor/bin/phpunit tests/UtilsTest.php
```

### 4.  Run Performance Tests
To measure the performance of the getSecureRandom API for 1,000 requests, use:

```bash
php vendor/bin/phpunit tests/ApiPerformanceTest.php
```
This will display the average response time for 1,000 requests.



## Improving Performance
For better performance, enable opcache in your PHP configuration. Add or modify the following lines in your php.ini file:

```bash
[opcache]
opcache.enable=1
opcache.enable_cli=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=10000
opcache.validate_timestamps=0
```

After updating the php.ini, restart your PHP server for the changes to take effect. This will significantly improve the performance of your API.


## Project Structure
- utils/utils.php: Contains the Utils class with the getSecureRandom method (Existing).
- api/SecureRandomController.php: The API endpoint for generating secure random numbers.
- tests/UtilsTest.php: Contains unit test cases for getSecureRandom.
- tests/ApiPerformanceTest.php: Measures the API's performance for generating secure random numbers.
- composer.json: Composer configuration file 
