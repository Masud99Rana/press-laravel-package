<!--
*** Md. Masud Rana
*** Mail: Masud.letsCode@gmail.com
*** The design of this template took my 1 day.
*** Happy Learning, Happy Coding.
[![Made with love by Masud Rana][madewith-shield]][linkedin-url] 
[![status][status-shield]][linkedin-url] 
[![Laravel][laravel-shield]][laravel-url]
[![PHP][php-shield]][php-url]
[![lumen][lumen-shield]][lumen-url]
[![Vue js][vue-shield]][vue-url]
[![NPM][npm-shield]][npm-url]
[![Node Js][nodejs-shield]][nodejs-url]
[![javascript][javascript-shield]][javascript-url]
[![bootstrap][bootstrap-shield]][bootstrap-url]
<a href="https://en.wikipedia.org/wiki/Bangladesh"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/Flag_of_Bangladesh.svg/800px-Flag_of_Bangladesh.svg.png" alt="Logo" width="40" height="20"> </a>
[![My LinkedIn Profile][linkedin-shield]][linkedin-url]
[![Gmail][gmail-shield]][gmail-url]
[![Laravel][laravel-shield]][laravel-url]
Be warned: ** this source code may not be production ready. Use at your own risk.**
-->

# Press Laravel Package
> **Note:** This repository contains the core code of a Laravel Package "Press" that helps to create markdown-powered blog. It is one of my *Package Development* projects which i have made to practice Laravel's Package Development.

[![Made with love by Masud Rana][madewith-shield]][linkedin-url] 
[![status][status-shield]][linkedin-url] 


<a href="https://en.wikipedia.org/wiki/Bangladesh"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/Flag_of_Bangladesh.svg/800px-Flag_of_Bangladesh.svg.png" alt="Logo" width="40" height="20"> </a>
[![My LinkedIn Profile][linkedin-shield]][linkedin-url]
[![Gmail][gmail-shield]][gmail-url]


<!-- TABLE OF CONTENTS -->
## Table of Contents

* [About the Project](#about-the-project)
  * [Built With](#built-with)
  * [Features](#features)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
* [Usage](#usage)
* [Roadmap](#roadmap)
* [Contributing](#contributing)
* [Resources](#resources)
* [License](#license)
* [Contact](#contact)
* [Acknowledgements](#acknowledgements)
* [Heartiest Thanks](#heartiest-thanks)
  * [Academic Instructors](#academic-instructors)
  * [Online Instructors](#online-instructors)
  * [Project Instructor](#project-instructor)


## About The Project

Markdown is a lightweight markup language with plain text formatting syntax. Press is a Laravel Framework's Package which helps to create markdown-powered blog, convert Markdown article to HTML article and store in the database. In this project, I have practiced how to develop a real-world, Laravel Package.

Goal:
- [x] Build a practical, real-world Laravel Package.
- [x] Create a user friendly blog helper to convert Markdown article to HTML, 
- [x] Practice Laravel's **Core Functionality**. like, Facade, Service Container/Provider, Dependency Injection, Artisan Command and many more.
- [x] Practice PHP Unit Test.

Of course, I have achieved most of the goals in this project. Let's Cheers. :smile:

Here, the package is stored for future reference. It may also help who wants to build or needs a Laravel Package which converts markdown to html and store the converted html in the database.

> **Note: I will publish this package on packagist soon. I will make different version following Semantic Versioning**


### Built With
The major technologies that i have used to build this project.
Here are:
* [Laravel v5.8 & v6](https://laravel.com) : The PHP Framework for Testing the package.
* [Testbench ](https://github.com/orchestral/testbench) : Laravel Testing Helper for Packages Development


### Features

* Convert Markdown to HTML.
* Store HTML article to database.
* Fetch data from database.
* Add extra article field.
* Add new posts from Markdown **Artisan Command**.

**And many more. Explore them by following "[Getting Started](#getting-started)" section.**



<!-- GETTING STARTED -->
## Getting Started

To get a local copy up and running follow these simple example steps.

> **Be warned: This source code may not be production ready. Use at your own risk.**

### Prerequisites

Basic understanding of "How to install laravel package" and Composer.

### Installation

1. Add these lines to your `composer.json` file </br>
```json
{
    "require": {
        "masud99rana/press": "dev-master"
    },
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/Masud99Rana/Press-Laravel-Package.git"
        }
    ]
}
```
2. And then in the terminal, run the following command.</br>
`composer update`

3. Migrate Database table </br>
`php artisan migrate`

4. Publish the package config </br>
`php artisan vendor:publish --tag=press-config`

You will now find the config file located in `/config/press.php`

5. Create directory to hold posts (You can change the folder name in press.php config file) </br>
`mkdir blogs`

6. Create a Markdown file for article in blogs folder. Demo: "[Sample Post](#sample-post)"

<h4> If you want to add extra field, you need to follow step 7, 8. Or, Simply skip step 7,8. </h4>

7. Publish the package Service Provider</br>
`php artisan vendor:publish --tag=press-provider`

You will now find the Service Provider file located in `/app/Providers/PressServiceProvider.php`

8. Autoload the service providers in `/config/app.php` </br>
```json
/*
 * Package Service Providers...
 */
App\Providers\PressServiceProvider::class,

```

9. Create directory in `/app` directory to hold extra fields (You need to follow "[new field structure](#add-new-field)") </br>
`mkdir Fields`

10. Run the artisan command to convert markdown to html and store in the database.  </br>
`php artisan press:process`

That's Cool. Now, you are ready to go. </br>
If you face any problem to installation this package feel free to [inform me](#contact).

<!-- USAGE EXAMPLES -->
## Usage

### Sample Post

To create your first post, here's a sample markdown file to get you started. Copy and paste it into a `.md` file in your blogs diretory.

```json
---
title: My Title
description: Description here
author: Masud Rana
extra: you can add extra field here as manay as you want.
---
# Heading
Blog post body here
```

### Add New Field
Directory : `/app/Fields/Author.php`
```php
namespace App\Fields;

use masud\Press\Fields\FieldContract;

class Author extends FieldContract
{
	public static function process($type, $value, $data){
		
		return [
			'author' => "Masud",
		];
	}
}
```

Register the new field in `app\Providers\PressServiceProvider`. 

```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use masud\Press\Facades\Press;

class PressServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Press::fields($this->registerFields());
    }

    public function register()
    {
        //
    }

    protected function registerFields()
    {
        return [
            \App\Fields\Author::class,
        ];
    }
}
```


> **Note: I will update this section soon.**

<!-- ROADMAP -->
## Roadmap

> **Note: I will update this section soon.**


<!-- CONTRIBUTING -->
## Contributing

Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/newFeature`)
3. Commit your Changes (`git commit -m 'Add some newFeature'`)
4. Push to the Branch (`git push origin feature/newFeature`)
5. Open a Pull Request



## Resources

* [Package Development](https://laravel.com/docs/6.x/packages)



<!-- LICENSE -->
## License

This is an open-source project. You can use or distribute it any legal purpose.



<!-- CONTACT -->
## Contact

Md. Masud Rana

[![My LinkedIn Profile][linkedin-shield]][linkedin-url]
[![Gmail][gmail-shield]][gmail-url]

Project Link: [https://github.com/Masud99Rana/Press-Laravel-Package.git](https://github.com/Masud99Rana/Press-Laravel-Package.git)


<!-- ACKNOWLEDGEMENTS -->
## Acknowledgements
> **Note: I will update this section soon.**


## Heartiest Thanks 
> **Note: I will update this section soon.**

#### Academic Instructors
> **Note: I will update this section soon.**

#### Online Instructors

> **Note: I will update this section soon.**

#### Project Instructor

> **Note: I will update this section soon.**


#### You

* Thank you so much! :sparkling_heart:






<!-- MARKDOWN LINKS & IMAGES -->
<!--  https://github.com/tchapi/markdown-cheatsheet -->
<!-- https://www.webfx.com/tools/emoji-cheat-sheet/ -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->


[masud-version]: https://img.shields.io/badge/Masud-v7.8.*-blue?style=flat-square

[status-shield]: https://img.shields.io/badge/Status-In%20Progress-success?style=flat-square



[laravel-shield]:https://img.shields.io/badge/laravel-v5.8-555.svg?style=flat-square&logo=laravel&labelColor=FF2D20&logoColor=fff
[laravel-url]: https://laravel.com

[vue-shield]:https://img.shields.io/badge/vue.js-v2.8-black.svg?style=flat-square&logo=vue.js&color=#4FC08D
[vue-url]: https://vuejs.org/

[php-shield]:https://img.shields.io/badge/php-v2.8-555.svg?style=flat-square&logo=php&labelColor=777BB4&logoColor=fff
[php-url]: https://php.net

[javascript-shield]:https://img.shields.io/badge/-JavaScript-555.svg?style=flat-square&logo=javascript&labelColor=F7DF1E&logoColor=fff
[javascript-url]: https://developer.mozilla.org/en-US/docs/Web/JavaScript

[lumen-shield]:https://img.shields.io/badge/Lemen-v1.7-555.svg?style=flat-square&logo=lumen&labelColor=E74430&logoColor=fff
[lumen-url]: https://lumen.laravel.com/


[npm-shield]:https://img.shields.io/badge/npm-v2.8-CB3837.svg?style=flat-square&logo=npm
[npm-url]: https://nodejs.org/en/

[nodejs-shield]:https://img.shields.io/badge/Node.Js-v1.7-555.svg?style=flat-square&logo=node.js&labelColor=339933&logoColor=fff
[nodejs-url]: https://nodejs.org/en/

[bootstrap-shield]:https://img.shields.io/badge/Bootstrap-v1.7-success.svg?style=flat-square&logo=bootstrap&labelColor=563D7C&logoColor=fff
[bootstrap-url]: https://getbootstrap.com/


[madewith-shield]:https://img.shields.io/badge/R-Made%20With%20Love-success?style=flat-square&labelColor=00cec9&logo=monzo&logoColor=fff&color=00b894

[linkedin-shield]: https://img.shields.io/badge/-MasudRana99mr-black.svg?style=flat-square&logo=linkedin&color=555
[linkedin-url]: https://www.linkedin.com/in/masudrana99mr


[gmail-shield]: https://img.shields.io/badge/-Masud.letscode@gmail.com-555.svg?style=flat-square&logo=gmail&labelColor=D14836&logoColor=fff
[gmail-url]: mailto::masud.letscode@gmail.com



<!-- My Note -->
<!--
*** <img src="images/logo.png" alt="Logo" width="80" height="80">
*** 
*** [screenshot]: images/screenshot.png
*** [![Product Name Screen Shot][screenshot]](https://example.com)
*** 
*** 
***
*** 
*** 
***
-->
   
