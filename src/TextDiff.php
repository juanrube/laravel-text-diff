<?php

namespace Juanrube\TextDiff;

use Jfcherng\Diff\DiffHelper;
use Jfcherng\Diff\Contract\Renderer\RendererConstant;

class TextDiff
{
    protected array $differOptions;
    protected array $rendererOptions;
    protected string $rendererName;

    public function __construct()
    {
        $this->rendererName = 'SideBySide';

        $this->differOptions = [
            'context' => 3,
            'ignoreCase' => false,
            'ignoreLineEnding' => false,
            'ignoreWhitespace' => false,
            'lengthLimit' => 2000,
            'fullContextIfIdentical' => false,
        ];

        $this->rendererOptions = [
            'detailLevel' => 'line',
            'language' => 'eng',
            'lineNumbers' => true,
            'separateBlock' => true,
            'showHeader' => true,
            'spacesToNbsp' => false,
            'tabSize' => 4,
            'mergeThreshold' => 0.8,
            'cliColorization' => RendererConstant::CLI_COLOR_AUTO,
            'outputTagAsString' => false,
            'jsonEncodeFlags' => \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE,
            'wordGlues' => [' ', '-'],
            'resultForIdenticals' => null,
            'wrapperClasses' => ['diff-wrapper'],
        ];
    }

    /**
     * Set the options for the differ (differences).
     *
     * @param array $options The options to set.
     * 
     * @return self
     */
    public function setDifferOptions(array $options): self
    {
        $this->differOptions = array_merge($this->differOptions, $options);
        return $this;
    }

    /**
     * Set the options for the renderer (rendering).
     *
     * @param array $options The options to set.
     * 
     * @return self
     */
    public function setRendererOptions(array $options): self
    {
        $this->rendererOptions = array_merge($this->rendererOptions, $options);
        return $this;
    }

    /**
     * Set the name of the renderer to use.
     *
     * @param string $name The name of the renderer.
     * 
     * @return self
     */
    public function setRendererName(string $name): self
    {
        $this->rendererName = $name;
        return $this;
    }

    /**
     * Generate the diff between two strings.
     *
     * @param string $old The original text.
     * @param string $new The modified text.
     * 
     * @return string The generated diff.
     */
    public function generateDiff(string $old, string $new): string
    {
        return DiffHelper::calculate(
            $old,
            $new,
            $this->rendererName,
            $this->differOptions,
            $this->rendererOptions,
        );
    }

    /**
     * Get the stye tag for the TextDiff instance.
     *
     * @return array
     */
    public static function styleTag(): string
    {
        $path = asset('vendor/textdiff/textdiff.css');
        return "<link rel='stylesheet' href='{$path}'>";
    }
}
