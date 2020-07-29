# Wordimpress Bootstrap template

Bootstrap template for Wordimpress, a static site generator using Wordpress API as content source.
The project still a prototype.

This implementation retrieves content from [https://wordpress.org/news](https://wordpress.org/news).

## Key features

- uses Twig as template engine
- supports Sass (using Bootstrap Sass via composer)
- support Facebook comment plugin
- built-in watcher to compile as files change
- convert images to WebP format
- supports markdown to HTML

## Usage

Copy ".env.example" to ".env" and adjust the properties.

To compile templates, Sass and copy media once run `php compile.php`.

To compile then watch for changes add `-w` parameter: `php compile.php -w`.

The parameter `-m` add compression (currently only Sass has support).

## To do list

Tasks prioritized are updated on the library [pedrosancao/wordimpress][0] project.

[0]: https://github.com/pedrosancao/wordimpress/
