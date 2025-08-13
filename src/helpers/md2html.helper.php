<?php

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;

if (!function_exists('md2html')) {
    /**
     * Converte markdown para html (github flavored)
     *
     * @param String $markdown
     * @param String $style Estido do CSS (default=default.css)
     * @return String
     * @author Masakik, em 16/11/2022
     * @author Masaki K Neto, em 13/8/2025 copiado do starter para o laravel-tools com ajustes
     */
    function md2html($markdown, $style = 'default.css')
    {
        $environment = new Environment();
        $environment->addExtension(new GithubFlavoredMarkdownExtension());
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addRenderer(FencedCode::class, new FencedCodeRenderer());
        $environment->addRenderer(IndentedCode::class, new IndentedCodeRenderer());

        $markdownConverter = new MarkdownConverter($environment);

        $html = '<style>' . file_get_contents(base_path('vendor/scrivo/highlight.php/styles/' . $style)) . '</style>';
        $html .= $markdownConverter->convert($markdown)->getContent();
        return $html;
    }
}