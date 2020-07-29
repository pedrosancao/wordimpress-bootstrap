<?php

use PedroSancao\Wordimpress\Contracts\ImportImagesInterface;
use PedroSancao\Wordimpress\Contracts\SiteInterface;
use PedroSancao\Wordimpress\Contracts\WithAuthorsInterface;
use PedroSancao\Wordimpress\Contracts\WithCategoriesInterface;
use PedroSancao\Wordimpress\Contracts\WithMediaInterface;
use PedroSancao\Wordimpress\Contracts\WithPagesInterface;
use PedroSancao\Wordimpress\Contracts\WithPostsInterface;
use PedroSancao\Wordimpress\BlogData\HasAuthorsTrait;
use PedroSancao\Wordimpress\BlogData\HasCategoriesTrait;
use PedroSancao\Wordimpress\BlogData\HasMediaTrait;
use PedroSancao\Wordimpress\BlogData\HasPagesTrait;
use PedroSancao\Wordimpress\BlogData\HasPostsTrait;
use PedroSancao\Wordimpress\Generator;

class Site implements
    ImportImagesInterface,
    SiteInterface,
    WithAuthorsInterface,
    WithCategoriesInterface,
    WithMediaInterface,
    WithPagesInterface,
    WithPostsInterface
{
    use HasAuthorsTrait;
    use HasCategoriesTrait;
    use HasMediaTrait;
    use HasPagesTrait;
    use HasPostsTrait;

    /**
     * @inheritdoc
     */
    public function getCacheDir(): string
    {
        return __DIR__ . '/cache';
    }

    /**
     * @inheritdoc
     */
    public function getOutputDir(): string
    {
        return __DIR__ . '/build';
    }

    /**
     * @inheritdoc
     */
    public function getTemplatesDir(): string
    {
        return __DIR__ . '/templates';
    }

    /**
     * @inheritdoc
     */
    public function getWordpressUrl(): string
    {
        return $_ENV['WORDPRESS'];
    }

    /**
     * @inheritdoc
     */
    public function mustConvertImages() : bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function beforeGenerate(Generator $generator): void
    {
        $generator->addTemplateValues([
            'locale' => $_ENV['LOCALE'],
            'base'   => $_ENV['BASE_URL'],
            'title'  => $_ENV['TITLE'],
            'origin' => $_ENV['WORDPRESS'],
            'fb_app' => $_ENV['FACEBOOK_APP_ID'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function configureTemplates(Generator $generator): void
    {
        $generator->addTemplate('index.twig', 'index.html', [
            'readme' => file_get_contents('./README.md'),
        ]);
        $generator->addTemplate('blog.twig', 'posts.html');
        $generator->addCategoryTemplate('category.twig');
        $generator->addPostTemplate('post.twig', 'post/', [
            'content' => 'sections/post.html',
        ]);
    }

}