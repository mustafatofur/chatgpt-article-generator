
#   🧠  ChatGPT Article / Content Generator

Welcome to "ChatGPT Article / Content Generator" repository. Delighted to see you here! 
This is a **Laravel** script/app that helps you to create by the tone language unique article/content for your blog, news, recipes ...etc websites or you can use this app in your personal research purposes. 



https://user-images.githubusercontent.com/82325607/229308365-105ff5de-d6c1-4556-b1f1-ffca88f93801.mp4



## Get Started

### Installation 

First, Setting up your development environment on your local machine:

```bash
 git clone https://github.com/mustafatofur/chatgpt-article-generator.git
 cd chatgpt-article-generator
 composer install
 npm install
```
Rename .env.example to .env and set your OpenAI API key in the .env file:

```
OPENAI_API_KEY= sk-...
```

### Run The Project

If you would like to make changes on the project run:

```bash
npm run dev  
```

And make sure that you already included @vite() directives:

resources/views/layouts/app.blade.php:

``` html
<head>
 	@vite('resources/css/app.css')
</head>
<body>
...
	 @vite('resources/js/app.js')
</body>
```
And then, run:

```bash
php artisan serve
```

Now kindly access the application via [http://localhost:8000](http://localhost:8000)



### Thanks to:

#### Beside Laravel, this project uses other tools like:

- [Vite](https://github.com/vitejs/vite)
- [TailwindCSS](https://github.com/tailwindlabs/tailwindcss)
- [VueJS](https://github.com/vuejs)
- [OpenAI Laravel](https://github.com/openai-php/laravel)
- [SlimSelect](https://github.com/brianvoe/slim-select)
