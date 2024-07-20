Write Rest API application for the book library which allow to track what books they have.

(only books, without any other dependencies like clients, etc.)

## Acceptance  criteria:

### Required
* Application should use the latest PHP version
* Application should use "composer" to install all dependencies
* Application should support GET/POST/PATCH/DELETE actions
* Application should have PHPUnit tests
* Application should have README instructions on how to setup and run an application
* The final result should be posted on GitHub and should have  comments with a clear messages for what was done there

### Not required (but will be a plus)
* Application should have a Swagger UI page
* Application should use Symfony/Laravel framework
* Application should have an automatic setup process with fixtures and migrations
* Application should be built using Docker container (docker-compose)


## Book model:
* Title (string)
* Publisher (string)
* Author (string)
* Genre (string)
* Book publication (date)
* Amount of words in the book (int)
* Book price in US Dollars
