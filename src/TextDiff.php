<?php

namespace Juanrube\TextDiff;

use Jfcherng\Diff\DiffHelper;

class TextDiff
{
    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * Generate a diff between two texts.
     *
     * @param string $oldText
     * @param string $newText
     * @param string $renderer
     * @param array $options
     * @return string
     */
    public function generateDiff(string $oldText, string $newText, string $renderer = 'Inline', array $options = []): string
    {
        $defaultOptions = [
            'detailLevel' => $this->config['detail_level'] ?? 'word',
            'insertMarkers' => $this->config['insert_markers'] ?? ['<ins>', '</ins>'],
            'deleteMarkers' => $this->config['delete_markers'] ?? ['<del>', '</del>'],
        ];

        $options = array_merge($defaultOptions, $options);
        $renderer = $renderer ?? $this->config['renderer'] ?? 'Inline';

        return DiffHelper::calculate($oldText, $newText, $renderer, $options);
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