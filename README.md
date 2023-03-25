# Covid19Statistics
An application developed in VueJS to display some statistics about covid 19

The preferred method of is running the application througha Visual Studio Code IDE
To run the project in Visual Studio Code do the following
  1) Clone the repository through the IDE
  2) Open the built in IDE terminal and cd to the covidstats folder
  3) Launch another terminal in the same manner
  4) In one terminal run the following command "php artisan make:migration"
  5) In the same terminal run the following command "php artisan serve"
  6) In the other terminal run the following command "npm run dev"
  7) The project should be accessible through "localhost:8000" using any browser


The docker image of the project is not fully functional as when it is run
the welcome page is loaded but the vue components are not
To run the project using docker do the following 
  1) Clone the repository through the IDE
  2) Open the built in IDE terminal and cd to the covidstats folder
  3) In the terminal run the following command "docker-compose build"
  4) In the same terminal run the following command "docker-compose up"
  5) Open the docker desktop application 
  6) Go to laravel-test.1 and go to the terminal tab
  7) Run the following command in the docker terminal "npm run dev"
  8) The project should be accessible through "localhost:80" using any browser
