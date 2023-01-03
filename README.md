# CMS Laravel

--------
## Features:
* Authenticate users(login/signup pages + logout button)
* CR*D  Articles (no updating required)
* GET and display paginated lists of articles
* GifTool.js Tools: 
Provides Gif Blocks for the Editor.js.
### Routing Guidelines
- Home page (URL: / )
    -   List of articles
    -   Pagination for list of articles
    -   Sign in/Sign up pages (URL: /login, /register )
-  Create articles (URL: /admin/articles)
- Article page for authenticated user (URL: /admin/articles )
    - Delete article button
-----------
# Getting started
## Installation
Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/9.x#installation)
- Clone the repository
```
    git clone  <git hub template url> <project_name>
```
- Switch to the repo folder
```
    cd <project_name>
```
- Install all the dependencies using composer
```
   composer install
```
Copy the example env file and make the required configuration changes in the .env file
```
   cp .env.example .env
```
Generate a new application key
```
   php artisan key:generate
```
Run the database migrations (**Set the database connection in .env before migrating**)
```
   php artisan migrate
```
Start the local development server
```
  php artisan serve
```
You can now access the server at http://localhost:8000
**TL;DR command list**

    git clone https://github.com/ranaHun/gif-api
    cd gif-api
    composer install
    cp .env.example .env
    php artisan key:generate
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes users and articles. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the Factory files and set the property values as per your requirement

    database/factories/UserFactory.php
    database/factories/ArticleFactory.php

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

# Code overview

## Dependencies
### GifTool.js Tools

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

# GifTool.js Tools
## Features
* Uploading Gif from API
* Pasting copied content from the web
## Install
Manual downloading and connecting
1. Upload folder `dist` from repository
2. Add `dist/bundle.js` file to your page.

Then require this script on page with Editor.js through the `<script src=""></script>` tag.
```
 <script type="text/javascript" src="js/GifBlockPlugin/dist/bundle.js"></script>
```
## Usage

Add a new Tool to the `tools` property of the Editor.js initial config.

```javascript
const editor = new window.EditorJS({
                /**
                 * Id of Element that should contain Editor instance
                 */
                holder: 'editorjs',
                tools: {
                        GifTool: {
                                class: GifTool,
                                config: {
                                        endpoint: 'http://localhost:3000'
                                }
                        }
                }
        });
```
## Output data
This Tool returns `data` with following format

| Field          | Type      | Description                     |
| -------------- | --------- | ------------------------------- |
| url           | `string`  | image's `url` |
| caption        | `string`  | image's caption                 |



```json
{
    "type" : "image",
    "data" : {
        "url" : "https://www.tesla.com/tesla_theme/assets/img/_vehicle_redesign/roadster_and_semi/roadster/hero.jpg",
        "caption" : "Roadster // tesla.com",
    }
}
```
## After Update GifTool
1. Switch to the GifTool folder
```
  cd public\js\GifBlockPlugin
```
2. Run this command
```
npm run build
```
----------
